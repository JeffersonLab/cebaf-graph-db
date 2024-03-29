<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_set_id')->constrained()->cascadeOnDelete();
            $table->timestamp('timestamp');
            $table->string('label')->nullable();
            $table->json('globals');
            $table->unique(['data_set_id', 'timestamp']);
        });

        // once the table is created use a raw query to ALTER it and add the MEDIUMBLOB
        DB::statement('ALTER TABLE data ADD graph MEDIUMBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
