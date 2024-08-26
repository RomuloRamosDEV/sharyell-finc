<?php

namespace App\Http\Controllers;

class VideosController extends Controller
{
   public function index()
   {
        return view('application.videos.index');
   }
}
