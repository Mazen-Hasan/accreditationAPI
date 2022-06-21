<?php

use App\Http\Controllers\eventController;
use App\Http\Controllers\userController;
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

Route::group(['prefix'=>'user','as'=>'user/'], function(){
    Route::post('getByID', [userController::class,'getByID']);

    Route::post('create', [userController::class,'create']);

    Route::post('enable', [userController::class,'enable']);

    Route::post('disable', [userController::class,'disable']);

    Route::post('login', [userController::class,'login']);
});

Route::group(['prefix'=>'event','as'=>'event/'], function(){
    Route::post('getByID', [eventController::class,'getByID']);

    Route::post('create', [eventController::class,'create']);

    Route::post('enable', [eventController::class,'enable']);

    Route::post('disable', [eventController::class,'disable']);

    Route::post('getList', [eventController::class,'getList']);
});



Route::get('/test', function (Request $request){
    return 'test';
});

Route::middleware('auth:sanctum')->get('/userController', function (Request $request) {
    return $request->user();
});
