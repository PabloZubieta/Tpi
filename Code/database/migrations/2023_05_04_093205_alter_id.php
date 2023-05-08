<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * altere les tables pour y introduire les clés étrangères
     */
    public function up(): void
    {

        Schema::table('labyrinthe', function (Blueprint $table) {
            $table->foreignid('users_id')->references('id')->on('users');

        });
        Schema::table('users_does_labyrinthe', function (Blueprint $table) {
            $table->foreignId('users_id')->references('id')->on('users');
            $table->foreignid('labyrinthe_id')->references('id')->on('labyrinthe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
