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

Route::get('/meta-tech', 'meta_controller@get_tech');

Route::get('/meta-file-type', 'meta_controller@get_file_type');

// Route::get('/', function () {

// 	$tasks = DB::table('meta')->get();
//     return view('welcome', compact('tasks'));
// });
