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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->integer('category_id')->nullable();
            $table->string('image_file', 255);
            $table->string('description', 2000);
            $table->string( 'tags', 255);
            $table->string('meta_description', 255);
            $table->string('meta_keywords', 255);
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_publish')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
