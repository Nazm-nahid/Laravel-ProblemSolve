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
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lot_id');
            $table->float('bid_price')->length(10);
            $table->integer('duration')->length(10);
            $table->date('auction_date');
            $table->boolean('auction_status');
            $table->timestamps();

            $table->foreign('lot_id')->references('id')->on('lots');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
