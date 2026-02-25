<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'tier', 'ai_trading_enabled'];

    public function investmentAccounts()
    {
        return $this->hasMany(InvestmentAccount::class);
    }

    // Accessor for total portfolio value
    public function getTotalPortfolioValueAttribute()
    {
        return $this->investmentAccounts->sum('balance');
    }
}