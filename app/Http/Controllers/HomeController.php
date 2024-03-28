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
        $accounts = auth()->user()->accounts->pluck('id');
        $transactionsToday = Transaction::whereIn('account_id', $accounts)
            ->whereDate('date', now())
            ->sum('amount');
        $transactionsMonth = Transaction::whereIn('account_id', $accounts)
            ->whereBetween('date', [now()->subMonth(), now()])
            ->sum('amount');
        $transactionsYear = Transaction::whereIn('account_id', $accounts)
            ->whereBetween('date', [now()->startOfYear(), now()])
            ->sum('amount');

        $hora = \Carbon\Carbon::now()->hour;

        if ($hora >= 5 && $hora < 12) {
            $moment = '¡Buenos días!';
            $phraseMoment = 'Tenemos un nuevo día por delante para cuidar nuestros ahorros';
        } elseif ($hora >= 12 && $hora < 18) {
            $moment = '¡Buenas tardes!';
            $phraseMoment = 'Sigue controlando tus gastos, es la base de tu presente y tu futuro';
        } else {
            $moment = '¡Buenas noches!';
            $phraseMoment = 'Seguro que ha sido un gran día, echa un último vistazo a tus cuentas por hoy';
        }

        return view('home', [
            'moment'            => $moment,
            'phraseMoment'      => $phraseMoment,
            'titleRight'        => 'My Cash',
            'transactionsToday' => $transactionsToday,
            'transactionsMonth' => $transactionsMonth,
            'transactionsYear'  => $transactionsYear,
        ]);
    }
}
