<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Investor;

class InvestorSeeder extends Seeder
{
    public function run(): void
    {
        Investor::create([
            'name' => 'James Rugiri',
            'email' => 'james@example.com',
            'phone' => '0712345678',
            'tier' => 'foundation',
            'ai_trading_enabled' => true
        ]);

        Investor::create([
            'name' => 'Beatrice Wanjiku',
            'email' => 'beatrice@example.com',
            'phone' => '0723456789',
            'tier' => 'economy',
            'ai_trading_enabled' => true
        ]);

        Investor::create([
            'name' => 'Philip Kariuki',
            'email' => 'philip@example.com',
            'phone' => '0734567890',
            'tier' => 'guardian',
            'ai_trading_enabled' => true
        ]);
    }
}