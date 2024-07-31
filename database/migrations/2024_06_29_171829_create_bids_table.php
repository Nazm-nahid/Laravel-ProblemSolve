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
       Schema::create('bids', function (Blueprint $table) {
        $table->increments('id');
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('auction_id');
           $table->float('bid_price')->length(10);
           $table->timestamps();

           $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
           $table->foreign('user_id')->references('id')->on('users');
       });
   }


   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
       Schema::dropIfExists('bids');
   }
};
