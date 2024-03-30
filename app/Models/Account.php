<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
        'category_id',
        'description',
        'main',
        'name',
        'type',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function recurring_transactions()
    {
        return $this->hasMany(RecurringTransaction::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTotalPercent(): float
    {
        $percent = 0;

        foreach ($this->goals as $goal) {
            $percent += $goal->amount > 0 ? ($goal->contributed * 100) / $goal->amount : 0;
        }

        return $this->goals->count() > 0 ? $percent / $this->goals->count() : 0;
    }
}
