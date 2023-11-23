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
        Schema::create('tb_packages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('package_name');
            $table->integer('package_price');
            $table->string('package_image');
            $table->text('description');
            $table->foreignUuid('id_tailor')->constrained('tb_tailor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_packages');
    }
};
