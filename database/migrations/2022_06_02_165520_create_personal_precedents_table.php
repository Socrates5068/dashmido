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
        Schema::create('personal_precedents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

            $table->longText('eruptivos')->nullable();
            $table->longText('transfusionales')->nullable();
            $table->longText('infecciosos')->nullable();
            $table->longText('alergicos')->nullable();
            $table->longText('traumaticos')->nullable();
            $table->longText('quirurgicos')->nullable();
            $table->longText('tumorales')->nullable();
            $table->longText('enfermedades')->nullable();
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
        Schema::dropIfExists('personal_precedents');
    }
};
