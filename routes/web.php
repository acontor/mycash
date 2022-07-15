<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecurringTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laragear\WebAuthn\WebAuthn;

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

Route::get('/offline', function () {
    return view('modules/laravelpwa/offline');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('home');
    });
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('account');

    Route::resource('accounts', AccountController::class)->middleware('account');

    Route::resource('transactions', TransactionController::class)->middleware('account');

    Route::get('recurring_transactions/{account}',                      [RecurringTransactionController::class, 'index'])->name('recurring_transactions.index')->middleware('account');
    Route::get('recurring_transactions/create/{account?}',              [RecurringTransactionController::class, 'create'])->name('recurring_transactions.create')->middleware('account');
    Route::post('recurring_transactions/store',                         [RecurringTransactionController::class, 'store'])->name('recurring_transactions.store')->middleware('account');
    Route::get('recurring_transactions/{recurring_transaction}/show',   [RecurringTransactionController::class, 'show'])->name('recurring_transactions.show')->middleware('account');
    Route::get('recurring_transactions/{recurring_transaction}/edit',   [RecurringTransactionController::class, 'edit'])->name('recurring_transactions.edit')->middleware('account');
    Route::put('recurring_transactions/{recurring_transaction}',        [RecurringTransactionController::class, 'update'])->name('recurring_transactions.update')->middleware('account');

    Route::resource('notifications', NotificationController::class)->middleware('account');

    Route::get('profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'update'])->name('profile.update');
});

Auth::routes();
WebAuthn::routes();
