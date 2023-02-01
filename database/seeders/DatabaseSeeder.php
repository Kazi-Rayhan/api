<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Area;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $areas = json_decode(Http::get('https://www.themealdb.com/api/json/v1/1/list.php?a=list')->body())->meals;
        $ingredients = json_decode(Http::get('www.themealdb.com/api/json/v1/1/list.php?i=list')->body())->meals;
        $categories = json_decode(Http::get('https://www.themealdb.com/api/json/v1/1/categories.php')->body())->categories;
        foreach ($areas as $area) {
            Area::create(['area' => $area->strArea]);
        }

        foreach ($categories as $category) {
            Category::updateOrCreate(['idCategory' => $category->idCategory], (array) $category);
        }

        foreach ($ingredients as $ingredient) {
            $ingredientarray = (array) $ingredient;
            $ingredientarray['strIngredientSlug'] = Str::slug($ingredient->strIngredient);

            Ingredient::updateOrCreate(['idIngredient' => $ingredient->idIngredient], $ingredientarray);
        }
       

        for ($mealid = 52764; $mealid <= 53065; $mealid++) {

            $meal = json_decode(Http::get('https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $mealid)->body())->meals;
            if ($meal) $meal = $meal[0];

            if (empty($meal)) continue;

            $category = Category::where('strCategory', $meal->strCategory)->first();
            $area = Area::where('area', $meal->strArea)->first();

            $mealModel = Meal::updateOrCreate(['idMeal' => $meal->idMeal], [
                'idMeal' => $meal->idMeal,
                'strMeal' => $meal->strMeal,
                'category_id' => $category->id,
                'area_id' => $area->id,
                'strDrinkAlternate' => $meal->strDrinkAlternate,
                'strInstructions' => $meal->strInstructions,
                'strMealThumb' => $meal->strMealThumb,
                'strTags' => $meal->strTags,
                'strYoutube' => $meal->strYoutube,
                'strSource' => $meal->strSource,
                'strImageSource' => $meal->strImageSource,
                'strCreativeCommonsConfirmed' => $meal->strCreativeCommonsConfirmed,
                'dateModified' => $meal->dateModified
            ]);
            $array = [];
            for ($i = 1; $i <= 20; $i++) {
                $Measure = ((array) $meal)['strMeasure' . $i];
                $ingredients = ((array) $meal)['strIngredient' . $i];
                if (!empty(((array) $meal)['strIngredient' . $i])) {
                    $ingredient = Ingredient::where('strIngredient', $ingredients)->first();
                    if (isset($ingredient->id)) {
                        $array[$ingredient->id] = ['measurement' => $Measure];
                    }
                }
            }

            $mealModel->ingredients()->attach($array);
        }
        return 'success';
    }
}
