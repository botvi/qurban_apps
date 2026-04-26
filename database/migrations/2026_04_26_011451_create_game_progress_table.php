<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('game_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('level');          // nomor level (1-8)
            $table->integer('stars')->default(0); // 1-3 bintang
            $table->integer('best_moves')->nullable();
            $table->string('best_time')->nullable(); // format "m:ss"
            $table->boolean('unlocked')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'level']); // satu record per user per level
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_progress');
    }
};
