<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('newcomer', ['yes', 'no'])->nullable();
            $table->enum('enrolledInResidency', ['yes', 'no'])->nullable();
            $table->enum('practiceReadyPathway', ['yes', 'no'])->nullable();
            $table->enum('completedLicensingExams', ['yes', 'no'])->nullable();
            $table->enum('allied_health', ['yes', 'no'])->nullable();
            $table->enum('Bangladeshi_medical', ['yes', 'no'])->nullable();
            $table->enum('practice_ph_dn', ['yes', 'no'])->nullable();
            $table->string('specify_industry')->nullable();
            $table->string('medical_college')->nullable();
            $table->string('year_of_graduation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
