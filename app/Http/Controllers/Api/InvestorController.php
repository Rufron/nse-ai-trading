<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Investor;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    // GET /api/investors
    public function index()
    {
        $investors = Investor::with('investmentAccounts')->get();
        
        // Add total portfolio value to each investor
        $investors->each(function ($investor) {
            $investor->total_portfolio_value = $investor->totalPortfolioValue;
        });
        
        return response()->json([
            'success' => true,
            'data' => $investors
        ]);
    }

    // POST /api/investors
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:investors',
            'phone' => 'nullable|string',
            'tier' => 'required|in:foundation, economy, guardian'
        ]);

        $investor = Investor::create($validated);

        return response()->json([
            'success' => true,
            'data' => $investor
        ], 201);
    }

    // GET /api/investors/{investor}
    public function show(Investor $investor)
    {
        $investor->load('investmentAccounts');
        $investor->total_portfolio_value = $investor->totalPortfolioValue;

        return response()->json([
            'success' => true,
            'data' => $investor
        ]);
    }

    // GET /api/investors/{investor}/portfolio
    public function portfolio(Investor $investor)
    {
        $investor->load('investmentAccounts.trades');
        $investor->total_portfolio_value = $investor->totalPortfolioValue;

        return response()->json([
            'success' => true,
            'data' => $investor
        ]);
    }
}