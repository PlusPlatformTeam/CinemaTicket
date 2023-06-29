<?php

use App\Models\Movie;
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
        Schema::create('movies', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('slug', 50)->collation('ascii_bin');
            $table->string('title');
            $table->text('info')->nullable();
            $table->integer('duration');
            $table->string('main_banner')->nullable();
            $table->string('second_banner')->nullable();
            $table->enum('state',Movie::STATES)->default(Movie::PLAYING);
            $table->string('director', 50)->nullable();
            $table->string('trailer', 100)->nullable();
            $table->float('score')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
