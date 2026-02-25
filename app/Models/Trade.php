<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = [
        'investment_account_id', 'type', 'stock_symbol', 
        'shares', 'price_per_share', 'amount', 'ai_confidence', 
        'description', 'traded_at'
    ];

    protected $casts = [
        'traded_at' => 'datetime'
    ];

    public function investmentAccount()
    {
        return $this->belongsTo(InvestmentAccount::class);
    }

    // Boot method to handle balance updates
    protected static function booted()
    {
        static::created(function ($trade) {
            $account = $trade->investmentAccount;
            $account->updateBalance($trade->amount);
        });
    }
}