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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//Landing Page
Route::get('/', function(){
	return View::make('welcome');
});

//User Dashboards
Route::get('admin', 'UserController@indexAdmin');
Route::get('manager', 'UserController@indexManager');
Route::get('user', 'UserController@indexMember');
Route::get('director', 'UserController@indexDirector');
Route::get('manager/{manager_id}/members', 'UserController@showMembers');

Route::get('approved', 'LeaveController@showApproved');

//User Profile
Route::get('user/profile/{username}','UserController@show');
Route::get('user/{id}/edit', 'UserController@edit');
Route::put('user/{id}/update', ['uses' => 'UserController@update', 'as' => 'users.update']);
Route::get('user/{id}/changepassword', 'UserController@changePass');
Route::put('user/{id}/updatepassword', ['uses' => 'UserController@updatePass', 'as' => 'users.updatePass']);

//User Balances and DateHired
Route::get('admin/showemployees', 'UserController@showEmployees');
Route::get('admin/{id}/editemployee', 'UserController@editEmployee');
Route::put('admin/{id}/updateemployee', ['uses' => 'UserController@updateEmployee', 'as' => 'admin.updateEmployee']);
Route::delete('admin/{id}/delete', 'UserController@destroy');

//Team
Route::get('teams', 'TeamController@index');
Route::get('teams/create', 'TeamController@create');
Route::post('teams', 'TeamController@store');
Route::get('teams/{id}/showmembers', 'TeamController@showMembers');
Route::get('teams/{id}/edit', 'TeamController@edit');
Route::put('teams/{id}/update', ['uses' => 'TeamController@update', 'as' => 'teams.update']);
Route::delete('teams/{id}/delete', 'TeamController@destroy');
Route::get('teams/{id}/editrole', 'TeamController@editRole');
Route::put('teams/{id}/updaterole', ['uses' => 'TeamController@updateRole', 'as' => 'teams.updateRole']);
Route::delete('teams/{id}/deletemember', 'TeamController@destroyMember');

//Leave
Route::get('leaves', 'LeaveController@index');
Route::get('leaves/create', 'LeaveController@create');
Route::post('leaves', 'LeaveController@store');
Route::get('leaves/pending', 'LeaveController@pending');
Route::get('leaves/{id}/edit', 'LeaveController@edit');
Route::put('leaves/{id}/update', ['uses' => 'LeaveController@update', 'as' => 'leaves.update']);
Route::delete('leaves/{id}/delete', 'LeaveController@destroy');

//For Manager
Route::get('leaves/{team_id}/memberspending', 'LeaveController@membersPending');
Route::get('leaves/pending/{id}/edit', 'LeaveController@editPending');
Route::put('leaves/pending/{id}/update', ['uses' => 'LeaveController@updatePending', 'as' => 'leaves.updatePending']);
Route::get('leaves/history', 'LeaveController@showHistory');


