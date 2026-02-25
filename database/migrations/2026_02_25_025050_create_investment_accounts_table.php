<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investment_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investor_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('account_type', ['foundation', 'economy', 'guardian'])->default('foundation');
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('ai_performance', 5, 2)->nullable();
            $table->json('holdings')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investment_accounts');
    }
};