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
        Schema::create('data_sets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('config_id')->constrained();
            $table->string('label', 20)->nullable();
            $table->timestamp('begin_at')->useCurrent();
            $table->timestamp('end_at')->nullable();
            $table->string('interval',20);
            $table->string('mya_deployment',20);
            $table->string('ced_workspace',40)->nullable();
            $table->string('status');
            $table->text('comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_sets');
    }
};
