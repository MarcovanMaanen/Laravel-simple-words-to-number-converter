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
Route::get(
    '/',
    [NumberConverterController::class, 'index']
)->name('index');
Route::get(
    '/result',
    [NumberConverterController::class, 'result']
)->name('result');

Route::post(
    '/convert',
    [NumberConverterController::class, 'convert']
)->name('convert');

Route::get('/{locale?}', function ($locale = null) {
    if (isset($locale) && in_array($locale, config('locales.locales'))) {
        app()->setLocale($locale);
    }
    return view('/');
});

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});