<?php

use App\AuthIdentity;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discuss', function () {
    return view('discuss');
});

// http://127.0.0.1:8000/test/?provider_user_id=24991461&provider=github

Route::get('/test/', function (HttpRequest $request) {
    $provider_user_id = $request->input('provider_user_id');
    $provider = $request->input('provider');
  
    $query_result = DB::table('outh_identities')->where(['provider_user_id'=>$provider_user_id,'provider'=>$provider])->first();

    dd($query_result);
});

Auth::routes();

Route::get('/forum', 'ForumsController@index')->name('forum');

Route::get('/{provider}/auth', 'Auth\LoginController@auth')->name('social.auth');

Route::get('/{provider}/redirect', 'Auth\LoginController@auth_callback')->name('social.callback');

Route::group(['middleware' => 'auth'],function(){
    Route::resource('channels','ChannelsController');

    Route::get('/discussion/{slug}','DiscussionsController@show')->name('discussion');
    Route::get('/discussion/create','DiscussionsController@create')->name('discussion.create');
    Route::post('/discussion/store','DiscussionsController@store')->name('discussion.store');
    Route::post('/discussion/update','DiscussionsController@update')->name('discussion.update');
    Route::post('/discussion/reply/{id}','DiscussionsController@reply')->name('discussion.reply');


    Route::get('/reply/like/{id}','RepliesController@like')->name('reply.like');
    Route::get('/reply/unlike/{id}','RepliesController@unlike')->name('reply.unlike');

    Route::get('/channel/{slug}','ForumsController@channel')->name('channel');
});
