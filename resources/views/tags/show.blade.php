@extends('app')

@section('title', $tag->hashtag)

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->tweets->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->tweets as $tweet)
      @include('tweets.card')
    @endforeach
  </div>
@endsection