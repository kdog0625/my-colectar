<?php

namespace App\Http\Controllers;

use App\Tweet;

use App\Http\Requests\TweetRequest;

use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tweet::class, 'tweet');
    }
    //
    public function index()
    {
      $tweets = Tweet::all()->sortByDesc('created_at');

      return view('tweets.index', ['tweets' => $tweets]);
    }

    public function create()
    {
        return view('tweets.create');
    }
    //引数$requestはTweetRequestクラスのインスタンス、storeアクションメソッド内でTweetクラスのインスタンスを生成
    public function store(TweetRequest $request, Tweet $tweet)
    {
        $tweet->title = $request->title;
        $tweet->body = $request->body;
        $tweet->user_id = $request->user()->id;
        $tweet->save();
        return redirect()->route('tweets.index');
    }

    public function show(Tweet $tweet)
    {
        return view('tweets.show', ['tweet' => $tweet]);
    }    

    //editアクションメソッド内の$tweetにはTweetモデルのインスタンスが代入された状態
    public function edit(Tweet $tweet)
    {
      //ビューには'tweet'というキー名で、変数$tweetの値(Tweetモデルのインスタンス)を渡している。これにより変数$tweetにはTweetモデルのインスタンスが代入されたことになる。
        return view('tweets.edit', ['tweet' => $tweet]);    
    }

    public function update(TweetRequest $request, Tweet $tweet)
    {
        $tweet->fill($request->all())->save();
        return redirect()->route('tweets.index');
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
        return redirect()->route('tweets.index');
    }
}
