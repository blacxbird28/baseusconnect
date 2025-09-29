<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use App\Models\Community;

class CommunityController extends Controller
{
  public function index()
  {
    return view('pages.dashboard.community.index');
  }

  public function create()
  {
    $community  = new Community();  // Create a new instance of the Community model
    $id         = null;

    return view('pages.dashboard.community.create', compact('community', 'id'));  // Return the admin view
  }

  public function show()
  {
    return view('pages.dashboard.community.index');
  }

  public function store(Request $request, $id = null)
  {
    // Determine if it's a new Community or an update
    $community = $id ? Community::find($id) : new Community();

    // Validation rules
    $validated = $request->validate([
      'name'        => ['required'],
      'description' => ['required'],
      'location'    => ['required'],
      'images'      => [ $id ? 'nullable' : 'required', 'mimes:jpg,jpeg,png,gif', 'max:1024'],
      'status'      => ['required']
    ]);

    // Handle the file upload (for both create and update)
    if ($request->hasFile('images') && $request->file('images')->isValid()) {
      // If it's an update, delete the old image
      if ($id && $community->images) {
        unlink(public_path('content_file_upload/community/' . $community->images));
      }

      // Get the uploaded file
      $file = $request->file('images');

      // Generate a new filename with the current timestamp
      $timestamp    = now()->timestamp;
      $extension    = $file->getClientOriginalExtension();
      $newFileName  = 'cm_' . $timestamp . '.' . $extension;

      // Define the path to store the file
      $destinationPath = public_path('content_file_upload/community/');
      $file->move($destinationPath, $newFileName);

      // Add the file path to validated data
      $validated['images'] = $newFileName;
    } elseif ($id) {
      // If no new image was uploaded, retain the old one
      $validated['images'] = $community->images;
    }

    // If it's a new community (no ID), create a new community, otherwise update the existing one
    if (!$id) {
      // Create the community
      $community = Community::create($validated);
    } else {
      // Update the existing community
      $community->update($validated);
    }

    return Redirect::route('dashboard.community.index')->with('status', $id ? 'Community updated successfully' : 'Community created successfully');
  }

  public function getData(Request $request)
  {
    if ($request->ajax()) {
        $query = Community::query()->orderBy('created_at', 'desc'); // You can select specific columns

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
          });
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
              $badgeStatus = $row->status == 1 ? '<span class="badge bg-gradient-success">Active</span>' : '<span class="badge badge bg-gradient-danger">Not Active</span>';
              return $badgeStatus;
            })
            ->addColumn('action', function($row) {
                $dropdownBtn = '<div class="dropdown">'.
                                  '<button class="btn bg-gradient-secondary dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>'.
                                  '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">'.
                                    '<li><a class="dropdown-item" href="'. route('dashboard.community.edit', $row->id) . '">Edit</a></li>'.
                                    '<li><a class="dropdown-item deleteBtn" data-id="'.$row->id.'">Delete</a></li>'.
                                  '</ul>'.
                                '</div>';
                return $dropdownBtn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
  }

  public function edit($id)
  {
    $id         = $id;
    $community  = Community::find($id);
    return view('pages.dashboard.community.update', compact('community', 'id'));
  }

  public function delete($id)
  {
    $community = Community::findOrFail($id);
    // dd($community);
    // First, check if the community has an associated image
    if ($community->images && file_exists(public_path('content_file_upload/community/' . $community->images))) {
        // If the image exists, delete it from the storage
        unlink(public_path('content_file_upload/community/' . $community->images));
    }

    // Now, delete the Community from the database
    $community->delete();

    // Redirect with a success message
    return response()->json(['message' => 'Community deleted successfully.']);
  }
}
