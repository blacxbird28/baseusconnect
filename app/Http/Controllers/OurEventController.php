<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Events;

class OurEventController extends Controller
{
  public function index()
  {
    $data['events']     = Events::where('status',1)->orderBy('created_at', 'DESC')->get();
    $data['news']       = Posts::where('status',1)->orderBy('created_at', 'DESC')->get();
    return view('pages.frontend.our-event.index', $data);
  }

  public function detail_event($slug)
  {
    $data['content_detail']   = Events::where('slug', 'like', '%' . $slug . '%')->first();
    $data['other_events']     = Events::where('slug', '!=', $slug)->where('status',1)->skip(0)->take(3)->orderBy('created_at', 'DESC')->get();

    // $data['shareButtons'] = \Share::page(
    //     env('APP_URL').'/read/'.$data['content_detail']['slug'],
    //     $data['content_detail']['title_'.$data['locale']],
    //     [
    //         'title' => $data['content_detail']['title_'.$data['locale']],
    //         'rel' => 'nofollow noopener noreferrer',
    //     ]
    // )

    // ->facebook()
    // ->twitter()
    // ->linkedin()
    // ->telegram()
    // ->whatsapp();

    return view('pages.frontend.our-event.detail', $data);
  }
}
