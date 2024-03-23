<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'balance',
        'user_id',
        'main',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function recurring_transactions()
    {
        return $this->hasMany(RecurringTransaction::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
