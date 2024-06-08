<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('/E-vote/production/createelection');
});
Route::get('/E-vote/production/adminelection', function () {
    return view('E-vote.production.adminelection');
})->name('adminelection');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/E-vote/production/createelection', [ElectionController::class, 'create'])->name('elections.create');


require __DIR__.'/auth.php';
