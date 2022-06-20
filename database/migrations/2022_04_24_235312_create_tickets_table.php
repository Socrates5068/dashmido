<?php

use App\Models\Ticket;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('time');
            $table->enum('status',  ['0', '1', '2', '3', '4'])->default('0'); // booked or not booked
            $table->string('patient_id')->nullable();
            $table->string('staff_id');
            $table->string('department_id');
            // $table->integer('price')->default(Ticket::PRICE);
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
        Schema::dropIfExists('tickets');
    }
};
