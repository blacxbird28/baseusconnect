<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OurCommunityController extends Controller
{
  public function index()
  {
    return view('pages.frontend.our-community.index');
  }
}
