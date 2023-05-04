<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creation de la table labyrinthe
     */
    public function up(): void
    {
        Schema::create('labyrinthe', function (Blueprint $table) {
            $table->id();
            $table->string('labyrinthe_code',100)->unique();
            $table->tinyInteger('lenght');
            $table->tinyInteger('height');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labyrinthe');
    }
};
