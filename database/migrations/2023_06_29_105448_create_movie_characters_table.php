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
        Schema::create('video_characters', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('character_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('character_id')
                ->references('id')->on('characters')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_characters');
    }
};
