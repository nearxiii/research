<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researchs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('researcher_name');
            $table->string('researcher_address');
            $table->string('type_spacimen');
            $table->string('type_animal');
            $table->string('researcher_sent');
            $table->string('researcher_stat');
            $table->string('researcher_medtech');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('researchs');
    }
}
