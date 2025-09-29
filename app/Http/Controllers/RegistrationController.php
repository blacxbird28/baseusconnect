<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Mail\RegistrationFormMail;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
  public function index()
  {
    $registrations  = Registration::all();
    $location       = array("ACEH", "SUMATERA UTARA", "SUMATERA BARAT", "RIAU", "JAMBI", "SUMATERA SELATAN", "BENGKULU", "LAMPUNG", "KEPULAUAN BANGKA BELITUNG", "KEPULAUAN RIAU", "DKI JAKARTA", "JAWA BARAT", "JAWA TENGAH", "DI YOGYAKARTA", "JAWA TIMUR", "BANTEN", "BALI", "NUSA TENGGARA BARAT", "NUSA TENGGARA TIMUR", "KALIMANTAN BARAT", "KALIMANTAN TENGAH", "KALIMANTAN SELATAN", "KALIMANTAN TIMUR", "SULAWESI UTARA", "SULAWESI SELATAN", "SULAWESI TENGGARA", "GORONTALO", "SULAWESI BARAT", "MALUKU", "MALUKU UTARA", "PAPUA", "PAPUA BARAT", "SULAWESI TENGAH", "KALIMANTAN UTARA");

    return view('pages.frontend.registrations.index', compact('registrations', 'location'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
        'nama'                          => 'required',
        'no_ktp'                        => 'required|unique:registrations',
        'email'                         => 'required|email',
        'domisili'                      => 'required',
        'alamat'                        => 'required',
        'no_hp'                         => 'required',
        'tgl_lahir'                     => 'required',
        'medical_record'                => 'required',
        'emergency_contact_name'        => 'required',
        'emergency_contact_number'      => 'required',
        'size'                          => 'required',
        'gender'                        => 'required',
        'upload_transfer'               => 'required|mimes:jpg,jpeg,png,pdf|max:1024',  // Allowed file types and size limit
        'gol_darah'                     => 'nullable',
        'job'                           => 'nullable',
        'bib_number'                    => 'nullable',
        'community_name'                => 'nullable',
        'partner_desc'                  => 'required',
        'instagram'                     => 'nullable',
        'tiktok'                        => 'nullable',
        'hh'                            => 'nullable',
        'mm'                            => 'nullable',
        'ss'                            => 'nullable',
        'g-recaptcha-response'          => 'required|captcha'
        // Other validations here
    ]);

    // Check if the file exists
    if ($request->hasFile('upload_transfer') && $request->file('upload_transfer')->isValid()) {
      // Get the file from the request
      $file = $request->file('upload_transfer');

      // Generate a new filename with the current timestamp
      $timestamp    = now()->timestamp;  // Current timestamp (e.g., 1632731589)
      $extension    = $file->getClientOriginalExtension(); // Get the file extension (jpg, png, etc.)
      $newFileName  = $timestamp . '.' . $extension;  // Combine timestamp with extension

      // Define the path where you want to store the file (inside the public directory)
      $destinationPath = public_path('upload_transfer');  // This points to the public/upload_transfer folder

      // Move the file to the desired location in the public folder
      $file->move($destinationPath, $newFileName);

      // Return success message with the file URL
      $fileUrl = asset('upload_transfer/' . $newFileName);  // Generates the URL to access the file

      // Add 'upload_transfer' with the new file name to the validated data
      $validated['upload_transfer'] = $newFileName;  // Store relative path

      // Return success response or redirect
      Registration::create($validated);

      // Send the email
      Mail::to($validated['email'])->send(new RegistrationFormMail(
        $validated['nama'],
        $validated['email']
    ));
  }


    return redirect()->route('registrations.success');
  }


  public function show()
  {
    dd('success');
    // return view('pages.frontend.registrations.success');
  }

  public function success()
  {
    return view('pages.frontend.registrations.success');
  }
}
