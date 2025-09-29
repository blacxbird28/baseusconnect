<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;
use App\Models\Point;
use App\Models\Activity;
use App\Models\Redeem;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MembersController extends Controller
{
  public function index()
  {
    return view('pages.dashboard.members.index');
  }

  // Method to get data for DataTable
  public function participant_data(Request $request)
  {
      if ($request->ajax()) {
        //   $data = User::select(['id', 'name', 'email']); // You can select specific columns

        $query = DB::table('users')
                ->select('users.id as id','users.name as name','users.email as email','users.profile_pic as profile_pic', 'users.group as group', 'users.created_at as created_at',
                'points.id as point_id', 'points.user_id as user_id','points.point as point')
                ->orderBy('users.created_at', 'desc')
                ->join('points', 'points.user_id', '=', 'users.id');

        if (Auth::user()->hasRole('captain') && Auth::user()->group) {
            $query->where('users.group', Auth::user()->group);
            $query->where('users.role', '!=', 'captain');
        }

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('users.name', 'like', "%{$search}%")
              ->orWhere('users.email', 'like', "%{$search}%");
          });
        }

        if ($request->filled('search_group') && $request->search_group !== 'all') {
          $search = $request->search_group;
          $query->where(function($q) use ($search) {
            $q->where('users.group', 'like', "%{$search}%");
          });
        }

        // Custom search by date
        if ($request->filled('start_date') && $request->filled('end_date')) {
          $query->whereBetween('users.created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
          ]);
        }

        $data = $query->get();

        return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('profile_with_name', function($row) {
                if($row->profile_pic == null){
                  $imgUrl = asset('images/icon-user.png');
                } else {
                  $imgUrl = asset('content_file_upload/profile_picture/' . $row->profile_pic);
                }
                return '
                    <div class="d-flex align-items-center">
                        <img src="' . $imgUrl . '" width="40" height="40" style="object-fit: cover; border-radius: 50%; margin-right:10px;" alt="PP">
                        <span>' . e($row->name) . '</span>
                    </div>';
              })
              ->addColumn('group', function($row) {
                return ucfirst($row->group);
              })
              ->addColumn('action', function($row) {
                  $editButton     = '<a href="' . route('dashboard.members.edit', $row->id) . '" class="btn btn-sm btn-primary mb-0">Edit</a>';
                  return $editButton;
              })
              ->rawColumns(['profile_with_name', 'action'])
              ->make(true);
      }
  }

  public function participant_create()
  {
    $members        = new User();
    $group          = array('running', 'music', 'gym');
    $roles          = array('captain', 'member');
    $selectedGroup  = [];
    $selectedRoles  = [];

    return view('pages.dashboard.members.create', compact('members', 'group', 'roles', 'selectedGroup', 'selectedRoles'));
  }

  public function participant_save(Request $request, $id = null)
  {

    // dd($request->all());
    // If $id is provided, it means we're updating an existing user.
    $user = $id ? User::find($id) : new User;

    // Validation rules
    $validated = $request->validate([
        'name'        => ['required', 'string'],
        'no_ktp'      => ['required', $id ? 'string' : 'unique:users'], // Unique validation only for creation
        'email'       => ['required', 'email', Rule::unique('users')->ignore($id)], // Ignore the current user's email for uniqueness during update
        'password'    => [ $id ? 'nullable' : 'required', 'string', 'min:8'],
        'profile_pic' => [ $id ? 'nullable' : 'required', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // Nullable because it's not mandatory to update the profile pic
        'domisili'    => ['required', 'string'],
        'alamat'      => ['required', 'string'],
        'phone'       => ['required', 'string'],
        'group'       => ['required', 'string'],
        'role'        => ['required', 'string'],
        'instagram'   => ['nullable', 'string'],
        'tiktok'      => ['nullable', 'string'],
        'facebook'    => ['nullable', 'string'],
        'twitter'     => ['nullable', 'string'],
    ]);

    // Handle the file upload
    if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) {
      // Call the handleFileUpload method to handle the file upload
      $newFileName = $this->handleFileUpload($request->file('profile_pic'));

      // Add the file path to the validated data
      $validated['profile_pic'] = $newFileName;

      // If updating, delete the old profile picture
      if ($id && $user->profile_pic && file_exists(public_path('content_file_upload/profile_picture/' . $user->profile_pic))) {
        unlink(public_path('content_file_upload/profile_picture/' . $user->profile_pic));
      }
    }

    // Handle the password (only update if provided)
    if ($request->filled('password')) {
        $validated['password'] = Hash::make($request->password);
    } elseif ($id) {
        // If updating and no new password is provided, keep the old password
        $validated['password'] = $user->password;
    }

    // If it's a new user (no ID), create a new user, otherwise update the existing one
    if (!$id) {
      // Create the user
      $user = User::create($validated);

      if($validated['role'] == 'captain') {
        // Assign role after registration (e.g., 'member')
        $user->assignRole('captain');
      } else {
        // Assign role after registration (e.g., 'member')
        $user->assignRole('member');
      }

      // Handle the points for the user
      Point::create([
        'user_id' => $user->id,
        'point'   => 0,  // Set the initial points
      ]);

      return Redirect::route('dashboard.members.index')->with('status', 'Profile created successfully');
    } else {
      // Update the existing user
      $user->update($validated);
      return Redirect::route('dashboard.members.index')->with('status', 'Profile updated successfully');
    }
  }

  private function handleFileUpload($file)
  {
    // Generate a new filename with the current timestamp
    $timestamp = now()->timestamp;
    $extension = $file->getClientOriginalExtension();
    $newFileName = 'pp_' . $timestamp . '.' . $extension;

    // Define the path where you want to store the file (inside the public directory)
    $destinationPath = public_path('content_file_upload/profile_picture');
    $file->move($destinationPath, $newFileName);

    return $newFileName;
  }

  public function participant_show()
  {
    return view('pages.dashboard.members.index');
  }

  public function participant_edit($id)
  {
    $members        = User::find($id);
    $group          = array('running', 'music', 'gym');
    $roles          = array('captain', 'member');
    $selectedGroup  = $members['group'];
    $selectedRoles  = $members['role'];
    // dd($members);

    return view('pages.dashboard.members.update', compact('members', 'group', 'selectedGroup', 'roles', 'selectedRoles'));
  }

  public function participant_delete()
  {
    return view('pages.dashboard.members.index');
  }

  public function participant_updateStatus(Request $request, $id)
  {
    // Validate the incoming request
    $request->validate([
      'status' => 'required', // Ensure it's either true or false
    ]);

    // Find the user by ID and update their status
    $user         = User::findOrFail($id);
    $user->status = 1;
    $user->save();

    // response()->json(['success' => true, 'status' => $user->nama . " status already updated"]);
    // return redirect('dashboard/participant/')->with('status', $user->nama . " status already updated");

    return response()->json([
      'success'   => true,
      'status'    => $user->nama . " status already updated",
      'redirect'  => route('dashboard.members.index') // Redirect URL
  ]);
  }
}
