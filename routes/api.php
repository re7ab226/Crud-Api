<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PropertiesControler;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::prefix('properties')->group(function () {
    Route::get('/index', [PropertiesControler::class, 'index']);
    Route::get('/show/{id}', [PropertiesControler::class, 'show']);
    Route::post('/store', [PropertiesControler::class, 'store']);
    Route::put('/update/{id}', [PropertiesControler::class, 'update']);
    Route::delete('/destroy/{id}', [PropertiesControler::class, 'destroy']);
    
    //Route::put('/edit/{id}', [PropertiesControler::class, 'edit']);
});

