@extends('app')

@section('title', '記事更新')

@include('nav')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
            <!-- route関数の第二引数には、連想配列形式でルーティングのパラメーターを渡すことができる。['tweet' => $tweet]の部分を、['tweet' => $tweet->id]と記載もできる -->
              <form method="POST" action="{{ route('tweets.update', ['tweet' => $tweet]) }}">
                <!-- @method('PATCH')と記述すると<input type="hidden" name="_method" value="PATCH">の扱いになる。-->
                @method('PATCH')
                @include('tweets.form')
                <button type="submit" class="btn blue-gradient btn-block">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection