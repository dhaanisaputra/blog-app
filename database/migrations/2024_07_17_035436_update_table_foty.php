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
        Schema::table('foties', function (Blueprint $table) {
            // $table->tinyInteger('status_foty')->default('0')->comment('0=hidden, 1=visible');
            $table->text('url_social_media')->nullable()->after('featured_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foties', function (Blueprint $table) {
            // $table->dropColumn('status_foty');
            $table->dropColumn('url_social_media');
        });
    }
};
