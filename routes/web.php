<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function(){
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

      ## role & permission
    Route::get('users/roles/assign/{userId}', [UserController::class, 'assignRoleIndex'])->name('users.assignRoleIndex');
    Route::post('users/roles/assign/{userId}', [UserController::class, 'assignRole'])->name('users.assignRole');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
