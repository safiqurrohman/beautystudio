<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_custemer')->constrained('custemer')->onDelete('cascade');
            $table->foreignId('id_treatment')->constrained('treatment')->onDelete('cascade');
            $table->decimal('harga', 50, 2);
            $table->decimal('komisi', 50, 2);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_laporan');
    }
};
