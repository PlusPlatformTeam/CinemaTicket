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
        Schema::create('cities', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('title', 50);
            $table->unsignedBigInteger('province_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('province_id')
                ->references('id')->on('provinces')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
