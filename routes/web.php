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


Route::get('/', 'HomeController@index');

Auth::routes();

Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::resource('/admin/faq', 'Admin\FaqController');
    Route::resource('admin/departments', 'Admin\DepartmentsController');
    Route::get('/admin/tickets','TicketsController@adminTickets')->name('adminTicket');
    Route::resource('admin/staff', 'Admin\StaffController');
    Route::resource('admin/admins', 'Admin\AdminController');
    Route::resource('/admin/clients', 'Admin\ClientsController');

    /*user routes*/
    Route::get('/all/users', 'Admin\UsersController@viewUsers');
    Route::post('/delete/users/{id}','Admin\UsersController@deleteUsers');
    Route::get('/edit/users/{id}', 'Admin\UsersController@editUsers');
    Route::post('/update/users/{id}','Admin\UsersController@updateUsers');

    Route::get('/search/ticket/','Admin\SearchController@search');
    Route::get('/search/status/{status}','Admin\SearchController@status');
    Route::get('/search/department/{id}','Admin\SearchController@department');

    /*settings*/
    Route::get('/admin/settings', 'Admin\SettingsController@index');
    Route::post('/admin/settings', 'Admin\SettingsController@update');

});

/*pages*/
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::post('/contact', 'PagesController@contactMail');

Route::get('/tickets', 'TicketsController@index')->name('tickets');
Route::post('tickets', 'TicketsController@store');
Route::get('/ticket/{id}/{title}','TicketsController@ticketDetail');
Route::get('/edit/tickets/{id}', 'TicketsController@editTickets');
Route::get('/new/ticket', 'TicketsController@create');
Route::post('/update/tickets/{id}','TicketsController@updateTickets');
Route::post('/delete/tickets/{id}','TicketsController@deleteTickets');
Route::post('/delete/replies/{id}','TicketsController@deleteReplies');
Route::post('/update/status/{id}','TicketsController@updateStatus');
Route::post('/add-reply','TicketsController@addReply');
Route::post('/assign/ticket/{id}','TicketsController@assignTicket');
Route::get('/download/{file_name}','TicketsController@download');

Route::group(['middleware' => ['role:staff|client']], function() {
    Route::get('/find/ticket/','FindController@search');
    Route::get('/find/status/{status}','FindController@status');
    Route::get('/find/department/{id}','FindController@department');
});

/*User account settings*/
Route::get('profile/settings','ProfileController@profile');
Route::post('profile/settings','ProfileController@updateProfile');

/*change password*/
Route::get('change/password','ProfileController@resetPassword');
Route::post('change/password','ProfileController@updatePassword');

Route::get('/markAsRead', function (){
    Auth::user()->notifications->markAsRead();
});

Route::any('{catchall}', function() {
    return redirect('/');
})->where('catchall', '.*');