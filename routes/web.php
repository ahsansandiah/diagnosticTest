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

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() { 
	Route::get('/admin/dashboard', 'HomeController@index')->name('dashboard');
	Route::get('/', 'HomeController@index')->name('dashboard');

	Route::group(['prefix' => 'confluence'], function() { 
		Route::get('/', 'Theory\ConfluenceController@index')->name('confluence.index');
		Route::post('/store', 'Theory\ConfluenceController@store')->name('confluence.store');
		Route::post('/update/{id}', 'Theory\ConfluenceController@update')->name('confluence.update');
		Route::get('/delete/{id}', 'Theory\ConfluenceController@destroy')->name('confluence.delete');
		Route::post('/set-password/{id}', 'Theory\ConfluenceController@setPassword')->name('confluence.set-password');
	});

	Route::group(['prefix' => 'theory'], function() { 
		Route::get('/', 'Theory\TheoryController@index')->name('theory.index');
		Route::post('/store', 'Theory\TheoryController@store')->name('theory.store');
		Route::post('/update/{id}', 'Theory\TheoryController@update')->name('theory.update');
		Route::get('/delete/{id}', 'Theory\TheoryController@destroy')->name('theory.delete');
		Route::get('/files', 'Theory\TheoryController@getFiles')->name('theory.files');

		// Media
		Route::get('/media/{id}', 'Theory\TheoryController@getMediaById')->name('theory.media');
		Route::post('/media/store/{id}', 'Theory\TheoryController@postMedia')->name('theory.media-post');
		Route::get('/media/delete/{mediaId}', 'Theory\TheoryController@deleteMedia')->name('theory.media-delete');
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

	Route::group(['prefix' => 'evaluation'], function() { 
		Route::get('/{package}', 'Theory\EvaluationController@index')->name('evaluation.index');
		Route::post('/store', 'Theory\EvaluationController@store')->name('evaluation.store');
		Route::post('/update/{id}', 'Theory\EvaluationController@update')->name('evaluation.update');
		Route::get('/delete/{id}', 'Theory\EvaluationController@destroy')->name('evaluation.delete');

		Route::get('/detail/{evaluationId}/{studentId}', 'Theory\EvaluationController@show')->name('evaluation.show');
	});


	Route::group(['prefix' => 'profile'], function() { 
		Route::get('/', 'Other\ProfileController@index')->name('profile.index');
		Route::post('/store', 'Other\ProfileController@storeOrUpdate')->name('profile.store');
	});

	Route::group(['prefix' => 'ki-and-kd'], function() { 
		Route::get('/', 'Other\KDAndKIController@index')->name('profile.index');
		Route::post('/store/ki', 'Other\KDAndKIController@storeOrUpdateKI')->name('profile.store-ki');
		Route::post('/store/kd', 'Other\KDAndKIController@storeOrUpdateKD')->name('profile.store-kd');
	});

	Route::group(['prefix' => 'media'], function() { 
		// Video
		Route::get('/video', 'Media\VideoController@index')->name('video.index');
		Route::post('/video/store', 'Media\VideoController@store')->name('video.store');
		Route::post('/video/update/{id}', 'Media\VideoController@update')->name('video.update');
		Route::get('/video/delete/{id}', 'Media\VideoController@destroy')->name('video.delete');

		// All Media
		Route::post('/store', 'Media\MediaController@store')->name('media.store');
		Route::post('/update/{id}', 'Media\MediaController@update')->name('media.update');
		Route::get('/delete/{id}/{type}', 'Media\MediaController@destroy')->name('media.delete');
		Route::get('/{type}', 'Media\MediaController@index')->name('media.index');
	});

	Route::group(['prefix' => 'student'], function() { 
		Route::get('/', 'Student\StudentController@index')->name('student.index');
		Route::post('/store', 'Student\StudentController@store')->name('student.store');
		Route::post('/update/{studentId}', 'Student\StudentController@update')->name('student.update');
		Route::get('/delete/{studentId}', 'Student\StudentController@destroy')->name('student.delete');
		Route::post('/{userId}/reset-password', 'Student\StudentController@resetPassword')->name('student.reset-password');
	});
});


Route::get('/', 'HomeStudentController@index')->name('dashboard');

Route::group(['prefix' => '/kiandkd'], function() {
	Route::get('/ki', 'Student\KiandKd\KIandKDController@getKI')->name('ki');
	Route::get('/kd', 'Student\KiandKd\KIandKDController@getKD')->name('kd');
});

Route::group(['prefix' => '/evaluation'], function() {
	Route::group(['prefix' => '/diagnostic'], function() {
		Route::get('/', 'Student\Evaluation\DiagnosticController@index')->name('index');
		Route::post('/{confluence}', 'Student\Evaluation\DiagnosticController@checkPassword')->name('diagnostic.evaluation.validation');
		Route::get('/{confluence}', 'Student\Evaluation\DiagnosticController@evaluationTheory')->name('diagnostic.evaluation');
		Route::post('/{confluence}/submit', 'Student\Evaluation\DiagnosticController@submitEvaluation')->name('diagnostic.evaluation.submit');
		Route::get('/{evaluationId}/review', 'Student\Evaluation\DiagnosticController@review')->name('diagnostic.evaluation.review');
		Route::get('/result/{confluenceId}', 'Student\Evaluation\DiagnosticController@result')->name('diagnostic.result');
	});

	Route::group(['prefix' => '/formative'], function() {
		Route::get('/introduction', 'Student\Evaluation\FormativeController@introduction')->name('introduction');
		Route::get('/', 'Student\Evaluation\FormativeController@index')->name('index');
		Route::post('/submit', 'Student\Evaluation\FormativeController@store')->name('store');
		Route::get('/{evaluationId}/review', 'Student\Evaluation\FormativeController@review')->name('review');
		Route::get('/result', 'Student\Evaluation\FormativeController@result')->name('result');
	});
});

Route::group(['prefix' => 'media'], function() { 
	Route::get('/{type}', 'Student\Media\MediaController@index')->name('media.index');
});

Route::group(['prefix' => 'theory'], function() { 
	Route::get('/', 'Student\Theory\TheoryController@index')->name('media.index');
});

Route::get('/profile', 'Other\ProfileController@indexStudents')->name('profile.index');

// Wizard::routes('wizard/user', 'UserWizardController', 'wizard.user');
