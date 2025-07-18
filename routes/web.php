<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::controller(StudentController::class)->group(function () {
    Route::get('/','student')->name('homepage');
    Route::get('/all-students','info')->name('info');
    Route::post('/store','store')->name('store');
    Route::get('/delete/{id}','delete')->name('delete');
    Route::get('/edit/{id}','edit')->name('edit');
    Route::post('/update/{id}','store')->name('update');
    Route::get('/status/{id}','status')->name('status');

});
