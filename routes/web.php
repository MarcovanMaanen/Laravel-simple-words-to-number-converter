<?php

use App\Http\Controllers\NumberConverterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::controller(NumberConverterController::class)->group(function () {
    Route::get('/','index')
        ->name('index');
    Route::get('/result', 'result')
        ->name('result');
    Route::post('/convert','convert')
        ->name('convert');

});

Route::get('/{locale?}', function (?string $locale = null) {
    if (isset($locale) && in_array($locale, config('locales.locales'))) {
        app()->setLocale($locale);
    }
    return view('/');
})->name('locale');

Route::get('language/{locale}', function (string $locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language');