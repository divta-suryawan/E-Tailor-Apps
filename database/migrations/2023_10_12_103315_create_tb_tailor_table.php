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
        
        Schema::create('tb_tailor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('tailor_name');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('tailor_img');
            $table->foreignUuid('id_user')->constrained('users');
            // $table->unsignedBigInteger('id_user');
            // $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tailor');
    }
};
