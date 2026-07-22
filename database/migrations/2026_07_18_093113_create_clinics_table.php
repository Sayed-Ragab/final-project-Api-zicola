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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id(); 
            $table->string('name');
            $table->string('phone')->nullable(); 
            $table->text('address')->nullable();
            $table->unsignedInteger('max_doctors');
            $table->date('payment_date')->nullable();
           $table->enum('status', ['active', 'suspended'])->default('active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
