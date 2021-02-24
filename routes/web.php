<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['reset' => false]);

Route::resource('expense', 'Admin\ExpensesController')->middleware('auth');

Route::get('expense/approve/{id}', 'Admin\ExpensesController@approve')
    ->name('expense.approve')
    ->middleware('auth');

Route::get('expense/reject/{id}', 'Admin\ExpensesController@reject')
    ->name('expense.reject')
    ->middleware('auth');

Route::get('expense/cancel/{id}', 'Admin\ExpensesController@cancel')
    ->name('expense.cancel')
    ->middleware('auth');
