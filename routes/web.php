<?php

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

Route::post('/search', 'Frontend\HomeController@search')->name('search');

Route::get('/', function () {
    $stories = \App\Story::with('comments')->where('status', 0)->latest()->get();
    return view('frontend.home')->with(['stories'=>$stories]);
});

Auth::routes();

Route::middleware(['guest'])->group(function(){

    Route::get('/client-login', function () {
        return view('frontend/auth/login');
    });

    Route::post('/client-register', 'Auth\ClientController@create')->name('client-register');
    Route::post('/client-login', 'Auth\ClientController@login')->name('client-login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/search', 'Frontend\HomeController@search')->name('admin.client.search');

Route::prefix('admin')->group(function() {
    Route::middleware(['auth'])->group(function () {
        Route::get('/manage_post', 'Admin\HomeController@index')->name('admin.manage_post');
        Route::get('/story/block/{id}', 'Admin\HomeController@block')->name('admin.story.block');
        Route::get('/story/unlisted/{id}', 'Admin\HomeController@unlisted')->name('admin.story.unlisted');
        Route::get('/story/active/{id}', 'Admin\HomeController@active')->name('admin.story.active');
        Route::get('/client/show', 'Admin\HomeController@users')->name('admin.client.show');
        Route::get('/client/active/{id}', 'Admin\HomeController@clientActive')->name('admin.client.active');
        Route::get('/client/block/{id}', 'Admin\HomeController@clientBlock')->name('admin.client.block');
        Route::post('/client/search', 'Admin\HomeController@clientSearch')->name('admin.client.search');
        Route::get('/story/details/{id}', 'Admin\HomeController@storyDetails')->name('admin.story.details');
        Route::get('/delete/comment/{id}', 'Admin\HomeController@deleteComment')->name('admin.delete.comment');
        Route::get('/delete/comment/{id}', 'Admin\HomeController@deleteComment')->name('admin.delete.comment');
        Route::get('/delete/reply/{id}', 'Admin\HomeController@deleteReply')->name('admin.delete.reply');
    });
});

Route::group(['middleware'  => 'auth:client'],function(){
    Route::get('/client/home', 'Frontend\HomeController@index')->name('client.home');
    Route::get('/client/section-wise-story/{id}', 'Frontend\HomeController@sectionWiseStory')->name('section.wise.story');
    Route::get('/client/story/share/{id}', 'Frontend\HomeController@share')->name('storey.share');
    Route::get('/client/dashboard', 'Frontend\DashboardController@index')->name('client.dashboard');
    Route::get('/client/story', 'Frontend\StoriesController@index')->name('client.story');
    Route::post('/client/story/store', 'Frontend\StoriesController@store')->name('client.story.store');
    Route::get('/client/story/edit/{id}', 'Frontend\StoriesController@edit')->name('client.story.edit');
    Route::post('/client/story/update/{id}', 'Frontend\StoriesController@update')->name('client.story.update');
    Route::get('/client/story/delete/{id}', 'Frontend\StoriesController@delete')->name('client.story.delete');
    Route::get('/client/settings', 'Frontend\SettingsController@index')->name('client.settings');

//    Comments
    Route::post('/client/comment/store/{id}', 'Frontend\CommentController@store')->name('client.comment.store');
    Route::post('/client/reply/store/{id}', 'Frontend\CommentController@replyStore')->name('client.reply.store');

//    settings
    Route::post('/client/profile/update', 'Frontend\SettingsController@update')->name('client.profile.update');
});

