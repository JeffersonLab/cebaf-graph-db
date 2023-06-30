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
        Schema::create('table_data_set_model', function (Blueprint $table) {
            $table->foreignId('model_id')->constrained()->cascadeOnDelete();
            $table->foreignId('data_set_id')->constrained()->cascadeOnDelete();
            $table->string('purpose',20);
            $table->primary(['model_id','data_set_id','purpose']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_data_set_model');
    }
};
