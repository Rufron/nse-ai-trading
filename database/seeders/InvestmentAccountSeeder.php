<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentAccount;
use App\Models\Investor;

class InvestmentAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Get investors
        $james = Investor::where('email', 'james@example.com')->first();
        $beatrice = Investor::where('email', 'beatrice@example.com')->first();
        $philip = Investor::where('email', 'philip@example.com')->first();

        // Create accounts for James
        InvestmentAccount::create([
            'investor_id' => $james->id,
            'name' => 'NSE Trading Account',
            'account_type' => 'foundation',
            'balance' => 125000,
            'ai_performance' => 15.3,
            'holdings' => ['SCOM' => 1000, 'KCB' => 500]
        ]);

        InvestmentAccount::create([
            'investor_id' => $james->id,
            'name' => 'Dividend Account',
            'account_type' => 'foundation',
            'balance' => 75000,
            'ai_performance' => 8.7,
            'holdings' => ['EQTY' => 300]
        ]);

        // Account for Beatrice
        InvestmentAccount::create([
            'investor_id' => $beatrice->id,
            'name' => 'Growth Portfolio',
            'account_type' => 'economy',
            'balance' => 250000,
            'ai_performance' => 22.1,
            'holdings' => ['SCOM' => 2000, 'EABL' => 500, 'KCB' => 1000]
        ]);

        // Account for Philip
        InvestmentAccount::create([
            'investor_id' => $philip->id,
            'name' => 'Premium Trading',
            'account_type' => 'guardian',
            'balance' => 500000,
            'ai_performance' => 31.5,
            'holdings' => ['SCOM' => 3000, 'EABL' => 1000, 'EQTY' => 2000, 'COOP' => 5000]
        ]);
    }
}