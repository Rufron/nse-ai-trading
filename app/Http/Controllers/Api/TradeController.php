<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trade;
use App\Models\InvestmentAccount;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    // POST /api/trades
    public function store(Request $request)
    {
        $validated = $request->validate([
            'investment_account_id' => 'required|exists:investment_accounts,id',
            'type' => 'required|in:buy,sell',
            'stock_symbol' => 'required|string',
            'shares' => 'required|integer|min:1',
            'price_per_share' => 'required|numeric|min:0.01',
            'ai_confidence' => 'nullable|numeric|min:0|max:100',
            'description' => 'nullable|string',
            'traded_at' => 'nullable|date'
        ]);

        // Calculate amount (negative for buy, positive for sell)
        $totalAmount = $validated['shares'] * $validated['price_per_share'];
        $validated['amount'] = $validated['type'] === 'buy' ? -$totalAmount : $totalAmount;
        
        // Set traded_at to now if not provided
        if (!isset($validated['traded_at'])) {
            $validated['traded_at'] = now();
        }

        $trade = Trade::create($validated);

        return response()->json([
            'success' => true,
            'data' => $trade
        ], 201);
    }

    // GET /api/trades/recent
    public function recent()
    {
        $trades = Trade::with('investmentAccount.investor')
            ->orderBy('traded_at', 'desc')
            ->limit(20)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $trades
        ]);
    }
}