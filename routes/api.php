<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\CandidatureController;
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

// -------------------------------------Route Public ------------------------------------------------------

Route::post('/register', [AuthController::class, 'register']); // Inscription : Enregistre un nouvel utilisateur qui aura le rôle candidat 


// -------------------------------------Route Authentification  ------------------------------------------------------

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']); // Tous les users étant inscrits peuvent se connecter 
});

// -------------------------------------Route de L'Admin Simplon  ------------------------------------------------------


Route::middleware(['auth:api', 'roleAdminSimplon'])->group(function () {

    // -----------------Route pour les Formations  ------------------------------------------------------

    Route::get('/formations/list', [FormationController::class, 'index']); // Affiche toutes les formations 
    Route::post('/formation/store', [FormationController::class, 'store']); // Enregistre une nouvelle formation
    Route::get('/formation/show/{id}', [FormationController::class, 'show']); // Affiche une formation
    Route::put('/formation/{formation}/update', [FormationController::class, 'update']);  // Modifie une formation 
    Route::put('/formation/{formation}/etat', [FormationController::class, 'changeEtatFormation']); // Modifie l'état d'une formation 
    Route::put('/formation/{id}/archive', [FormationController::class, 'archiveFormation']); // Archive une formation 
    Route::post('/formation/{formation}/delete', [FormationController::class, 'destroy']); // Supprime une formation 
    
    // ----------------Route pour les Candidatures  ------------------------------------------------------
   
    Route::get('/candidatures/list', [CandidatureController::class, 'index']);  // Enregistre une nouvelle candidature
    Route::get('/candidature/{formation}', [CandidatureController::class, 'indexOne']); // Affiche les candidature d'une formation 
    Route::get('/candidatures/list/accept', [CandidatureController::class, 'indexAccept']); // Affiche les candidatures acceptées 
    Route::get('/candidatures/list/refuse', [CandidatureController::class, 'indexRefuse']); // Affiche les candidatures refusées
    Route::get('/candidatures/list/attente', [CandidatureController::class, 'indexAttente']); // Affiche les candidatures en attente
    Route::put('/candidature/{formation}/accept', [CandidatureController::class, 'accept']); // Accepte une candidature  
    Route::put('/candidature/{formation}/refuse', [CandidatureController::class, 'refuse']); //  Refuse une candidature  
});

// -------------------------------------Route de Candidat  ------------------------------------------------------

Route::middleware(['auth:api', 'roleCandidat'])->group(function () {
    Route::post('/candidature/store/{formation}', [CandidatureController::class, 'store']); // Enregistre une candidature 
});
