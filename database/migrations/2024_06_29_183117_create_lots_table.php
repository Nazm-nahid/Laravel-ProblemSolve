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
       Schema::create('lots', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedBigInteger('user_id');
           $table->string('cultiver_type');
           $table->string('planted_country');
           $table->integer('total_weight')->length(10);
           $table->date('harvest_date');
           $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users');
       });
   }


   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
       Schema::dropIfExists('lots');
   }
};
