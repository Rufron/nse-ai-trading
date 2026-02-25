<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvestmentAccount extends Model
{
    protected $fillable = ['investor_id', 'name', 'account_type', 'balance', 'ai_performance', 'holdings'];
    
    protected $casts = [
        'holdings' => 'array'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }

    // Update balance when trade occurs
    public function updateBalance($amount)
    {
        $this->balance += $amount;
        $this->save();
    }
}