<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

Route::get('/', [JobController::class, 'index'])
    ->name('home');
Route::get('/search', SearchController::class);
Route::get('/tag/{tag:name}', TagController::class);

Route::get('/companies', [EmployerController::class, 'index'])
    ->name('employers.index');

Route::get('/employers/{employer}/jobs', [JobController::class, 'jobResults']);

Route::view('/about', 'about');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [SessionController::class, 'store'])
        ->middleware('throttle:login');
});

Route::middleware('auth')->group(function () {
    Route::get('/employer/create', [EmployerController::class, 'create'])
        ->name('employers.create');
    Route::post('/employer/create', [EmployerController::class, 'store']);
    Route::get('/employer/edit', [EmployerController::class, 'edit'])
        ->name('employers.edit');
    Route::patch('/employer', [EmployerController::class, 'update']);

    Route::get('/jobs/create', [JobController::class, 'create'])
        ->name('jobs.create');
    Route::post('/jobs/create', [JobController::class, 'store']);

    Route::get('/jobs/{job}/edit',  [JobController::class, 'edit'])
        ->name('jobs.edit');
    Route::patch('/jobs/{job}/update',  [JobController::class, 'update']);
    Route::delete('/jobs/{job}/delete', [JobController::class, 'destroy'])
        ->name('jobs.delete');

    Route::get('jobs/{job}/{slug}/apply', [ApplicationController::class, 'create'])
        ->name('jobs.apply');

    Route::post('jobs/{job}/apply', [ApplicationController::class, 'store'])
        ->name('applications.store');

    Route::get('/employer/application/{application}', [ApplicationController::class, 'showForEmployer']);
    Route::get('/application/{application}', [ApplicationController::class, 'showForCandidate']);
    
    Route::get('application/{application}/resume', [ApplicationController::class, 'resume'])
        ->name('applications.resume');

    Route::post('/instructions/{application}',  [ApplicationController::class, 'instructions'])
        ->name('applications.instructions');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('recruiter.dashboard');

    Route::get('/dashboard/candidates', [DashboardController::class, 'candidates'])
        ->name('recruiter.dashboard.candidates');
        
    Route::get('/redirect-to-gmail/{to}', [ApplicationController::class, 'redirectToGmail']);
    
    Route::get('/applications', [ApplicationController::class, 'index']);

    Route::get('/saved-jobs', [SavedJobController::class, 'index']);
    Route::post('/jobs/{job}/save', [SavedJobController::class, 'toggle'])
        ->name('jobs.save');

    Route::get('/users/edit', [UserController::class, 'edit'])
        ->name('users.edit');
    Route::post('/users/update', [UserController::class, 'update'])
        ->name('users.update');
    Route::delete('/logout', [SessionController::class, 'destroy'])
        ->name('logout');
});





Route::get('/jobs/{job}/{slug}', [JobController::class, 'show'])->name('jobs.show');




