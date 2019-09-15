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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['prefix' => 'admin'], function() { 

	Route::group(['prefix' => 'confluence'], function() { 
		Route::get('/', 'Theory\ConfluenceController@index')->name('confluence.index');
		Route::post('/store', 'Theory\ConfluenceController@store')->name('confluence.store');
		Route::post('/update/{id}', 'Theory\ConfluenceController@update')->name('confluence.update');
		Route::get('/delete/{id}', 'Theory\ConfluenceController@destroy')->name('confluence.delete');
	});

	Route::group(['prefix' => 'theory'], function() { 
		Route::get('/', 'Theory\TheoryController@index')->name('theory.index');
		Route::post('/store', 'Theory\TheoryController@store')->name('theory.store');
		Route::post('/update/{id}', 'Theory\TheoryController@update')->name('theory.update');
		Route::get('/delete/{id}', 'Theory\TheoryController@destroy')->name('theory.delete');
	});

	Route::group(['prefix' => 'question'], function() { 
		Route::get('/', 'Theory\QuestionController@index')->name('question.index');
		Route::get('/create', 'Theory\QuestionController@create')->name('question.create');
	});

});
