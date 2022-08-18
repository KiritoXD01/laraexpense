<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->foreignId('record_category_id')->references('id')->on('record_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropForeign('record_category_id');
        });
    }
};
