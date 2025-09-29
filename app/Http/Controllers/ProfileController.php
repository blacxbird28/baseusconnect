<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Models\Posts;
use App\Models\Point;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\ActivitySubmit;
use App\Models\Prize;
use App\Models\Redeem;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();

        $point = Point::where('user_id', Auth::user()->id)->sum('point');

        $activity = DB::table('activity_submit')
            ->select(
                'activity_submit.id as id', 'activity_submit.user_id as user_id', 'activity_submit.activity_id as activity_id', 'activity_submit.status as status', 'activity_submit.created_at as created_at',
                'activity.id as act_id', 'activity.title as title', 'activity.point as point'
            )
            ->where('activity_submit.user_id', Auth::user()->id)
            ->join('activity', 'activity_submit.activity_id', '=', 'activity.id')->get();

        $activity_list = Activity::all();

        $redeem_list = DB::table('redeem')
            ->select(
                'redeem.id as id', 'redeem.user_id as user_id', 'redeem.prize_id as prize_id', 'redeem.status as status', 'redeem.created_at as created_at',
                'prizes.id as prizes_id', 'prizes.name as name', 'prizes.point as point'
            )
            ->where('redeem.user_id', Auth::user()->id)
            ->join('prizes', 'redeem.prize_id', '=', 'prizes.id')->get();

        return view('pages.frontend.profile.index', compact('user', 'point', 'activity', 'activity_list', 'redeem_list'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('pages.frontend.profile-edit.edit', ['user' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Find the user by ID and update their status
        $user             = User::find($request->user()->id);
        $oldImages        = $user['profile_pic'];

        // Handle the file upload
        if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) {
          // Get the uploaded file
          $file         = $request->user()->profile_pic;
          // Generate a new filename with the current timestamp
          $timestamp    = now()->timestamp;  // Current timestamp (e.g., 1632731589)
          $extension    = $file->getClientOriginalExtension(); // Get the file extension (jpg, png, etc.)
          $newFileName  = 'pp_' . $timestamp . '.' . $extension;  // Combine timestamp with extension

          // Define the path where you want to store the file (inside the public directory)
          $destinationPath = public_path('content_file_upload/profile_picture');  // This points to the public/content_file_upload folder

          // Move the file to the desired location in the public folder
          $file->move($destinationPath, $newFileName);

          // Add the file path to the validated data
         $request->user()->profile_pic = $newFileName;

          // Delete the old file if it exists
          if ($oldImages && file_exists(public_path('content_file_upload/profile_picture/' . $oldImages))) {
              unlink(public_path('content_file_upload/profile_picture/' . $oldImages));
          }

        } else {
         $request->user()->profile_pic = $oldImages;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with('status', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
          'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // Method to get data for DataTable
    public function posts_data(Request $request)
    {
      if ($request->ajax()) {
          // $data = Posts::select(['id', 'title', 'description', 'platform', 'url', 'images', 'status']); // You can select specific columns
          $data = Posts::where('user_id', Auth::user()->id); // You can select specific columns

          return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('status', function ($row) {
                  return intval($row->status) == 1
                      ? '<span class="btn btn-sm btn-success mb-0">Validated</span>'
                      : '<span class="btn btn-sm btn-danger mb-0">Not Validated</span>';
              })
              ->addColumn('action', function($row) {
                  // Example action buttons like edit or delete
                  $editButton     = '<a href="' . route('posts.edit', $row->id) . '" class="btn btn-sm btn-primary mb-0">Edit</a>';;

                  return $editButton;
              })
              ->rawColumns(['status', 'action'])
              ->make(true);
      }
    }

    // ==================== ACTIVITY ==================== //

    public function activity_add(Request $request): View
    {
      $activity = Activity::all();
      $user     = $request->user();
      return view('pages.frontend.activity.index', compact('activity', 'user'));
    }


    public function activity_store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required',
            'activity_id'   => 'required',
            'images'        => ['required', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
        ]);

        // Handle file upload
        if ($request->hasFile('images') && $request->file('images')->isValid()) {

            $file = $request->file('images');
            $newFileName = 'act_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('content_file_upload/activity/'), $newFileName);

            $validated['images'] = $newFileName;
        }

        $validated['user_id'] = Auth::id();
        $activity = ActivitySubmit::create($validated);

        $points = Point::where('user_id', Auth::id())->first();
        $pointBefore = $points->point;

        $actLog = ActivityLog::create([
          'title'         => 'Activity Submit by ' . Auth::user()->name,
          'activity_id'   => $validated['activity_id'],
          'user_id'       => Auth::id(),
          'point_before'  => $pointBefore,
          'point_after'   => $pointBefore,
          'status'        => 1
        ]);


        return Redirect::to(route('profile.index'))->with('status', 'Activity added successfully');
    }

    // ==================== REDEEM ==================== //

    public function redeem_add(Request $request): View
    {
      $point          = Point::where('user_id', Auth::user()->id)->sum('point');
      $prizeDropdown  = Prize::where('point', '<=', $point)->get();
      $prizeList      = Prize::all();
      $activity_list  = Activity::all();

      return view('pages.frontend.redeem.index', compact('prizeDropdown', 'prizeList', 'point', 'activity_list'));
    }


    public function redeem_store(Request $request)
    {
      $validated = $request->validate([
        'prize_id'    => 'required'
      ]);

      $validated['user_id'] = Auth::id();
      $redeem = Redeem::create($validated);
      return Redirect::to(route('profile.index'))->with('status', 'Redeem added successfully');
    }

    public function generateImage(Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image',
        // ]);

        // $file = $request->file('image');
        // $filename = 'watermarked_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        if(Auth::check()) {
            $user = Auth::user();

            $images = $user->profile_pic;

            $manager = new ImageManager(Driver::class);

            // $image = $manager->read($file->getPathname());
            $image = $manager->read(public_path('content_file_upload/profile_picture/'.$images));

            // Resize/crop the image to exactly 420x760
            $width  = 1200;
            $height = 2133;
            $image->cover($width, $height);

            $watermark1 = $manager->read(public_path('images/watermark_1.png'));
            $watermark1->scaleDown($width); // optional: resize watermark

            $image->place($watermark1, 'top', 0, 0);

            if($user->group == 'running') {
                $watermark2 = $manager->read(public_path('images/watermark_run.png'));
            } else if($user->group == 'music') {
                $watermark2 = $manager->read(public_path('images/watermark_music.png'));
            } else {
                $watermark2 = $manager->read(public_path('images/watermark_gym.png'));
            }

            $watermark2->scaleDown($width); // optional: resize watermark

            $image->place($watermark2, 'bottom', 0, 0);

            // Save the final image
            $outputPath = public_path('content_file_upload/generate_image/gen_'.time().'.jpg');

            $image->save($outputPath);

            return response()->file($outputPath);
        } else {
            return abort(404);
        }
    }
}
