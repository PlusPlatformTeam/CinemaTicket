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
        Schema::create('cinemas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('title', 100);
            $table->unsignedBigInteger('city_id');
            $table->string('banner', 100)->nullable();
            $table->text('address');
            $table->text('description');
            $table->float('score')->default(0);
            $table->json('options')->nullable();
            $table->json('location')->nullable();
            $table->string('phone', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinemas');
    }
};
