@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav') 
  <div class="container">
    @foreach($tweets as $tweet) 
      @include('tweets.card')
    @endforeach
  </div>
@endsection