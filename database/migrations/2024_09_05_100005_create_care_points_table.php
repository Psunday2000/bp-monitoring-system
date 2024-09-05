<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarePointsTable extends Migration
{
    public function up()
    {
        Schema::create('care_points', function (Blueprint $table) {
            $table->id();
            
            // Explicitly specify the table name for the foreign key constraints
            $table->foreignId('caregiver_id')->constrained('caregivers')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('care_points');
    }
}
