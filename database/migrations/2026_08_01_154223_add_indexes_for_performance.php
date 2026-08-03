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
        Schema::table('artworks', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('is_featured');
            $table->index('slug');
        });

        Schema::table('art_news', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('is_highlight');
            $table->index('category');
            $table->index('slug');
        });

        Schema::table('cultural_explorations', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('slug');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('slug');
        });

        Schema::table('organization_members', function (Blueprint $table) {
            $table->index('order_column');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['is_featured']);
            $table->dropIndex(['slug']);
        });

        Schema::table('art_news', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['is_highlight']);
            $table->dropIndex(['category']);
            $table->dropIndex(['slug']);
        });

        Schema::table('cultural_explorations', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['slug']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['slug']);
        });

        Schema::table('organization_members', function (Blueprint $table) {
            $table->dropIndex(['order_column']);
        });
    }
};
