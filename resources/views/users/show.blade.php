@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasTweets' => true, 'hasLikes' => false])
    @foreach($tweets as $tweet)
      @include('tweets.card')
    @endforeach
  </div>
@endsection
