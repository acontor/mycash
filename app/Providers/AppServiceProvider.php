<?php

namespace App\Providers;

use App\Interfaces\ActivityRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\GoalRepositoryInterface;
use App\Models\Account;
use App\Models\Goal;
use App\Models\RecurringTransaction;
use App\Models\Transaction;
use App\Policies\AccountPolicy;
use App\Policies\GoalPolicy;
use App\Policies\RecurringTransactionPolicy;
use App\Policies\TransactionPolicy;
use App\Repositories\ActivityRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoalRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ActivityRepositoryInterface::class, ActivityRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(GoalRepositoryInterface::class, GoalRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::policy(Account::class, AccountPolicy::class);
        Gate::policy(Goal::class, GoalPolicy::class);
        Gate::policy(RecurringTransaction::class, RecurringTransactionPolicy::class);
        Gate::policy(Transaction::class, TransactionPolicy::class);

        Route::pattern('id', '[0-9]+');
    }
}
