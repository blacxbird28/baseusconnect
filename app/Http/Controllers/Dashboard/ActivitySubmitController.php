<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Posts;
use App\Models\Activity;
use App\Models\ActivitySubmit;
use App\Models\ActivityLog;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class ActivitySubmitController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.activity-submit.index');
    }

    // public function create()
    // {
    //     $post = new Posts();

    //     if (Auth::user()->hasRole('captain') || Auth::user()->hasRole('super-admin')) {
    //         return view('pages.dashboard.posts.create', compact('post'));
    //     }

    //     return view('pages.frontend.profile.posts.add', compact('post'));
    // }

    // public function store(Request $request, $id = null)
    // {
    //     $post = $id ? Posts::findOrFail($id) : new Posts();

    //     $validated = $request->validate([
    //         'title'             => 'required',
    //         'slug'              => 'nullable',
    //         'short_description' => 'required',
    //         'content'           => 'nullable',
    //         'url'               => 'required',
    //         'images'            => [$id ? 'nullable' : 'required', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
    //         'platform'          => 'required'
    //     ]);

    //     // Handle file upload
    //     if ($request->hasFile('images') && $request->file('images')->isValid()) {
    //         if ($id && $post->images) {
    //             @unlink(public_path('content_file_upload/posts/' . $post->images));
    //         }

    //         $file = $request->file('images');
    //         $newFileName = 'posts_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('content_file_upload/posts/'), $newFileName);

    //         $validated['images'] = $newFileName;
    //     } elseif ($id) {
    //         $validated['images'] = $post->images;
    //     }

    //     // Add slug
    //     $validated['slug'] = str_replace(' ', '-', strtolower($validated['title']));

    //     if (Auth::user()->hasRole('super-admin')) {
    //       $validated['platform'] = 'news';
    //     }

    //     if ($id == null) {
    //         $validated['user_id'] = Auth::id();
    //         $post = Posts::create($validated);
    //     } else {
    //         $post->update($validated);
    //     }

    //     $route = Auth::user()->hasRole('member')
    //         ? route('profile.edit', ['user' => Auth::user()])
    //         : route('dashboard.posts.index');

    //     return Redirect::to($route)->with('status', $id ? 'Post updated successfully' : 'Post created successfully');
    // }

    // public function show()
    // {
    //     return view('pages.dashboard.participants.index');
    // }

    // public function edit($id)
    // {
    //     $post = Posts::findOrFail($id);

    //     if (Auth::user()->hasRole('captain') || Auth::user()->hasRole('super-admin')) {
    //         return view('pages.dashboard.posts.update', compact('post'));
    //     }

    //     return view('pages.frontend.profile.posts.add', compact('post'));
    // }

    public function delete()
    {
        return view('pages.dashboard.activity-submit.index');
    }

    public function getData(Request $request)
    {
        if (!$request->ajax()) return;

        $query = DB::table('activity_submit')
            ->select(
                'activity_submit.id as id', 'activity_submit.user_id as activity_user_id', 'activity_submit.activity_id as activity_id', 'activity_submit.images as images', 'activity_submit.status as status', 'activity_submit.created_at as created_at',
                'activity.id as act_id', 'activity.title as title', 'activity.point as point',
                'users.id as user_id', 'users.name as name', 'users.email as email'
            )
            ->join('activity', 'activity_submit.activity_id', '=', 'activity.id')
            ->join('users', 'activity_submit.user_id', '=', 'users.id')
            ->orderBy('activity_submit.created_at', 'desc');

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('users.name', 'like', "%{$search}%")
              ->orWhere('users.email', 'like', "%{$search}%")
              ->orWhere('activity.title', 'like', "%{$search}%");
          });
        }

        // Custom search by date
        if ($request->filled('start_date') && $request->filled('end_date')) {
          $query->whereBetween('activity_submit.created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
          ]);
        }

        $data = $query->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
              if($row->status == 1) {
                  return '<span class="badge bg-gradient-success">Approved</span>';
              } else if($row->status == 0) {
                  return '<span class="badge bg-gradient-warning">Pending</span>';
              } else {
                  return '<span class="badge bg-gradient-danger">Rejected</span>';
              }
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="dropdown">
                        <button class="btn bg-gradient-secondary dropdown-toggle mb-0" type="button" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item btn-validate" href="javascript:void(0)" data-id="' . $row->id . '" data-status="1">Approved</a></li>
                          <li><a class="dropdown-item btn-validate" href="javascript:void(0)" data-id="' . $row->id . '" data-status="2">Rejected</a></li>
                        </ul>
                    </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
          'status'  => 'required'
        ]);

        $actSubmit = ActivitySubmit::findOrFail($id);
        $actSubmit->status = $validated['status'];
        $actSubmit->save();

        $points = Point::where('user_id', $actSubmit->user_id)->first();
        $pointBefore = $points->point;

        if($actSubmit->status == 1) {
          $act = Activity::findOrFail($actSubmit->activity_id);
          $points->point = $points->point + $act->point;
          $points->save();
        }

        $activityTitle = '';
        if($actSubmit->status == 1) {
            $activityTitle = 'Approved';
        } else{
            $activityTitle = 'Rejected';
        }

        $actLog = ActivityLog::create([
          'title'         => 'Activity Submit '. $activityTitle .' by admin',
          'user_id'       => $actSubmit->user_id,
          'activity_id'   => $actSubmit->activity_id,
          'point_before'  => $pointBefore,
          'point_after'   => $points->point,
          'status'        => 1
        ]);

        return response()->json([
            'success'  => true,
            'status'   => "Activity updated successfully",
            'redirect' => route('dashboard.activity-submit.index')
        ]);
    }
}
