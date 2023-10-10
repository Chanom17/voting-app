<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->middleware('nowLogin');
    Route::post('/register-voter', 'registerVoter')->name('register.voter');
    Route::get('/login', 'login')->middleware('nowLogin');
    Route::post('/login-voter', 'loginVoter')->name('login.voter');
    Route::get('/dashboard', 'dashboard')->middleware('checkVoterLogin');
    Route::get('/logout', 'logout')->middleware('checkVoterLogin');
    Route::get('/', 'welcome');
});

Route::controller(AdminAuthController::class)->group(function () {
    Route::get('/a-login', 'aLogin')->middleware('nowLogin');
    Route::post('/login-admin', 'loginAdmin')->name('login.admin');
    Route::get('/a-dashboard', 'adminDashboard')->middleware('checkAdminLogin');
    Route::get('/a-logout', 'adminLogout')->middleware('checkAdminLogin');
});

Route::controller(CandidateController::class)->group(function () {
    Route::get('/add-candidate', 'add')->middleware('checkAdminLogin');
    Route::post('/candidate-store', 'store')->name('candidate.store');
    Route::get('/all-candidate', 'index')->middleware('checkAdminLogin');
    Route::get('/show-candidate/{id}', 'show')->middleware('checkAdminLogin');
    Route::get('/edit-candidate/{id}', 'edit')->middleware('checkAdminLogin');
    Route::post('/update-candidate/{id}', 'update')->name('candidate.update');
    Route::delete('/delete-candidate/{id}', 'delete')->name('candidate.delete');
});

Route::controller(VoterController::class)->group(function () {
    Route::get('/vote', 'voteIndex')->middleware('checkVoterLogin');
    Route::post('/voter-vote/{candidate_id}/{voter_id}', 'vote')->middleware('checkVoted')->name('voter.vote');
    Route::get('/all-voter', 'index')->middleware('checkAdminLogin');
    Route::get('/edit-voter/{id}', 'edit')->middleware('checkAdminLogin');
    Route::post('/update-voter/{id}', 'update')->name('voter.update');
    Route::delete('/delete-voter/{id}', 'delete')->name('voter.delete');
});

Route::get('/result', [ChartController::class, 'resultChart']); //->name('chart.show')
Route::get('/result-pdf', [ChartController::class, 'resultPDF'])->name('request-pdf');
