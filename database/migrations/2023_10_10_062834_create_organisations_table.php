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
        Schema::create('organisations', function (Blueprint $table) {
            $table->uuid('id_organisation')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('verified', ['Y', 'N'])->default('N');
            $table->enum('checkking_all_cards', ['Y', 'N'])->default('N');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};
