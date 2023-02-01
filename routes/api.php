<?php

use App\Http\Resources\{MealsResource,MealResource};
use App\Models\Area;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/meals', function () {
    return MealsResource::collection(Meal::paginate(10));
});

Route::get('/categories/{category:strCategory}/meals', function (Category $category) {
    return MealsResource::collection($category->meals()->paginate(10));
});

Route::get('/areas/{area:area}/meals', function (Area $area) {

    return MealsResource::collection($area->meals()->paginate(10));
});

Route::get('/ingredients/{ingredients:strIngredientSlug}/meals', function (Ingredient $ingredient) {

    return MealsResource::collection($ingredient->meals()->paginate(10));
});

Route::get('/meals/{meal}', function (Meal $meal) {
    return new MealResource($meal);
});
