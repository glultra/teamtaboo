<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('player_in_game', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('player_id');
            $table->string('joined_as')->default('guest');
            $table->integer('position')->default(8); // Add the position column
            $table->integer('score')->nullable(); // If you want to store player scores
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign key constraints first
        Schema::table('player_in_game', function (Blueprint $table) {
            $table->dropForeign(['game_id']);
            $table->dropForeign(['player_id']);
        });

        Schema::dropIfExists('player_in_game');    }
};
