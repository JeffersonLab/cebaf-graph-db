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
        Schema::create('embeddings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->constrained()->cascadeOnDelete();
            $table->foreignId('data_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
        // once the table is created use a raw query to ALTER it and add the LONGBLOB
        DB::statement('ALTER TABLE embeddings ADD embedding LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('embeddings');
    }
};
