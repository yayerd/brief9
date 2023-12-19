<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FormationController;
use Tymon\JWTAuth\Facades\JWTAuth;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'api', 'prefix'=>'auth'], function ($router){
    Route::post('/login', [AuthController::class, 'login']);
});

// -------------------------------------Route de Admin Simplon  ------------------------------------------------------

// Route::middleware(['auth:api', 'role:AdminSimplon'])->group(function () {
    Route::get('/formations/list',[FormationController::class,'index']);
    Route::post('/formation/store',[FormationController::class,'store']);
    Route::get('/formation/show/{id}',[FormationController::class,'show']);
    Route::put('/formation/{formation}/update',[FormationController::class,'update']);
    Route::put('/formation/{formation}/etat',[FormationController::class,'changeEtatFormation']);
    Route::put('/formation/{id}/archive',[FormationController::class,'archiveFormation']);
    Route::post('/formation/{formation}/delete',[FormationController::class,'destroy']);
// });

// -------------------------------------Route Public ------------------------------------------------------

Route::post('/register', [AuthController::class, 'register']);