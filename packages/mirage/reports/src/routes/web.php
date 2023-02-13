<?php

use Mirage\Reports\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;



Route::get('' , [ReportsController::class , 'index']);
Route::get('get-table-fields' , [ReportsController::class , 'getFields'])->name('get-fields');
Route::post('report' , [ReportsController::class , 'report'])->name('make-report');
Route::get('tables' , [ReportsController::class , 'getTablesPie']);
Route::post('pie' , [ReportsController::class , 'pieChar'])->name('report-pie-chart');

