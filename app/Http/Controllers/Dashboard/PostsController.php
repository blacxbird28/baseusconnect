<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class PostsController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.posts.index');
    }

    public function create()
    {
        $post = new Posts();

        if (Auth::user()->hasRole('captain') || Auth::user()->hasRole('super-admin')) {
            return view('pages.dashboard.posts.create', compact('post'));
        }

        return view('pages.frontend.profile.posts.add', compact('post'));
    }

    public function store(Request $request, $id = null)
    {
        $post = $id ? Posts::findOrFail($id) : new Posts();

        $validated = $request->validate([
            'title'             => 'required',
            'slug'              => 'nullable',
            'short_description' => 'required',
            'content'           => 'nullable',
            'url'               => 'required',
            'images'            => [$id ? 'nullable' : 'required', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'platform'          => 'required'
        ]);

        // Handle file upload
        if ($request->hasFile('images') && $request->file('images')->isValid()) {
            if ($id && $post->images) {
                @unlink(public_path('content_file_upload/posts/' . $post->images));
            }

            $file = $request->file('images');
            $newFileName = 'posts_' . now()->timestamp . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('content_file_upload/posts/'), $newFileName);

            $validated['images'] = $newFileName;
        } elseif ($id) {
            $validated['images'] = $post->images;
        }

        // Add slug
        $validated['slug'] = str_replace(' ', '-', strtolower($validated['title']));

        if (Auth::user()->hasRole('super-admin')) {
          $validated['platform'] = 'news';
        }

        if ($id == null) {
            $validated['user_id'] = Auth::id();
            $post = Posts::create($validated);
        } else {
            $post->update($validated);
        }

        $route = Auth::user()->hasRole('member')
            ? route('profile.edit', ['user' => Auth::user()])
            : route('dashboard.posts.index');

        return Redirect::to($route)->with('status', $id ? 'Post updated successfully' : 'Post created successfully');
    }

    public function show()
    {
        return view('pages.dashboard.participants.index');
    }

    public function edit($id)
    {
        $post = Posts::findOrFail($id);

        if (Auth::user()->hasRole('captain') || Auth::user()->hasRole('super-admin')) {
            return view('pages.dashboard.posts.update', compact('post'));
        }

        return view('pages.frontend.profile.posts.add', compact('post'));
    }

    public function delete()
    {
        return view('pages.dashboard.participants.index');
    }

    public function getData(Request $request)
    {
        if (!$request->ajax()) return;

        $query = DB::table('posts')
            ->select(
                'posts.id as id', 'posts.user_id as post_user_id', 'posts.title', 'posts.short_description', 'posts.content',
                'posts.platform', 'posts.url', 'posts.images', 'posts.status', 'posts.created_at',
                'users.id as user_id', 'users.name as user_name', 'users.email as user_email', 'users.group as user_group'
            )
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.status', 1)
            ->orderBy('posts.created_at', 'desc');

        if (Auth::user()->hasRole('captain') && Auth::user()->group) {
            $query->where('users.group', Auth::user()->group);
        }

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('posts.title', 'like', "%{$search}%");
          });
        }

        // Custom search by date
        if ($request->filled('start_date') && $request->filled('end_date')) {
          $query->whereBetween('posts.created_at', [
            $request->start_date . ' 00:00:00',
            $request->end_date . ' 23:59:59'
          ]);
        }

        $data = $query->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return $row->status == 1
                    ? '<span class="badge bg-gradient-success">Validated</span>'
                    : '<span class="badge bg-gradient-danger">Not Validated</span>';
            })
            ->addColumn('action', function ($row) {
                return '
                    <div class="dropdown">
                        <button class="btn bg-gradient-secondary dropdown-toggle mb-0" type="button" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('dashboard.posts.edit', $row->id) . '">Edit</a></li>
                            <li><a class="dropdown-item btn-validate" href="javascript:void(0)" data-id="' . $row->id . '" data-status="' . $row->status . '">Validate</a></li>
                        </ul>
                    </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required']);

        $post = Posts::findOrFail($id);
        $post->status = 1;
        $post->save();

        $points = Point::firstOrNew(['user_id' => $post->user_id]);
        $points->point = $points->point + 10;
        $points->save();

        return response()->json([
            'success'  => true,
            'status'   => "Post updated successfully",
            'redirect' => route('dashboard.posts.index')
        ]);
    }
}
