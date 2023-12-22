<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Auth;
// use Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request)
    {

        // dd("super");

        // return "register succesfully";      

        try {
            $user = new User();

            $id_candidat = Role::where("nom", "Candidat")->get()->first()->id;

            $user->role_id = $id_candidat;
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->date_naissance = $request->date_naissance;
            $user->password = Hash::make(
                $request->password
            );
            //  dd('MERCI');
            $user->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => "Utilisateur enregistré avec succès",
                'user' => $user
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }


    public function login(LoginRequest $request)
    {

        // dd('okaaaay');
        if (!$token = auth()->attempt($request->only(['username', 'password']))) {
            return response()->json([
                'error' => 'Identifiants invalides'
            ], 401);
        }
        $user = auth()->user();

        return response()->json([
            'status_code' => 200,
            'status_message' => [$request->username, 'Utilisateur connecté'],
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 120
        ]);
    }

    
}
