<?php

namespace App\Http\Controllers;

use App\Tweet;

use App\Tag;

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
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('tweets.create', [
            'allTagNames' => $allTagNames,
        ]);
    }
    //引数$requestはTweetRequestクラスのインスタンス、storeアクションメソッド内でTweetクラスのインスタンスを生成
    public function store(TweetRequest $request, Tweet $tweet)
    {
        $tweet->title = $request->title;
        $tweet->body = $request->body;
        $tweet->user_id = $request->user()->id;
        $tweet->save();
        $request->tags->each(function ($tagName) use ($tweet) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tweet->tags()->attach($tag);
        });
        return redirect()->route('tweets.index');
    }

    public function show(Tweet $tweet)
    {
        return view('tweets.show', ['tweet' => $tweet]);
    } 
    
    public function like(Request $request, Tweet $tweet)
    {
        $tweet->likes()->detach($request->user()->id);
        $tweet->likes()->attach($request->user()->id);

        return [
            'id' => $tweet->id,
            'countLikes' => $tweet->count_likes,
        ];
    }

    public function unlike(Request $request, Tweet $tweet)
    {
        $tweet->likes()->detach($request->user()->id);

        return [
            'id' => $tweet->id,
            'countLikes' => $tweet->count_likes,
        ];
    }

    //editアクションメソッド内の$tweetにはTweetモデルのインスタンスが代入された状態
    public function edit(Tweet $tweet)
    {
      //ビューには'tweet'というキー名で、変数$tweetの値(Tweetモデルのインスタンス)を渡している。これにより変数$tweetにはTweetモデルのインスタンスが代入されたことになる。
      $tagNames = $tweet->tags->map(function ($tag) {
        return ['text' => $tag->name];
    });

    $allTagNames = Tag::all()->map(function ($tag) {
        return ['text' => $tag->name];
    });

    return view('tweets.edit', [
        'tweet' => $tweet,
        'tagNames' => $tagNames,
        'allTagNames' => $allTagNames,
    ]);
    }

    public function update(TweetRequest $request, Tweet $tweet)
    {
        $tweet->title = $request->title;
        $tweet->body = $request->body;
        $tweet->tags()->detach();
        $request->tags->each(function ($tagName) use ($tweet) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tweet->tags()->attach($tag);
        });
        return redirect()->route('tweets.index');
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
        return redirect()->route('tweets.index');
    }
}
