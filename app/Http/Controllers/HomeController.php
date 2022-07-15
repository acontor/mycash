<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $accounts = auth()->user()->accounts->pluck('accounts.id');
        $transactions_today = Transaction::whereIn('account_id', $accounts)
            ->whereDate('date', date('Y-m-d'))
            ->sum('amount');
        $transactions_month = Transaction::whereIn('account_id', $accounts)
            ->whereBetween('date', [now()->subMonth(), now()])
            ->sum('amount');
        $transactions_year = Transaction::whereIn('account_id', $accounts)
            ->whereBetween('date', [now()->startOfYear(), now()])
            ->sum('amount');

        return view('home', compact('transactions_today', 'transactions_month', 'transactions_year'));
    }
}
