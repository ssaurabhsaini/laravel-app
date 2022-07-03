<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvestorController;
use App\Http\Controllers\StartupController;
use Illuminate\Support\Facades\Auth;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'startup', 'middleware' => ['isStartup', 'auth']], function() {
    Route::get('dashboard', [StartupController::class, 'index']);
});

Route::group(['prefix' => 'investor', 'middleware' => ['isInvestor', 'auth']], function() {
    Route::get('dashboard', [InvestorController::class, 'index']);
});

Route::post('/upload', [\App\Http\Controllers\MediaController::class, 'tempUpload']);
