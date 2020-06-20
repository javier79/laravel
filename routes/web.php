<?php

/*use Illuminate\Support\Facades\Route; This appraered when the folder
was originally opened as an issue from the latest version of Inteliphence extension
once the extension was downgraded to version 1.2.3, the issue seems to be resolved */

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
