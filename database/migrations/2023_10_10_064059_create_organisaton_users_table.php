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
        Schema::create('organisaton_users', function (Blueprint $table) {
            $table->uuid('id_organisation_users')->primary();
            $table->uuid('id_organisation');
            $table->uuid('id_user');

            $table->timestamps();

            $table->foreign('id_organisation')->references('id_organisation')->on('organisations')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisaton_users');
    }
};
