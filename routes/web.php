<?php

use App\Models\Area;
use App\Models\Category;
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
Route::get('test', function () {
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
        dd($data);
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
