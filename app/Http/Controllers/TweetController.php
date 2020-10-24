<?php

namespace App\Http\Controllers;

use App\Tweet;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    //
    public function index()
    {
      $tweets = Tweet::all()->sortByDesc('created_at');

      return view('tweets.index', ['tweets' => $tweets]);
    }
}
