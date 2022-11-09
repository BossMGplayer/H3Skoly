<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('lunch_id');
            $table->unsignedInteger('food_rating');
            $table->unsignedInteger('hygiene_rating');
            $table->unsignedInteger('food_variations_rating');
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->index('lunch_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_ratings');
    }
}
