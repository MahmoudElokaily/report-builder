<?php

use App\Http\Controllers\DBController;

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('DB' , [DBController::class , 'index']);
//Route::get('get-table-fields' , [DBController::class , 'getTAbleFields'])->name('get-table-fields');
//Route::post('report' , [DBController::class , 'report'])->name('make-report');



Route::get('/', function () {
    return view('welcome');
});
