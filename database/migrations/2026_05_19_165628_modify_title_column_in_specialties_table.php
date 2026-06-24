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
        // Сбрасываем уникальный индекс только если он действительно есть,
        // иначе миграция падает на БД, где индекса уже нет.
        if (Schema::hasIndex('specialties', ['title'], 'unique')) {
            Schema::table('specialties', function (Blueprint $table) {
                $table->dropUnique(['title']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasIndex('specialties', ['title'], 'unique')) {
            Schema::table('specialties', function (Blueprint $table) {
                $table->unique('title');
            });
        }
    }
};
