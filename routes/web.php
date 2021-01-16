<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/





Route::get('/', function () {
	if (Session::has('teachers_class') && Session::has('teachers_subject')) {
	  Session::forget('teachers_class');
	  Session::forget('teachers_subject');
    }
	
    return view('auth.login');
})->name('main');

/*
Route::get('/user_page', function () {
    return view('user_page.user');
})->name('user_page');

Route::get('/user_page/shedule', function () {
    return view('user_page.shedule');
});
*/

Route::post('/check', 'AuthController@check')->name('check');

Route::post('/deleteUser', 'AuthController@deleteUser')->name('deleteUser');

Route::post('/createUser', 'AuthController@createUser')->name('createUser');

Route::post('/createClass', 'AuthController@createClass')->name('createclass');

Route::post('/createSubject', 'AuthController@createSubject')->name('createsubject');

Route::post('/createEmp', 'AuthController@createEmp')->name('createEmp');

Route::post('/createShed', 'AuthController@createShed')->name('createShed');


Route::post('/user', 'AuthController@login')->name('login');

Route::get('/user', 'AuthController@login')->name('login');

Route::get('/user/shedule', 'SheduleController@SheduleData')->name('shedule');

Route::get('/user/courses', 'CoursesController@check')->name('courses');

// Route::post('/send', 'CoursesController@signUp')->name('regCourse');


Route::post('/user/send',['as' => 'regCourse', 'uses' => 'CoursesController@signUp']);

Route::get('/user/marks', 'MarksController@check')->name('marks');

Route::post('/user/marks', 'MarksController@check')->name('marks');

Route::post('user/sendMark', 'MarksController@sendMark')->name('sendMark');

Route::get('/user/exams', 'ExamController@check')->name('ege');

Route::get('/user/olimp', 'OlimpController@check')->name('olimpiads');




/*
Route::get('/admin/CreateUser', function () {
    return view('admin_page.register');
})->name('admin');
*/
Route::get('/admin/CreateUser','AuthController@checkAndGet')->name('admin');


Route::get('/admin/CreateClass', function () {
    $classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createClass',['classes' => $classes]);
})->name('createClass');

Route::post('/admin/CreateClass', function () {
	
	$classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createClass',['classes' => $classes]);
    
})->name('createClass');

Route::get('/admin/CreateSubject', function () {
	$subjects = DB::table('subjects')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createSubject',['subjects' => $subjects]);
})->name('createSubject');

Route::post('/admin/CreateSubject', function () {
    $subjects = DB::table('subjects')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createSubject',['subjects' => $subjects]);
})->name('createSubject');

Route::get('/admin/CreateEmployment', function () {
	$subjects = DB::table('subjects')->select('Name')->orderBy('Name', 'asc')->get();
	$classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createEmployment',['subjects' => $subjects, 'classes' => $classes]);
})->name('createEmployment');

Route::post('/admin/CreateEmployment', function () {
    $subjects = DB::table('subjects')->select('Name')->orderBy('Name', 'asc')->get();
	$classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createEmployment',['subjects' => $subjects, 'classes' => $classes]);
})->name('createEmployment');

Route::get('/admin/CreateShedule', function () {
	$subjects = DB::table('subjects')->select('Name')->orderBy('Name', 'asc')->get();
	$classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
	$cabinets = DB::table('cabinets')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createShedule',['subjects' => $subjects, 'classes' => $classes, 'cabinets' => $cabinets]);
})->name('createShedule');

Route::post('/admin/CreateShedule', function () {
    $subjects = DB::table('subjects')->select('Name')->orderBy('Name', 'asc')->get();
	$classes = DB::table('classes')->select('Name')->orderBy('Name', 'asc')->get();
	$cabinets = DB::table('cabinets')->select('Name')->orderBy('Name', 'asc')->get();
    return view('admin_page.createShedule',['subjects' => $subjects, 'classes' => $classes, 'cabinets' => $cabinets]);
})->name('createShedule');


Route::get('/test', function () {
    return view('test');
})->name('test');

