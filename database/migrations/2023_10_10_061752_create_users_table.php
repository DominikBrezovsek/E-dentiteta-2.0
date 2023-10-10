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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id_user')->primary();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('email', 100)->unique();
            $table->time('email_verified_at')->nullable();
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->string('emso', 13)->unique();
            $table->enum('role', ['USR', 'ADM', 'ORG'])->default('USR');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
