<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->date('budget_from')->nullable()->after('email');
            $table->date('budget_to')->nullable()->after('budget_from');
            $table->date('commerce_from')->nullable()->after('budget_to');
            $table->date('commerce_to')->nullable()->after('commerce_from');
        });
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropColumn(['deadline_budget', 'term_commerce']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->string('deadline_budget')->nullable()->after('email');
            $table->string('term_commerce')->nullable()->after('deadline_budget');
        });
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropColumn(['budget_from', 'budget_to', 'commerce_from', 'commerce_to']);
        });
    }
};
