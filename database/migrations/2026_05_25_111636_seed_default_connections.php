<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            'Заголовок баннера'    => 'Приемная комиссия',
            'Подзаголовок баннера' => 'Чемпионами становятся здесь!',
        ];

        $now = now();

        foreach ($defaults as $title => $value) {
            DB::table('connections')->updateOrInsert(
                ['title' => $title],
                [
                    'value'      => $value,
                    'updated_at' => $now,
                    'created_at' => $now,
                ],
            );
        }
    }

    public function down(): void
    {
        DB::table('connections')
            ->whereIn('title', ['Заголовок баннера', 'Подзаголовок баннера'])
            ->delete();
    }
};
