<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Formation;
use Exception;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            $user_id = auth()->user()->id;
            $candidatures = Candidature::all();
            // $candidatures->user_id = $user_id;


            return response()->json([
                'statut_message' => 'Voici la liste des pour toutes les candidatures.',
                'statut_code' => 200,
                'data' => $candidatures,
            ]);
        }
    }


    public function indexOne(Formation $formation, Candidature $candidatures)
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            $user_id = auth()->user()->id;

            $candidatures = Candidature::where('formation_id', $formation->id)->get();

            foreach ($candidatures as $candidature) {
                $candidature->user_id = $user_id;
            }

            return response()->json([
                'statut_message' => 'Voici la liste des pour toutes les formations.',
                'statut_code' => 200,
                'data' => $candidatures,
            ]);
        }
    }

    public function indexAccept(Formation $formation, Candidature $candidatures)
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            $user_id = auth()->user()->id;

            $candidatures = Candidature::where('statut', 'acceptee')->get();

            foreach ($candidatures as $candidature) {
                $candidature->user_id = $user_id;
            }

            return response()->json([
                'statut_message' => 'Voici la liste des pour toutes les candidatures acceptées.',
                'statut_code' => 200,
                'data' => $candidatures,
            ]);
        }   elseif (auth()->check()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Non autorisé. Veuillez vous connecter.',
            ]);
        } else {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'La candidature n\'existe pas.',
            ]);
        }
    }

    public function indexRefuse(Formation $formation, Candidature $candidatures)
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            $user_id = auth()->user()->id;

            $candidatures = Candidature::where('statut', 'refusee')->get();

            foreach ($candidatures as $candidature) {
                $candidature->user_id = $user_id;
            }

            return response()->json([
                'statut_message' => 'Voici la liste des pour toutes les candidatures refusées.',
                'statut_code' => 200,
                'data' => $candidatures,
            ]);
        }   elseif (auth()->check()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Non autorisé. Veuillez vous connecter.',
            ]);
        } else {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'La candidature n\'existe pas.',
            ]);
        }
    }

    public function indexAttente(Formation $formation, Candidature $candidatures)
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            $user_id = auth()->user()->id;

            $candidatures = Candidature::where('statut', 'en attente')->get();

            foreach ($candidatures as $candidature) {
                $candidature->user_id = $user_id;
            }

            return response()->json([
                'statut_message' => 'Voici la liste des pour toutes les candidatures en attente.',
                'statut_code' => 200,
                'data' => $candidatures,
            ]);
        }   elseif (auth()->check()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Non autorisé. Veuillez vous connecter.',
            ]);
        } else {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'La candidature n\'existe pas.',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function accept($id)
    {
        try {

            $candidature = Candidature::findOrFail($id);
            $candidature->update(['statut' => 'acceptee']);

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'La candidature a été acceptée.',
                'data' => $candidature,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function refuse($id)
    {
        try {

            $candidature = Candidature::findOrFail($id);
            $candidature->update(['statut' => 'refusee']);

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'La candidature a été refusée.',
                'data' => $candidature,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $candidature = new Candidature(); 
    //     $candidature->statut = $request->statut ;
    //     $candidature->user_id = Auth::guard('web')->user()->id;
    //     $candidature->formation_id = $request->formation_id;

    //     $candidature->save();

    //     return response()->json([
    //         'statut_code' => 200,
    //         'statut_message' => 'Candidature enregistrée avec succès',
    //         'data' => $candidature,
    //     ]);
    // }

    public function store(Request $request, Formation $formation)
    {
        if (auth()->check() && auth()->user()->role_id == 2) {
            $user_id = auth()->user()->id;

            $candidature = new Candidature();
            // $candidature->statut = $request->statut;
            $candidature->user_id = $user_id;
            $candidature->formation_id = $formation->id;

            $candidature->save();

            return response()->json([
                'status_code' => 200,
                'status_message' => 'Candidature enregistrée avec succès',
                'candidature' => $candidature,
            ]);
        } elseif (auth()->check()) {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'Non autorisé. Veuillez vous connecter.',
            ]);
        } else {
            return response()->json([
                'status_code' => 401,
                'status_message' => 'La formation n\'existe pas.',
            ]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function validateCandidature(Candidature $candidature)
    {
        try {
            $candidature->update(['statut' => 'acceptee']);
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'Candidature acceptée.',
                'data' => $candidature,
            ]);
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function refuseCandidature(Candidature $candidature)
    {
        try {
            $candidature->update(['statut' => 'refusee']);
            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'Candidature refusée.',
                'data' => $candidature,
            ]);
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
}
