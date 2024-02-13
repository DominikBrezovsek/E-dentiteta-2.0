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
        Schema::table('organisations', function (Blueprint $table) {
            $table->renameColumn('id_organisation', 'id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id_user', 'id');
        });
        Schema::table('cards', function (Blueprint $table) {
            $table->renameColumn('id_card', 'id');
        });

        Schema::table('user_cards', function (Blueprint $table) {
            $table->renameColumn('id_user_card', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organisations', function (Blueprint $table) {
            $table->renameColumn('id', 'id_organisation');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id', 'id_user');
        });
        Schema::table('cards', function (Blueprint $table) {
            $table->renameColumn('id', 'id_card');
        });
        Schema::table('organisaton_users', function (Blueprint $table) {
            $table->renameColumn('id', 'id_organisation_users');
        });
        Schema::table('user_cards', function (Blueprint $table) {
            $table->renameColumn('id', 'id_user_card');
        });
    }
};
