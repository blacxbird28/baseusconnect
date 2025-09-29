<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\User;
use App\Models\Point;
use App\Models\ActivitySubmit;
use App\Models\Redeem;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  {
    $startDate = Carbon::now()->subDays(30);

    $usersData = DB::table('users')
    ->select(
        DB::raw("DATE(created_at) as date"),
        DB::raw("`group` as user_group"),
        DB::raw("COUNT(*) as count")
    )
    ->whereIn('group', ['running', 'music', 'gym'])
    ->where('created_at', '>=', $startDate)
    ->groupBy(DB::raw("DATE(created_at)"), 'group')
    ->orderBy('date')
    ->get()
    ->groupBy('user_group');

    $labels = [];
    $datasets = [];

    $groups = ['running', 'music', 'gym'];

    // Initialize daily counts
    $days = collect(range(0, 30))->map(function ($i) {
      return now()->subDays(30 - $i)->format('Y-m-d');
    });

    foreach ($groups as $group) {
        $groupData = $usersData[$group] ?? collect();

        $counts = $days->map(function ($day) use ($groupData) {
            return $groupData->firstWhere('date', $day)->count ?? 0;
        });

        $datasets[] = [
            'label' => ucfirst($group),
            'data' => $counts,
            'fill' => false,
            'borderColor' => match ($group) {
                'running' => 'rgb(75, 192, 192)',
                'music' => 'rgb(255, 99, 132)',
                'gym' => 'rgb(54, 162, 235)',
            },
            'tension' => 0.1
        ];
    }

    $labels = $days->toArray();

    // dd($datasets);

    $userCount      = User::count();
    $activityCount  = ActivitySubmit::count();
    $redeemCount    = Redeem::count();
    return view('pages.dashboard.index.index', compact('userCount', 'activityCount', 'redeemCount', 'labels', 'datasets'));
  }    
  
  public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // $extension = $file->getClientOriginalExtension();
            // $newFileName = 'uploads_' . $timestamp . '.' . $extension;
        
            // // Define the path to store the file
            // $destinationPath = public_path('content_file_upload/uploads/');
            // $file->move($destinationPath, $newFileName);
            
            
            // Define custom path
            $uploadPath = public_path('content_file_upload/uploads/');
            
            // Ensure the directory exists
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Create a unique filename
            $timestamp = now()->timestamp;
            $filename = 'uploads_' . $timestamp . '.' . $file->getClientOriginalName();
    
            // Move the file
            $file->move($uploadPath, $filename);
    
            // Build the public URL
            $url = url('content_file_upload/uploads/' . $filename);
            return response()->json(['location' => $url]);
        }

        return response()->json(['error' => 'Image upload failed'], 422);
    }
}
