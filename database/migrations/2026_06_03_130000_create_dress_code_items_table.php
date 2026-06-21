<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dress_code_items', function (Blueprint $table) {
            $table->id();
            $table->string('group', 16);
            $table->string('text', 500);
            $table->text('note')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['group', 'sort_order']);
        });

        DB::table('dress_code_items')->insert([
            ['group' => 'male',   'text' => 'Деловой классический костюм, классическая рубашка', 'note' => 'В летнее время допускается классическая рубашка с короткими рукавами, а также отсутствие пиджака при температуре выше 25 °C', 'sort_order' => 10, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'male',   'text' => 'Галстук приветствуется', 'note' => null, 'sort_order' => 20, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'male',   'text' => 'Брюки классические, стандартной длины', 'note' => null, 'sort_order' => 30, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'male',   'text' => 'Цвет носков на тон темнее цвета брюк', 'note' => null, 'sort_order' => 40, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'male',   'text' => 'Ботинки и туфли классического стиля', 'note' => null, 'sort_order' => 50, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'male',   'text' => 'Аккуратные волосы', 'note' => null, 'sort_order' => 60, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'male',   'text' => 'Допустимы небольшие аксессуары', 'note' => null, 'sort_order' => 70, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],

            ['group' => 'female', 'text' => 'Классический деловой костюм сдержанных расцветок', 'note' => null, 'sort_order' => 10, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'female', 'text' => 'Юбка сдержанного дизайна и цвета, разрезы не более 15 см', 'note' => null, 'sort_order' => 20, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'female', 'text' => 'Блуза и жакет длины ниже пояса', 'note' => 'Допускаются платья с длинным и средней длины рукавом', 'sort_order' => 30, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'female', 'text' => 'Обязательна аккуратная причёска, длинные волосы должны быть собраны', 'note' => null, 'sort_order' => 40, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'female', 'text' => 'Макияж сдержанный', 'note' => null, 'sort_order' => 50, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'female', 'text' => 'Умеренное использование парфюмерии', 'note' => null, 'sort_order' => 60, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['group' => 'female', 'text' => 'Украшения не броские, небольшие, в разумном количестве', 'note' => null, 'sort_order' => 70, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('dress_code_items');
    }
};
