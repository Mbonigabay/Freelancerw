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

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Auth::routes();
Route::group(['middleware'=> 'is-ban'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('userUserRevoke/{id}', array('as'=> 'users.revokeuser', 'uses' => 'UserController@revoke'));
    Route::post('userBan', array('as'=> 'users.ban', 'uses' => 'UserController@ban'));
});

//Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    // JOBSCONTROLLER
    Route::get('/search', 'jobsController@search')->name('search');
    Route::get('/autoComplete', 'jobsController@autoComplete')->name('autoComplete');
    Route::get('users/viewmyjob/{user_id?}', 'jobsController@viewByUser');
    Route::post('jobs/create/{user_id?}', 'JobsController@create');
    Route::post('jobs/Test', 'jobsController@adduser')->name('jobs.createUser');
    Route::post('jobs/v1/Test', 'jobsController@Testuser')->name('job.Test');
    Route::post('store', 'jobsController@store')->name('store');

    Route::post('/test/jobs/updating/{id}', 'jobsController@update')->name('jobs.update');


    Route::get('user/jobs/{job_id?}', 'jobsController@jobUser');
    Route::get('jobs/{job_id?}', 'jobsController@show')->name('jobs.show');
    Route::get('destroy/jobs/{job_id?}', 'jobsController@destroy');
    Route::get('index/jobs/', 'jobsController@index')->name('jobs.index');
    Route::get('create/jobs/create', 'jobsController@create')->name('jobs.create');
    Route::get('create/jobs/accept/{job_id}/{user_id}', 'jobsController@accept');
    Route::get('create/jobs/decline/{job_id}/{user_id}', 'jobsController@decline');
    Route::get('jobs/{job_id}/edit', 'jobsController@edit');
    Route::get('delete/jobs/{job_id?}', 'jobsController@delete')->name('jobs.delete');
    Route::get('/downloadjob/{id}','jobsController@downloadJob');


// USERSCONTROLLER
    Route::get('index/users/', 'usersController@index');
    Route::get('users/{user_id?}/{photo_id?}', 'usersController@show')->name('users.show');
    Route::get('edit/users/{user_id}', 'usersController@edit')->name('users.edit');
    Route::post('users/update/{user_id}', 'usersController@update');
    Route::post('users/updatestatus/{user_id}', 'usersController@updateStatus');
    Route::post('users/upload', 'usersController@upload')->name('upload');
    Route::get('/downloadcv/{id}','usersController@downloadCv');
    Route::post('/rating/{user}', 'usersController@userStar')->name('userStar');
    Route::get('/searchUser', 'usersController@searchUser')->name('searchUser');
    Route::get('/viewmybid/{user_id?}', 'usersController@viewMyBid');

// PHOTOCONTROLLER
    Route::post('upload', 'PhotosController@upload')->name('photos.upload');
    Route::get('photos/{photo_id?}', 'PhotosController@show')->name('photos.show');
    Route::get('destroy/photos/{photo_id?}', 'PhotosController@destroy');

// MESSAGECONTROLLER
    Route::get('messages/compose', 'MessageController@create');
    Route::post('compose', 'MessageController@compose')->name('compose');
    Route::get('messages/{message_id?}', 'MessageController@show')->name('messages.show');
    Route::get('unread/messages/{message_id?}', 'MessageController@unread')->name('messages.unread');
    Route::get('read/messages/{message_id?}', 'MessageController@read')->name('messages.read');
    Route::get('archive/messages/{message_id?}', 'MessageController@archive')->name('messages.archive');
    Route::get('delete/messages/{message_id?}', 'MessageController@delete')->name('messages.delete');
    Route::get('inbox/messages/', 'MessageController@inbox');
    Route::get('chat/messages/', 'MessageController@chat');
    Route::get('sent/messages/', 'MessageController@sent')->name('messages.sent');
    Route::get('archived/messages/', 'MessageController@archived');

    //ADMINCONTROLLER
    Route::get('index/admin/', 'AdminController@index')->name('admin.index');
    Route::get('/downloadreport','AdminController@downloadReport');
    Route::get('/downloadreportbydate','AdminController@downloadReportByDate');

    //COMMENTSCONTROLLER
    Route::get('destroy/comment/{comment_id?}', 'commentsController@destroy')->name('comments.destroy');
    Route::post('comment/store', 'commentsController@store')->name('comments.store');

    //REPORTSCONTROLLER
    Route::get('index/report/', 'ReportsController@index')->name('reports.index');
    Route::post('report/store', 'ReportsController@store')->name('reports.store');
    Route::get('destroy/report/{report_id?}', 'ReportsController@destroy')->name('reports.destroy');
    Route::get('resolve/user/{user_id?}', 'ReportsController@resolveUser');

    Route::resource('roles', 'rolesController');
//    Route::resource('comments', 'commentsController');
});