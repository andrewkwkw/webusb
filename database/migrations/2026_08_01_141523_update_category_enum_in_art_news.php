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
        DB::statement("ALTER TABLE art_news MODIFY COLUMN category ENUM('Berita Kampus', 'Berita Seni', 'Agenda', 'Festival', 'Pameran', 'Seni Musik', 'Seni Rupa', 'Seni Teater') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE art_news MODIFY COLUMN category ENUM('Berita Kampus', 'Berita Seni', 'Agenda', 'Festival', 'Pameran') NOT NULL");
    }
};
