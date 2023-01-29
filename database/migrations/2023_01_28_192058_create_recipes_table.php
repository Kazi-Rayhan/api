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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idMeal');
            $table->string('strMeal')->fulltext();
            $table->string('strDrinkAlternate')->nullable();
            $table->string('strCategory')->nullable();
            $table->string('strArea')->nullable();
            $table->text('strInstructions')->nullable();
            $table->string('strMealThumb')->nullable();
            $table->string('strTags')->nullable();
            $table->string('strYoutube')->nullable();
            $table->string('strIngredient1')->nullable();
            $table->string('strIngredient2')->nullable();
            $table->string('strIngredient3')->nullable();
            $table->string('strIngredient4')->nullable();
            $table->string('strIngredient5')->nullable();
            $table->string('strIngredient6')->nullable();
            $table->string('strIngredient7')->nullable();
            $table->string('strIngredient8')->nullable();
            $table->string('strIngredient9')->nullable();
            $table->string('strIngredient10')->nullable();
            $table->string('strIngredient11')->nullable();
            $table->string('strIngredient12')->nullable();
            $table->string('strIngredient13')->nullable();
            $table->string('strIngredient14')->nullable();
            $table->string('strIngredient15')->nullable();
            $table->string('strIngredient16')->nullable();
            $table->string('strIngredient17')->nullable();
            $table->string('strIngredient18')->nullable();
            $table->string('strIngredient19')->nullable();
            $table->string('strIngredient20')->nullable();
            $table->string('strMeasure1')->nullable();
            $table->string('strMeasure2')->nullable();
            $table->string('strMeasure3')->nullable();
            $table->string('strMeasure4')->nullable();
            $table->string('strMeasure5')->nullable();
            $table->string('strMeasure6')->nullable();
            $table->string('strMeasure7')->nullable();
            $table->string('strMeasure8')->nullable();
            $table->string('strMeasure9')->nullable();
            $table->string('strMeasure10')->nullable();
            $table->string('strMeasure11')->nullable();
            $table->string('strMeasure12')->nullable();
            $table->string('strMeasure13')->nullable();
            $table->string('strMeasure14')->nullable();
            $table->string('strMeasure15')->nullable();
            $table->string('strMeasure16')->nullable();
            $table->string('strMeasure17')->nullable();
            $table->string('strMeasure18')->nullable();
            $table->string('strMeasure19')->nullable();
            $table->string('strMeasure20')->nullable();
            $table->string('strSource')->nullable();
            $table->string('strImageSource')->nullable();
            $table->string('strCreativeCommonsConfirmed')->nullable();
            $table->string('dateModified')->nullable();
            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('recipes');
    }
};
