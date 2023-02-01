<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idMeal');
            $table->string('strMeal')->fulltext()->nullable();
            $table->string('strDrinkAlternate')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('area_id')->constrained()->cascadeOnDelete();
            $table->text('strInstructions')->nullable();
            $table->string('strMealThumb')->nullable();
            $table->string('strTags')->fulltext()->nullable();
            $table->string('strYoutube')->nullable();
            $table->string('strSource')->nullable();
            $table->string('strImageSource')->nullable();
            $table->string('strCreativeCommonsConfirmed')->nullable();
            $table->string('dateModified')->nullable();
            $table->string('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
};