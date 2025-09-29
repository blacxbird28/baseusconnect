<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;

class NewsController extends Controller
{
  public function index()
  {
    return view('pages.frontend.our-event.index');
  }

  public function detail_news($slug)
  {
      $data['content_detail']   = Posts::where('slug', 'like', '%' . $slug . '%')->first();
      $data['other_news']       = Posts::where('slug', '!=', $slug)->where('status',1)->skip(0)->take(3)->orderBy('created_at', 'DESC')->get();

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

      return view('pages.frontend.news.detail', $data);
  }
}
