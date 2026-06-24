<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('specialties', 'slug')) {
            Schema::table('specialties', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique()->after('title');
            });
        }

        // Бэкфилл: генерируем слаг из названия для всех специальностей без слага.
        // Уже существующие слаги учитываем, чтобы не создать дубликат.
        $used = DB::table('specialties')->whereNotNull('slug')->pluck('slug')->all();

        DB::table('specialties')
            ->whereNull('slug')
            ->orderBy('id')
            ->get(['id', 'title'])
            ->each(function ($row) use (&$used) {
                $base = Str::slug($row->title) ?: 'speciality';
                $slug = $base;
                $i = 2;

                while (in_array($slug, $used, true)) {
                    $slug = $base . '-' . $i;
                    $i++;
                }

                $used[] = $slug;

                DB::table('specialties')->where('id', $row->id)->update(['slug' => $slug]);
            });
    }

    public function down(): void
    {
        if (Schema::hasColumn('specialties', 'slug')) {
            Schema::table('specialties', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }
    }
};
