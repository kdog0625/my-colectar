@extends('app')

@section('title', $user->name . 'のいいねした記事')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasTweets' => false, 'hasLikes' => true])
    @foreach($tweets as $tweet)
      @include('tweets.card')
    @endforeach
  </div>
@endsection
