<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patientId');
            $table->foreign('patientId')->references('id')->on('users')->onDelete('cascade');
            $table->date('dob');
            $table->string('height');
            $table->string('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_infos');
    }
}
