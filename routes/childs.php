<?php

use App\Http\Controllers\Child\ChildController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Child\ChildrenReportsController;

Route::group(
    [
        'middleware' => ['auth']
    ],
    function () {
        Route::resource(
            '/child',
            ChildController::class
        );
    }
);
Route::get(
    '/child/summary-report/{id}', [ChildrenReportsController::class, 'summary_report']
)->name('reports.child-summary');

Route::post(
    '/child/summary-report/store', [ChildrenReportsController::class, 'summary_report_store']
)->name('reports.child-summary-store');

Route::get(
    '/child/child-report/{id}', [ChildrenReportsController::class, 'create_report']
)->name('reports.create-child');



Route::get('/download/{filename}/{path}',
    [\App\Http\Controllers\Child\ChildController::class, 'download'])->name('download');
