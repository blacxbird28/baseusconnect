<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Models\Events;
use App\Models\Leaderboard;

class HomeController extends Controller
{
  public function index()
  {


    $data['leaderboard'] = DB::table('users')
            ->select('users.id as id','users.name as name','users.email as email','users.group as group','users.profile_pic as profile_pic',
            'points.id as point_id', 'points.user_id as user_id','points.point as point')
            ->orderBy('points.point', 'desc')
            ->join('points', 'points.user_id', '=', 'users.id')
            ->limit(5)->get();

            // dd($data['leaderboard']);
    $data['events']       = Events::where('status',1)->orderBy('created_at', 'DESC')->limit(3)->get();
    $data['news']         = Posts::where('status',1)->orderBy('created_at', 'DESC')->limit(3)->get();
    return view('pages.frontend.home.index', $data);
  }
}
