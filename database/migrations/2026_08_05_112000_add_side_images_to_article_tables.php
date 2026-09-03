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
        $tables = [
            'art_news' => 'image_path',
            'cultural_explorations' => 'image_path',
            'artworks' => 'images',
            'projects' => 'cover_image_path'
        ];

        foreach ($tables as $tableName => $afterColumn) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName, $afterColumn) {
                if (!Schema::hasColumn($tableName, 'left_image')) {
                    $table->string('left_image')->nullable()->after($afterColumn);
                }
                if (!Schema::hasColumn($tableName, 'right_image')) {
                    $table->string('right_image')->nullable()->after('left_image');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['art_news', 'cultural_explorations', 'artworks', 'projects'];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn(['left_image', 'right_image']);
            });
        }
    }
};
