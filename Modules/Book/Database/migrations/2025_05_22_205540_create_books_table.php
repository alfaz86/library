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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->unique();
            $table->string('publisher')->nullable();
            $table->year('published_year')->nullable();
            $table->string('category')->nullable();
            $table->string('language')->nullable();
            $table->integer('pages')->nullable();
            $table->string('shelf_location')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('available')->default(false);
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
