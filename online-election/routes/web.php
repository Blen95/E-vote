<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\CandidateController;

use App\Http\Controllers\ElectionView;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;



Route::get('/', function () {
    return view('/ui/production/landingpage');
});
//Route::post('/login', [AuthenticatedSessionController::class, 'redirectBasedOnRole'])->name('login');


Route::get('/login', function () {
    return view('/ui/production/login');
})->name('login'); 
/*
Route::middleware(['auth'])->group(function () {
    Route::get('/index2', [AuthenticatedSessionController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/index', [AuthenticatedSessionController::class, 'memberDashboard'])->name('member.dashboard');
});
*/
//member
Route::get('/form', function () {
    return view('/ui/production/form');
});
Route::get('/index', function () {
    return view('/ui/production/index');
});
Route::get('/electionopened', function () {
    return view('/ui/production/electionopened');

   
});

Route::get('/new', function () {
    return view('/ui/production/new');
});
Route::get('/guestindex', function () {
    return view('/ui/production/guestindex');
});


//admin
Route::get('/form2', function () {
    return view('/ui/production/form2');
});
Route::get('/adminelection', function () {
    return view('/ui/production/adminelection');
});
Route::get('/candidateregister', function () {
    return view('/ui/production/candidateregister');
});
Route::get('/index2', function () {
    return view('/ui/production/index2');
});
Route::get('/createelection', function () {
    return view('/ui/production/createelection');
})->name('createelection.form');
Route::get('/profile', function () {
    return view('/ui/production/profile');
});
Route::get('/electionclosed', function () {
    return view('/ui/production/electionclosed');
})->name('votepage');
Route::get('/tables_dynamic', function () {
    return view('/ui/production/tables_dynamic');
});
Route::get('/voterregister', function () {
    return view('/ui/production/voterregister');
});
// routes/web.php



Route::get('/candidate/register', [CandidateController::class, 'showRegistrationForm'])->name('candidate.register');
Route::post('/candidate/register', [CandidateController::class, 'register'])->name('candidate.register.submit');

/*
Route::get('/ui/production/adminelection', function () {
    return view('E-vote.production.adminelection');
})->name('adminelection');*/

/*Route::middleware('auth')->group(function () {
    Route::get('/ui/production/index', function () {
        return view('ui/production/index');
    })->name('member.dashboard');

    Route::get('/ui/production/index2', function () {
        return view('ui.production.index2');
    })->name('admin.dashboard');
});
*/



/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/ui/production/createelection', [ElectionController::class, 'create'])->name('elections.create');
//Route::get('/ui/production/index', [ElectionView::class, 'index']);
Route::get('/ui/production/adminelection',[ElectionView::class,'index'])->name('adminelection');
Route::get('/ui/production/electionclosed/{eid}',[VoteController::class,'candidates'])->name('votepage');
Route::get('/ui/production/electionopened/{eid}',[VoteController::class,'candidates'])->name('requestpage');
Route::get('/ui/production/adminelection/close/{id}', [ElectionController::class, 'close'])->name('election.close');
Route::get('/ui/production/adminelection/open/{id}', [ElectionController::class, 'open'])->name('election.open');
Route::post('/approve-candidate/{eid}/{candidateid}', [ElectionController::class, 'approveCandidate'])->name('approve.candidate');


require __DIR__.'/auth.php';


Route::get('/ui/production/register', function () {
    return view('/ui/production/register');
})->name('register.form');