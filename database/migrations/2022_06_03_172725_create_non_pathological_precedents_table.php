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
        Schema::create('non_pathological_precedents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            
            $table->string('lugar_origen')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('religion')->nullable();
            $table->string('escolaridad')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('lugar_residencia')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('sanguineo')->nullable();
            $table->enum('higiene',  ['0', '1'])->nullable();
            $table->enum('alimentacion',  ['0', '1'])->nullable();
            $table->enum('actividad_fisica',  ['0', '1'])->nullable();
            $table->enum('alcoholismo',  ['0', '1', '2'])->nullable();
            $table->enum('tabaquismo',  ['0', '1', '2'])->nullable();
            $table->enum('drogas',  ['0', '1', '2'])->nullable();
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
        Schema::dropIfExists('non_pathological_precedents');
    }
};
