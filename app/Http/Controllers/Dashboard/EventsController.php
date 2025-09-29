<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use App\Models\Events;

class EventsController extends Controller
{
  public function index()
  {
    return view('pages.dashboard.events.index');
  }

  public function create()
  {
    $event  = new Events();  // Create a new instance of the event model
    $id     = null;

    return view('pages.dashboard.events.create', compact('event', 'id'));  // Return the admin view
  }

  public function show()
  {
    return view('pages.dashboard.events.index');
  }

  public function store(Request $request, $id = null)
  {
    // Determine if it's a new event or an update
    $event = $id ? Events::find($id) : new Events();

    // Validation rules
    $validated = $request->validate([
      'title'             => ['required'],
      'slug'              => ['nullable'],
      'short_description' => ['required'],
      'content'           => ['nullable'],
      'date'              => ['required'],
      'location'          => ['required'],
      'maps'              => ['required'],
      'images'            => [ $id ? 'nullable' : 'required', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
      'status'            => ['required'],
      'drive_url'         => ['nullable'],
    ]);

    // Handle the file upload (for both create and update)
    if ($request->hasFile('images') && $request->file('images')->isValid()) {
      // If it's an update, delete the old image
      if ($id && $event->images) {
        unlink(public_path('content_file_upload/events/' . $event->images));
      }

      // Get the uploaded file
      $file = $request->file('images');

      // Generate a new filename with the current timestamp
      $timestamp = now()->timestamp;
      $extension = $file->getClientOriginalExtension();
      $newFileName = 'ev_' . $timestamp . '.' . $extension;

      // Define the path to store the file
      $destinationPath = public_path('content_file_upload/events/');
      $file->move($destinationPath, $newFileName);

      // Add the file path to validated data
      $validated['images'] = $newFileName;
    } elseif ($id) {
      // If no new image was uploaded, retain the old one
      $validated['images'] = $event->images;
    }

    // Add slug
    $slug = strtolower($validated['title']); // convert to lowercase
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug); // remove special characters
    $slug = preg_replace('/[\s-]+/', '-', $slug); // replace spaces and multiple dashes with single dash
    $validated['slug'] = trim($slug, '-'); // remove leading/trailing dashes

    // If it's a new event (no ID), create a new event, otherwise update the existing one
    if (!$id) {
      // Create the event
      $event = Events::create($validated);
    } else {
      // Update the existing event
      $event->update($validated);
    }

    return Redirect::route('dashboard.event.index')->with('status', $id ? 'Event updated successfully' : 'Event created successfully');
  }

  public function getData(Request $request)
  {
    if ($request->ajax()) {
        $query = Events::query()->orderBy('date', 'desc'); // You can select specific columns

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('short_description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
          });
        }

        // Custom search by date
        if ($request->filled('start_date') && $request->filled('end_date')) {
          $query->whereBetween('created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
          ]);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('short_description', function($row) {
              $description = substr(strip_tags($row->short_description), 0, 50).'...';
              return $description;
            })
            ->addColumn('status', function($row) {
              $badgeStatus = $row->status == 1 ? '<span class="badge bg-gradient-success">Active</span>' : '<span class="badge badge bg-gradient-danger">Not Active</span>';
              return $badgeStatus;
            })
            ->addColumn('action', function($row) {
                $dropdownBtn = '<div class="dropdown">'.
                                  '<button class="btn bg-gradient-secondary dropdown-toggle mb-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>'.
                                  '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">'.
                                    '<li><a class="dropdown-item" href="'. route('dashboard.event.edit', $row->id) . '">Edit</a></li>'.
                                    '<li><a class="dropdown-item deleteBtn" data-id="'.$row->id.'">Delete</a></li>'.
                                  '</ul>'.
                                '</div>';
                return $dropdownBtn;
            })
            ->rawColumns(['description','status','action'])
            ->make(true);
    }
  }

  public function edit($id)
  {
    $id       = $id;
    $event    = Events::find($id);
    return view('pages.dashboard.events.update', compact('event', 'id'));
  }

  public function delete($id)
  {
    $event = Events::findOrFail($id);
    // dd($event);
    // First, check if the events has an associated image
    if ($event->images && file_exists(public_path('content_file_upload/events/' . $event->images))) {
        // If the image exists, delete it from the storage
        unlink(public_path('content_file_upload/events/' . $event->images));
    }

    // Now, delete the event from the database
    $event->delete();

    // Redirect with a success message
    return response()->json(['message' => 'Event deleted successfully.']);
  }
}
