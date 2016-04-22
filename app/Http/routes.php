<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as' => 'home','uses' => 'HomeController@index']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::resource('users','UsersController');
Route::resource('tickets','TicketsController');
Route::resource('projects','ProjectsController');
Route::resource('customers','CustomersController');
Route::resource('tickets.ticket_replies','TicketRepliesController');
Route::get('twitter', 'TwitterController@receive');
Route::get('tweet', 'TicketRepliesController@tweet');
Route::get('test', function()
{
    return Twitter::getSearch(array('q' => 'secretsocial', 'count' => 100, 'format' => 'array'));
});
