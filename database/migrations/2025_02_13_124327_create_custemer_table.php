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
        Schema::create('custemer', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama'); // Nama customer
            $table->string('phone');
            $table->text('address');
            $table->foreignId('id_karyawan')->constrained('users')->onDelete('cascade'); // FK ke karyawan
            $table->foreignId('id_treatment')->constrained('treatment')->onDelete('cascade'); // FK ke treatment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custemer');
    }
};
