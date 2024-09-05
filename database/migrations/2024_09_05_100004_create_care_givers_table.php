<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareGiversTable extends Migration
{
    public function up()
    {
        Schema::create('caregivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference user
            $table->string('specialization', 100)->nullable();
            $table->string('license_number', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('caregivers');
    }
}
