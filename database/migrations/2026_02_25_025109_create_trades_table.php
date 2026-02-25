<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investment_account_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['buy', 'sell']);
            $table->string('stock_symbol'); // e.g., 'SCOM', 'KCB'
            $table->integer('shares');
            $table->decimal('price_per_share', 15, 2);
            $table->decimal('amount', 15, 2); // shares * price_per_share
            $table->decimal('ai_confidence', 5, 2)->nullable();
            $table->string('description')->nullable();
            $table->timestamp('traded_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};