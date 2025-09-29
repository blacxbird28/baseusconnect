<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Point;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Mail\RegistrationFormMail;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Swift_TransportException;
use Exception;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request);
      try {

        $validated = $request->validate([
            'name'                      => ['required', 'string', 'max:255'],
            'email'                     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password'                  => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_pic'               => ['required', 'mimes:jpg,jpeg,png,gif'],
            'phone'                     => ['required', 'string'],
            'group'                     => ['required', 'string'],
            'g-recaptcha-response'      => ['required', 'captcha'],
            'alamat'                    => ['required', 'string'],
            'born_date'                 => ['required', 'string'],
            'instagram'                 => ['nullable', 'string'],
            // 'community_name'            => ['required', 'string'],
            // 'product'                   => ['required', 'string'],
            // 'domisili'                  => ['required', 'string'],
            // 'no_ktp'                    => ['required', 'string'],
            // 'tiktok'                    => ['nullable', 'string'],
            // 'facebook'                  => ['nullable', 'string'],
            // 'twitter'                   => ['nullable', 'string'],
        ]);

        // Handle the file upload
        if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) {
          // Get the uploaded file
          $file         = $request->file('profile_pic');

          // Generate a new filename with the current timestamp
          $timestamp    = now()->timestamp;  // Current timestamp (e.g., 1632731589)
        //   $extension    = $file->getClientOriginalExtension(); // Get the file extension (jpg, png, etc.)
          $newFileName  = 'pp_' . $timestamp . '.jpg';  // Combine timestamp with extension

        //   // Define the path where you want to store the file (inside the public directory)
        //   $destinationPath = public_path('content_file_upload/profile_picture');  // This points to the public/content_file_upload folder

        //   // Move the file to the desired location in the public folder
        //   $file->move($destinationPath, $newFileName);

          $manager = new ImageManager(Driver::class);

          $image = $manager->read($file->getPathname());
          $destinationPath = public_path('content_file_upload/profile_picture/'.$newFileName);
          $image->save($destinationPath, 75);

          // Add the file path to the validated data
          $validated['profile_pic'] = $newFileName;
        }

        $validated['role']      = 'member';
        $validated['password']  = Hash::make($request->password);

        if (!$validated) {
        //   return response()->json(['errors' => $validated->errors()], 422);
            throw new ValidationException($validator);
        }

        // 1. Create the user
        $user = User::create($validated);

        event(new Registered($user));

        // 2. Assign role
        // Assign role after registration (e.g., 'member')
        $user->assignRole('member');

        // 3. Handle the points for the user
        // If no points entry exists for the user, create a new entry
        Point::create([
          'user_id' => $user['id'],  // Set the user_id
          'point'   => 0,  // Set the initial points
        ]);


        $grouplink = '';
        if($validated['group'] == 'running'){
            $grouplink = 'https://chat.whatsapp.com/FlQ6OtCiP65LuQ0QPuDlBJ';
        } else if($validated['group'] == 'music'){
            $grouplink = 'https://chat.whatsapp.com/JDzK7kLDi7CEb6N9IZmTKW';
        } else {
            $grouplink = 'https://chat.whatsapp.com/BWJboFgM9vKBnwutUPDeJ3';
        }

        // Send the email
        Mail::to($validated['email'])->send(new RegistrationFormMail(
          $validated['email'],
          $grouplink
        ));

        Auth::login($user);

        session()->flash('success_registration', 'Registration successfully');
        return response()->json(['message' => 'Success']);
        // return redirect(route('home.index', absolute: false))->with('success_registration', 'Registration successfully');
        // return Redirect::to(route('profile.index'))->with('status', 'Redeem added successfully');

      } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], 422);
      } catch (Exception $e) {
        Log::error("Error: " . $e->getMessage());

        if ($e instanceof QueryException) {
            $message = 'Database error.';
        } elseif ($e instanceof FileException) {
            $message = 'Profile picture upload failed.';
        } elseif ($e instanceof Swift_TransportException) {
            $message = 'Email could not be sent.';
        } else {
            $message = 'Unexpected error occurred.';
        }

        return response()->json([
            'title' => $message,
            'errors' => $e->getMessage()
        ], 500);
      }
    }
}
