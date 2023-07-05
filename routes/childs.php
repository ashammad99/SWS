<?php

use \App\Http\Controllers\Child\ChildController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        //'prefix' => '/beneficiary/',
        'middleware' => ['auth']
    ],
    function () {
       Route::resource(
            '/child',
            ChildController::class
        );
        Route::get('/profile', [ChildController::class, 'show_profile'])
            ->name('child.profile');
//        Route::get('/', [ChildController::class, 'index'])
//            ->name('beneficiary.index');
//
//        Route::get('/create', [ChildController::class, 'create'])
//            ->name('beneficiary.create');
//
//        Route::post('/store', [ChildController::class, 'store'])
//            ->name('beneficiary.store');
//
//        Route::get('/{id}/edit', [ChildController::class, 'edit'])
//            ->name('beneficiary.edit');

    }


);
