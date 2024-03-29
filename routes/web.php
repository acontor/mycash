<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecurringTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::view('/offline', 'offline');

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', '/home');

    Route::get('accounts/create', [AccountController::class, 'create'])->name('accounts.create');
    Route::post('accounts', [AccountController::class, 'store'])->name('accounts.store');

    Route::get('profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'account'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('accounts', AccountController::class)->except(['create','store']);

    Route::resource('transactions', TransactionController::class);
    
    Route::resource('activities', ActivityController::class);
});

Route::middleware(['auth', 'account'])->prefix('recurring_transactions')->group(function () {
    Route::get(
        '/{account}',
        [RecurringTransactionController::class, 'index']
    )->name('recurring_transactions.index');
    Route::get(
        '/create/{account?}',
        [RecurringTransactionController::class, 'create']
    )->name('recurring_transactions.create');
    Route::post(
        '/store',
        [RecurringTransactionController::class, 'store']
    )->name('recurring_transactions.store');
    Route::get(
        '/{recurring_transaction}/show',
        [RecurringTransactionController::class, 'show']
    )->name('recurring_transactions.show');
    Route::get(
        '/{recurring_transaction}/edit',
        [RecurringTransactionController::class, 'edit']
    )->name('recurring_transactions.edit');
    Route::put(
        '/{recurring_transaction}',
        [RecurringTransactionController::class, 'update']
    )->name('recurring_transactions.update');
});

Route::middleware(['auth', 'account'])->prefix('goals')->group(function () {
    Route::get(
        '/{account}',
        [GoalController::class, 'index']
    )->name('goals.index');
    Route::get(
        '/create/{account?}',
        [GoalController::class, 'create']
    )->name('goals.create');
    Route::post(
        '/store',
        [GoalController::class, 'store']
    )->name('goals.store');
    Route::get(
        '/{goal}/show',
        [GoalController::class, 'show']
    )->name('goals.show');
    Route::get(
        '/{goal}/edit',
        [GoalController::class, 'edit']
    )->name('goals.edit');
    Route::put(
        '/{goal}',
        [GoalController::class, 'update']
    )->name('goals.update');
});

Auth::routes();
