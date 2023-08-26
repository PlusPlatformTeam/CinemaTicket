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
        Schema::create('sans', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('cinema_id');
            $table->unsignedBigInteger('movie_id');
            $table->unsignedBigInteger('hall_id');
            $table->timestamp('started_at');
            $table->integer('price');
            $table->string('slug', 50)->collation('ascii_bin');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sans');
    }
};
