<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Point;
use Yajra\DataTables\DataTables;

class LeaderboardController extends Controller
{
  public function index()
  {
    return view('pages.dashboard.leaderboard.index');
  }

  public function leaderboard_data(Request $request)
  {
      if ($request->ajax()) {
        //   $data = User::select(['id', 'name', 'email']); // You can select specific columns

        $query = DB::table('users')
                ->select('users.id as id','users.name as name','users.email as email','users.group as group','users.profile_pic as profile_pic',
                'points.id as point_id', 'points.user_id as user_id','points.point as point')
                ->orderBy('points.point', 'desc')
                ->join('points', 'points.user_id', '=', 'users.id');

        if (Auth::user()->hasRole('captain') && Auth::user()->group) {
            $query->where('users.group', Auth::user()->group);
            $query->where('users.role', '!=', 'captain');
        }

        if ($request->filled('search_group') && $request->search_group !== 'all') {
          $search = $request->search_group;
          $query->where(function($q) use ($search) {
            $q->where('users.group', 'like', "%{$search}%");
          });
        }

        // Custom search by name or email
        if ($request->filled('search_value')) {
          $search = $request->search_value;
          $query->where(function($q) use ($search) {
            $q->where('users.name', 'like', "%{$search}%")
              ->orWhere('users.email', 'like', "%{$search}%");
          });
        }

        $data = $query->limit(10)->get();

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
              ->skipPaging() // this disables server-side pagination
              ->make(true);
      }
  }
}
