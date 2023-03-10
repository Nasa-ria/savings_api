<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\tansactionsController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('SignIn', [UsersController::class, 'SignIn']);
Route::post('SignOut', [UsersController::class, 'signout']);
Route::post('changePassword',[UsersController::class,'changePassword'])->name('passwordchange');
Route::apiresource('user',UsersController::class);
Route::post('deposit', [TransactionController::class, 'deposit'])->name('deposit');
Route::post('withdrawal', [TransactionController::class, 'withdrawals'])->name('withdrawal');
Route::get('users', [AdminController::class, 'Users']);
Route::get('profile/{id}', [AdminController::class, 'profile'])->name('profile');
Route::get('search', [AdminController::class, 'searching'])->name('search');
Route::get('tansactions/{id}', [AdminController::class, 'tansactions'])->name('transactions');