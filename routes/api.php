<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'API'], function (){

    Route::post('auth/login', 'Auth\AuthController@login');
    Route::post('auth/register', 'Auth\AuthController@register');

    Route::apiResource('expense', 'ExpensesController')
        ->middleware('auth:api');

    Route::get('expense/approve/{id}', 'ExpensesController@approve')
        ->name('api.expense.approve')
        ->middleware(['auth:api']);

    Route::get('expense/reject/{id}', 'ExpensesController@reject')
        ->name('api.expense.reject')
        ->middleware('auth:api');

    Route::get('expense/cancel/{id}', 'ExpensesController@cancel')
        ->name('api.expense.cancel')
        ->middleware('auth:api');
});

