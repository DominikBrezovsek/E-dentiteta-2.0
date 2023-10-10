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
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id_card')->primary();
            $table->uuid('id_organisation');
            $table->string('name', 50);
            $table->string('description', 100)->nullable();
            
            $table->timestamps();

            $table->foreign('id_organisation')->references('id_organisation')->on('organisations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
