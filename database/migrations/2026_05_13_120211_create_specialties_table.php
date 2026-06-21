<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('code', 10);
            $table->unsignedSmallInteger('budget_places');
            $table->unsignedSmallInteger('commercial_places');
            $table->unsignedInteger('price_per_year');


            $table->foreignId('cycle_commission_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();



            $table->string('duration', 50);
            $table->enum('study_form', ['full_time', 'online'])
                ->default('full_time');

            // Описания
            $table->text('description_title');
            $table->text('description');

            // Списки (JSON)
            $table->json('stacks')->nullable();
            $table->json('skills')->nullable();
            $table->json('careers')->nullable();
            $table->json('core_subjects')->nullable();

            $table->string('image')->nullable();
            $table->string('specialty_document')->nullable();

            // Управление
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialties');
    }
};
