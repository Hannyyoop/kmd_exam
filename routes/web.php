<?php

use App\Http\Controllers\CenterController;
use App\Http\Controllers\ExamFeePaymentController;
use App\Http\Controllers\ExamPaymentReportController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\SubIncomeExpenseController;
use App\Http\Controllers\UserController;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth','verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Users
    Route::resource('users', UserController::class);
    // Route::get('search-users', [UserController::class, 'search'])->name('users.search');


    ## roleIndex & roleAssign
    Route::get('users/roles/assign/{userId}', [UserController::class, 'assignRoleIndex'])->name('users.assignRoleIndex');
    Route::post('users/roles/assign/{userId}', [UserController::class, 'assignRole'])->name('users.assignRole');

    // Roles
    Route::resource('roles', RoleController::class);
    // Route::get('search-roles', [RoleController::class, 'search'])->name('roles.search');


    // PermissionIndex and permissionAssign
    Route::get('roles/permissions/assign/{roleId}', [RoleController::class, 'assignPermissionIndex'])->name('roles.assignPermissionIndex');
    Route::post('roles/permissions/assign/{roleId}', [RoleController::class, 'assignPermission'])->name('roles.assignPermission');

    // Centers
    Route::resource('centers', CenterController::class);
    // Route::get('search-centers', [CenterController::class, 'search'])->name('centers.search');

    // Media
    Route::resource('media', MediaController::class);

    // SubIncomeExpense
    Route::resource('subincomeexpenses', SubIncomeExpenseController::class);

    // Exchange Rate
    Route::resource('exchangerates', ExchangeRateController::class);

    // Service Type
    Route::resource('servicetypes', ServiceTypeController::class);

    // Exam Fee Payment
    Route::resource('examfeepayments', ExamFeePaymentController::class);

    // Payment Report
    Route::get('reports', [ExamPaymentReportController::class, 'index'])->name('reports.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
