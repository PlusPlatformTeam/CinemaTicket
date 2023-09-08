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
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('movie_id')->nullable();
            $table->unsignedBigInteger('cinema_id')->nullable();
            $table->unsignedBigInteger('hall_id')->nullable();

            $table->foreign('movie_id')
                ->references('id')->on('movies')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cinema_id')
                ->references('id')->on('cinemas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('hall_id')
                ->references('id')->on('halls')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_logs', function (Blueprint $table) {
            $table->dropColumn('movie_id');
            $table->dropColumn('cinema_id');
            $table->dropColumn('hall_id');
        });
    }
};
