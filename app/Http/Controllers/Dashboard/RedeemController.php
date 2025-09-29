<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Point;
use App\Models\Prize;
use App\Models\Redeem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class RedeemController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.redeem.index');
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
        return view('pages.dashboard.redeem.index');
    }

    public function getData(Request $request)
    {
        if (!$request->ajax()) return;

        $query = DB::table('redeem')
            ->select(
                'redeem.id as id', 'redeem.user_id as redeem_user_id', 'redeem.prize_id as prize_id', 'redeem.status as status', 'redeem.created_at as created_at',
                'prizes.id as prz_id', 'prizes.name as prz_name', 'prizes.point as point', 'prizes.images as images',
                'users.id as user_id', 'users.name as user_name', 'users.email as email'
            )
            ->join('prizes', 'redeem.prize_id', '=', 'prizes.id')
            ->join('users', 'redeem.user_id', '=', 'users.id')
            ->orderBy('redeem.created_at', 'desc');

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('users.name', 'like', "%{$search}%")
              ->orWhere('users.email', 'like', "%{$search}%")
              ->orWhere('prizes.name', 'like', "%{$search}%");
          });
        }

        // Custom search by date
        if ($request->filled('start_date') && $request->filled('end_date')) {
          $query->whereBetween('redeem.created_at', [
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
                            <li><a class="dropdown-item btn-validate" href="javascript:void(0)" data-user-id="' . $row->user_id . '" data-id="' . $row->id . '" data-prize="' . $row->prize_id . '" data-status="1">Approved</a></li>
                            <li><a class="dropdown-item btn-validate" href="javascript:void(0)" data-user-id="' . $row->user_id . '" data-id="' . $row->id . '" data-prize="' . $row->prize_id . '" data-status="2">Rejected</a></li>
                        </ul>
                    </div>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
          'user_id' => 'required',
          'status'  => 'required',
          'prize'   => 'required'
        ]);

        $redeem = Redeem::findOrFail($id);
        $redeem->status = $validated['status'];
        $redeem->save();

        if($redeem->status == 1) {
          $prize = Prize::findOrFail($validated['prize']);
          Point::where('user_id', $validated['user_id'])->update([
              'point' => Point::where('user_id', $validated['user_id'])->sum('point') - $prize['point']
          ]);
        }

        return response()->json([
            'success'  => true,
            'status'   => "Redeem updated successfully",
            'redirect' => route('dashboard.redeem.index')
        ]);
    }
}
