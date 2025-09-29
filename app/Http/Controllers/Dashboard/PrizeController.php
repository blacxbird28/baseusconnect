<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use App\Models\Prize;

class PrizeController extends Controller
{
  public function index()
  {
    return view('pages.dashboard.prize.index');
  }

  public function create()
  {
    $prize  = new Prize();  // Create a new instance of the prize model
    $id     = null;

    return view('pages.dashboard.prize.create', compact('prize', 'id'));  // Return the admin view
  }

  public function store(Request $request, $id = null)
  {
    // Determine if it's a new prize or an update
    $prize = $id ? Prize::find($id) : new Prize();

    // Validation rules
    $validated = $request->validate([
      'name'        => ['required'],
      'point'       => ['required'],
      'images'      => [ $id ? 'nullable' : 'required', 'mimes:jpg,jpeg,png,gif', 'max:1024'],
      'status'      => ['required']
    ]);

    // Handle the file upload (for both create and update)
    if ($request->hasFile('images') && $request->file('images')->isValid()) {
      // If it's an update, delete the old image
      if ($id && $prize->images) {
        unlink(public_path('content_file_upload/prizes/' . $prize->images));
      }

      // Get the uploaded file
      $file = $request->file('images');

      // Generate a new filename with the current timestamp
      $timestamp = now()->timestamp;
      $extension = $file->getClientOriginalExtension();
      $newFileName = 'pr_' . $timestamp . '.' . $extension;

      // Define the path to store the file
      $destinationPath = public_path('content_file_upload/prizes/');
      $file->move($destinationPath, $newFileName);

      // Add the file path to validated data
      $validated['images'] = $newFileName;
    } elseif ($id) {
      // If no new image was uploaded, retain the old one
      $validated['images'] = $prize->images;
    }

    // If it's a new prize (no ID), create a new prize, otherwise update the existing one
    if (!$id) {
      // Create the prize
      $prize = Prize::create($validated);
    } else {
      // Update the existing prize
      $prize->update($validated);
    }

    return Redirect::route('dashboard.prize.index')->with('status', $id ? 'Prize updated successfully' : 'Prize created successfully');
  }

  public function getData(Request $request)
  {
    if ($request->ajax()) {
        $query = Prize::query()->orderBy('created_at', 'desc'); // You can select specific columns

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
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
                                    '<li><a class="dropdown-item" href="'. route('dashboard.prize.edit', $row->id) . '">Edit</a></li>'.
                                    '<li><a class="dropdown-item" href="'. route('dashboard.prize.delete', $row->id) . '">Delete</a></li>'.
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
    $id       = $id;
    $prize    = Prize::find($id);
    return view('pages.dashboard.prize.update', compact('prize', 'id'));
  }

  public function delete(Prize $prize)
  {
    // First, check if the prizes has an associated image
    if ($prize->images && file_exists(public_path('content_file_upload/prizes/' . $prize->images))) {
        // If the image exists, delete it from the storage
        unlink(public_path('content_file_upload/prizes/' . $prize->images));
    }

    // Now, delete the prize from the database
    $prize->delete();

    // Redirect with a success message
    return Redirect::route('dashboard.prize.index')->with('status', 'Prize deleted successfully');
  }
}
