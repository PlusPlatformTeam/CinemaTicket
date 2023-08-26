<?php

use App\Models\Ticket;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cinema_id');
            $table->unsignedBigInteger('sans_id');
            $table->unsignedBigInteger('factor_id');
            $table->enum('state', Ticket::STATES)->default(Ticket::VALID);
            $table->integer('code');
            $table->integer('count');
            $table->string('slug', 50)->collation('ascii_bin');
            $table->bigInteger('total_price');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('cinema_id')
                ->references('id')->on('cinemas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('sans_id')
                ->references('id')->on('sans')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('factor_id')
                ->references('id')->on('factors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
