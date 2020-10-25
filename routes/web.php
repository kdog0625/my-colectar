<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
//第一引数には、URLを文字列で、第二引数には、どのコントローラーで何のメソッドを実行するのかを文字列で渡す。
Route::get('/', 'TweetController@index')->name('tweets.index');

//ログインしていなくてもトップページと詳細ページを見れるように設定
Route::resource('/tweets', 'TweetController')->except(['index','show'])->middleware('auth');
Route::resource('/tweets', 'TweetController')->only(['show']); 