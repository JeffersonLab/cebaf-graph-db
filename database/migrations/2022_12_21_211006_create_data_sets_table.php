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
    public function up()
    {
        Schema::create('data_sets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('config_id')->constrained();
            $table->string('purpose',20);
            $table->string('label',20)->nullable();
            $table->timestamp('begin_at');
            $table->timestamp('end_at')->nullable();
            $table->string('interval',20)->default('1h');
            $table->string('status')->default('NEW');
            $table->text('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_sets');
    }
};
