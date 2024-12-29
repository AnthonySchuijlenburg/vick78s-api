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
        Schema::drop('news_items');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('news_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('slug')->unique();
            $table->json('content');
            $table->dateTime('published_at');
            $table->timestamps();
        });
    }
};
