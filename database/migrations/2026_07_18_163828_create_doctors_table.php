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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');

            $table->string('national_id')->unique();
            $table->string('medical_license')->unique();

            $table->string('specialization');

            $table->enum('gender', ['male', 'female']);

            $table->date('date_of_birth');

            $table->string('blood_type');

            $table->string('address');

            $table->enum('status', ['active', 'suspended'])
                ->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
