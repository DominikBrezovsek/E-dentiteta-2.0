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
        Schema::create('classes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->index();
            $table->uuid('id_teacher');
            $table->uuid('id_card');
            $table->uuid('id_organisation');
            $table->timestamps();

            $table->foreign('id_teacher')->references('id')->on('teachers')->onUpdate('cascade');
            $table->foreign('id_organisation')->references('id_organisation')->on('organisations')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
