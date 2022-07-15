<?php

namespace App\Console\Commands;

use App\Models\RecurringTransaction;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecurringTransactionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring_transactions:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check recurring transactions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $recurringTransactions = RecurringTransaction::where('next_date', '<=', date('Y-m-d'))->where('active', true)->get();

        foreach ($recurringTransactions as $recurringTransaction) {
            $transaction                = new Transaction();
            $transaction->name          = $recurringTransaction->name;
            $transaction->description   = $recurringTransaction->description;
            $transaction->account_id    = $recurringTransaction->id;
            $transaction->amount        = $recurringTransaction->amount;
            $transaction->user_id       = $recurringTransaction->user_id;
            $transaction->category_id   = $recurringTransaction->category_id;
            $transaction->save();

            $recurringTransaction->remaining = $recurringTransaction->remaining - 1;
            if ($recurringTransaction->remaining == 0) {
                $recurringTransaction->active = false;
                $recurringTransaction->next_date = null;
            } else {
                $recurringTransaction->next_date = Carbon::parse($recurringTransaction->next_date)->addMonths($recurringTransaction->frequency);
            }
            $recurringTransaction->save();
        }
    }
}
