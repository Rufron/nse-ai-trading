<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvestmentAccount;
use Illuminate\Http\Request;

class InvestmentAccountController extends Controller
{
    // GET /api/investment-accounts
    public function index()
    {
        $accounts = InvestmentAccount::with('investor')->get();
        
        return response()->json([
            'success' => true,
            'data' => $accounts
        ]);
    }

    // POST /api/investment-accounts
    public function store(Request $request)
    {
        $validated = $request->validate([
            'investor_id' => 'required|exists:investors,id',
            'name' => 'required|string|max:255',
            'account_type' => 'required|in:foundation, economy, guardian',
            'balance' => 'numeric|min:0',
            'ai_performance' => 'nullable|numeric',
            'holdings' => 'nullable|array'
        ]);

        $account = InvestmentAccount::create($validated);

        return response()->json([
            'success' => true,
            'data' => $account
        ], 201);
    }

    // GET /api/investment-accounts/{investment_account}
    public function show(InvestmentAccount $investmentAccount)
    {
        $investmentAccount->load('investor', 'trades');
        
        return response()->json([
            'success' => true,
            'data' => $investmentAccount
        ]);
    }

    // GET /api/investment-accounts/{investment_account}/trades
    public function trades(InvestmentAccount $investmentAccount)
    {
        $trades = $investmentAccount->trades()->orderBy('traded_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'data' => $trades
        ]);
    }
}