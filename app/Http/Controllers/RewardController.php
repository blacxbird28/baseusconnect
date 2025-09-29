<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardController extends Controller
{
  public function index()
  {
    return view('pages.frontend.reward.index');
  }
}
