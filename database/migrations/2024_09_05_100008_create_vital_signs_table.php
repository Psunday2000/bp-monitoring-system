<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalSignsTable extends Migration
{
    public function up()
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Reference patient
            $table->foreignId('device_id')->constrained()->onDelete('cascade');  // Reference device
            $table->string('blood_pressure', 10); // e.g., 120/80
            $table->string('pulse_rate', 10); // e.g., 75 bpm
            $table->timestamp('timestamp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vital_signs');
    }
}
