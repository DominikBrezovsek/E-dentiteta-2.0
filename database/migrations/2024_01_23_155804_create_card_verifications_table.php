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
        Schema::create('card_verifications', function (Blueprint $table) {
            $table->uuid('id_verify')->primary();
            $table->uuid('id_user');
            $table->uuid('id_card');
            $table->string('check_seq');
            $table->integer('expires')->default(time() + 2*60*60);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_card')->references('id')->on('cards')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_verifications');
    }
};
