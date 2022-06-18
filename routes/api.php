<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\venue;
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

Route::group(['prefix'=>'venue','as'=>'venue/'], function(){
    Route::post('getByID', [venue::class,'getByID']);

    Route::post('create', [venue::class,'create']);

    Route::post('enable', [venue::class,'enable']);

    Route::post('disable', [venue::class,'disable']);

    Route::post('update', [venue::class,'update']);
});



Route::get('/test', function (Request $request){
    return 'test';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
