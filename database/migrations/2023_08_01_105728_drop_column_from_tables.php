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
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('score');
        });
        Schema::table('cinemas', function (Blueprint $table) {
            $table->dropColumn('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->float('score')->default(0);
        });
        Schema::table('cinemas', function (Blueprint $table) {
            $table->float('score')->default(0);
        });
    }
};
