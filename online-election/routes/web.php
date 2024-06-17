<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ElectionView;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

Route::get('/', function () {
    return view('/ui/production/login');
});
Route::get('/ui/production/adminelection', function () {
    return view('E-vote.production.adminelection');
})->name('adminelection');

Route::middleware('auth')->group(function () {
    Route::get('/ui/production/index', function () {
        return view('ui/production/index');
    })->name('member.dashboard');

    Route::get('/ui/production/index2', function () {
        return view('ui.production.index2');
    })->name('admin.dashboard');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/ui/production/createelection', [ElectionController::class, 'create'])->name('elections.create');
Route::get('/ui/production/index', [ElectionView::class, 'index']);


require __DIR__.'/auth.php';
