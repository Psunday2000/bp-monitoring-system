<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_type', 50);
            $table->string('device_model', 50);
            $table->string('manufacturer', 100);
            $table->date('installation_date')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // Reference patient
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
