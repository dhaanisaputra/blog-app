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
        Schema::create('foties', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->nullable();
            $table->string('name_foty')->nullable();
            $table->string('post_slug')->nullable();
            $table->text('post_content')->nullable();
            $table->integer('year_foty')->nullable();
            $table->string('featured_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foties');
    }
};
