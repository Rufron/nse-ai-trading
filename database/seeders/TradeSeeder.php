<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trade;
use App\Models\InvestmentAccount;

class TradeSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = InvestmentAccount::all();

        foreach ($accounts as $account) {
            // Buy trades
            Trade::create([
                'investment_account_id' => $account->id,
                'type' => 'buy',
                'stock_symbol' => 'SCOM',
                'shares' => 100,
                'price_per_share' => 42.50,
                'amount' => -4250, // Negative for buy (expense)
                'ai_confidence' => 92,
                'description' => 'AI detected buying opportunity',
                'traded_at' => now()->subDays(5)
            ]);

            Trade::create([
                'investment_account_id' => $account->id,
                'type' => 'buy',
                'stock_symbol' => 'KCB',
                'shares' => 200,
                'price_per_share' => 38.75,
                'amount' => -7750,
                'ai_confidence' => 87,
                'description' => 'Volume spike detected',
                'traded_at' => now()->subDays(3)
            ]);

            // Sell trade
            Trade::create([
                'investment_account_id' => $account->id,
                'type' => 'sell',
                'stock_symbol' => 'SCOM',
                'shares' => 50,
                'price_per_share' => 44.30,
                'amount' => 2215, // Positive for sell (income)
                'ai_confidence' => 78,
                'description' => 'Profit taking - AI signal',
                'traded_at' => now()->subDay()
            ]);
        }
    }
}