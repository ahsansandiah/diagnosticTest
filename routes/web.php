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
		Route::post('/store', 'Theory\QuestionController@store')->name('question.store');
		Route::post('/update/{id}', 'Theory\QuestionController@update')->name('question.update');
		Route::get('/detail/{id}', 'Theory\QuestionController@show')->name('question.detail');
		Route::get('/delete/{id}', 'Theory\QuestionController@destroy')->name('question.delete');

		// Create Answer
		Route::get('/create-step-two/{id}', 'Theory\QuestionController@createStepTwo')->name('question.createtwo');
		Route::post('/store-step-two', 'Theory\QuestionController@storeStepTwo')->name('question.storetwo');

		Route::post('answer/store', 'Theory\QuestionController@storeAnswer')->name('question.storeAnswer');
		Route::get('/{idQuestion}/{idAnswer}/{status}', 'Theory\QuestionController@setStatusAnswer')->name('question.answerStatus');
		Route::get('/{idQuestion}/answer/{idAnswer}/delete', 'Theory\QuestionController@deleteAnswer')->name('question.answerDelete');
		Route::post('/answer/{idAnswer}/update', 'Theory\QuestionController@updateAnswer')->name('question.updateAnswer');

	});

	Route::group(['prefix' => 'answer'], function() { 
		Route::get('/', 'Theory\TheoryController@index')->name('theory.index');
		Route::post('/store', 'Theory\TheoryController@store')->name('theory.store');
		Route::post('/update/{id}', 'Theory\TheoryController@update')->name('theory.update');
		Route::get('/delete/{id}', 'Theory\TheoryController@destroy')->name('theory.delete');

		Route::get('/{id}/{status}', 'Theory\AnswerController@setStatus')->name('answer.status');
	});

});
