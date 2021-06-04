<?php

use Illuminate\Support\Facades\Route;

use App\Http\Resources\CurrencyResource;
use App\Models\Currency;

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

Route::get('/', function(){
	return view("home");
});

Route::post("/currency/updateCurrencies", "App\Http\Controllers\CurrencyController@updateCurrencies");

Route::get('/getRate/{name}/{date}', function ($name, $date) {
	return new CurrencyResource(Currency::where("name", $name)
									->where("date", $date)
									->first());
});