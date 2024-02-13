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
        Schema::table('users', function (Blueprint $table){
            $table->string('username')->charset('utf8')->collation('utf8_bin')->change();
        });
        Schema::table('users', function (Blueprint $table){
            $table->string('password')->charset('utf8')->collation('utf8_bin')->change();
        });
        Schema::table('users', function (Blueprint $table){
            $table->string('email')->charset('utf8')->collation('utf8_bin')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table){
            $table->string('username')->change();
        });
        Schema::table('users', function (Blueprint $table){
            $table->string('password')->change();
        });
        Schema::table('users', function (Blueprint $table){
            $table->string('email')->change();
        });
    }
};
