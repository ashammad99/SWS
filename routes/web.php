<?php

use App\Http\Controllers\Child\ChildController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminController;
use Spatie\Permission\Models\Role;

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
})->middleware('auth');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/profile/{id}', [UserController::class, 'edit'])->name('profile.edit');
Route::post('/profile/{id}', [UserController::class, 'update'])->name('profile.update');
Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('/roles', RoleController::class);
    Route::get('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.delete');
    Route::post('/roles/update', [RoleController::class, 'update'])->name('roles.update1');
    Route::get('/roles/perimissions/{id}/edit', [RoleController::class, 'perimissions_edit'])->name('roles.perimissions');
    Route::post('/roles/perimissions/update', [RoleController::class, 'perimissions_store'])->name('roles.perimissions.update');
    Route::resource('/perimissions', PermissionController::class);
    Route::get('/permissions/{perimission}', [PermissionController::class, 'destroy'])->name('perimissions.delete');
    Route::post('/permissions/update', [PermissionController::class, 'update'])->name('perimissions.update1');
    Route::resource('/users', UserController::class);
    Route::get('/users/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/role/{id}', [UserController::class, 'edit_userRole'])->name('users.editRole');
    Route::get('/users/{id}/restore', [UserController::class,'restore'])->name('users.restore');
    Route::post('/users/role/update/{id}', [UserController::class, 'update_userRole'])->name('users.updateRole');
    Route::post('/users/role/perimission/show/{id}', [UserController::class, 'getAjax'])->name('users.showRolePermission');
    Route::get('/users/permissions/{id}', [UserController::class, 'show_permissions'])->name('users.show_permissions');
});



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');


require __DIR__ . '/childs.php';
require __DIR__ . '/auth.php';


Route::get('/{page}', [AdminController::class, 'index'])->middleware(['auth']);
