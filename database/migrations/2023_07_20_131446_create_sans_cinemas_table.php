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
        Schema::create('sans_cinemas', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('sans_id');
            $table->unsignedBigInteger('cinema_id');

            $table->foreign('cinema_id')
                ->references('id')->on('cinemas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('sans_id')
                ->references('id')->on('sans')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sans_cinemas');
    }
};
