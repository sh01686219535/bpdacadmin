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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('resetLink')->nullable();
            $table->string('phone');
            $table->string('specialist')->nullable();
            $table->string('working_place')->nullable();
            $table->string('address');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->enum('email_verified',['yes','no'])->default('no');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('confirm_password');
            $table->enum('status',['pending','approved','declined'])->default('pending');
            $table->enum('user_status', ['userEnable', 'userDisable'])->default('userEnable');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
