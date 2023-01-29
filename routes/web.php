<?php

use App\Models\Area;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Recipe;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('fetch-areas', function () {
    $test = Http::get('https://www.themealdb.com/api/json/v1/1/list.php?a=list')->body();
    $data = json_decode($test)->meals;
    foreach ($data as $meal) {
        Area::create(['area' => $meal->strArea]);
    }
});

Route::get('fetch-recepies', function () {
    for ($i = 52764; $i <= 53065; $i++) {
        $data = json_decode(Http::get('https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $i)->body())->meals;
        if ($data) $data = $data[0];

        if (empty($data)) continue;

        Recipe::updateOrCreate(['idMeal' =>  $data->idMeal], (array)$data);
    }
    return 'success';
});

Route::get('fetch-categories', function () {
    $data = json_decode(Http::get('https://www.themealdb.com/api/json/v1/1/categories.php')->body())->categories;
    foreach ($data as $category) {
        Category::updateOrCreate(['idCategory' => $category->idCategory], (array) $category);
    }
    return 'success';
});
Route::get('fetch-meals', function () {

    for ($i = 52764; $i <= 53065; $i++) {
        $meal = json_decode(Http::get('https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $i)->body())->meals;
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
                array_push($array, ['strIngredient' => $ingredients, 'strMeasure' => $Measure]);
            }
        }
        // return $array;
    }
    return 'success';
});
Route::get('fetch-ingredients', function () {

    $data = json_decode(Http::get('www.themealdb.com/api/json/v1/1/list.php?i=list')->body())->meals;


    foreach ($data as $ingredients) {
        Ingredient::updateOrCreate(['idIngredient' => $ingredients->idIngredient], (array) $ingredients);
    }

    return 'success';
});