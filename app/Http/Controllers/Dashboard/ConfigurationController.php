<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Mail\RegistrationFormMail;
use Illuminate\Support\Facades\Mail;

class ConfigurationController extends Controller
{
    public function index(Configuration $configuration)
    {
        // dd( $configuration);
        $config = Configuration::findOrFail(1);

        // dd($config->id);
        return view('pages.dashboard.configuration.index', compact('config'));
    }


    public function create() {

    }

    public function store(Request $request) {

    }

    public function edit() {

    }

    public function update(Request $request, Configuration $config)
    {
        // dd($config);
        // $validated = $request->validate([
        //     'name'         => 'required',
        //     'mail_content' => 'required',
        //     // Other validations
        // ]);

        // Find the user by ID and update their status
        $config                 = Configuration::findOrFail(1);

        if($request->name) {
          $config->name           = $request->name?:$config->name;
        }
        if($request->mail_content) {
          $config->mail_content   = $request->mail_content?:$config->mail_content;
        }
        if($request->facebook) {
          $config->facebook       = $request->facebook?:$config->facebook;
        }
        if($request->instagram) {
          $config->instagram      = $request->instagram?:$config->instagram;
        }
        if($request->tiktok) {
          $config->tiktok         = $request->tiktok?:$config->tiktok;
        }
        $config->save();


        return redirect()->route('configuration.index')->with('status', 'Update successfully!');;
    }

    public function sendEmail(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        // Send the email
        Mail::to($validated['email'])->send(new RegistrationFormMail(
          $validated['email']
        ));

        return redirect()->route('configuration.index')->with('status', 'Email sent successfully!');
    }

    public function delete(Configuration $configuration) {

    }

}

