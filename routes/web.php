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

Route::get('/meta-browser', 'meta_controller@get_browser');

Route::get('/meta-tech/{cms}', 'meta_controller@get_tech');

Route::get('/meta-file-type', 'meta_controller@get_file_type');

Route::get('/meta-columns', 'meta_controller@get_columns');

Route::get('/meta-layout', 'meta_controller@get_layout');

Route::get('/meta-resolution', 'meta_controller@get_resolution');

Route::get('/meta-compatible/{cms}', 'meta_controller@get_compatible');

Route::get('/meta-cms', 'meta_controller@get_cms');

Route::get('/templates-count/{cms}', 'meta_controller@get_count_templates');

Route::get('/', 'site@run_site');

// Route::get('/', function () {

// 	$tasks = DB::table('meta')->get();
//     return view('welcome', compact('tasks'));
// });
