<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Formation\CreateFormationRequest;
use App\Http\Requests\Formation\UpdateFormationRequest;
use App\Models\Formation;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $formation = Formation::all();
       
        return response()->json([
            'statut_message' => 'Voici la liste de toutes les formations.',
            'statut_code' => 200,
            'data' => $formation,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            // dd('okkkkkkk');
            $formation = new Formation();

            $formation->titre = $request->titre;
            $formation->criteres = $request->criteres;
            $formation->duree = $request->duree;
            $formation->etat = $request->etat;
            $formation->archive = $request->archive;

            // dd('oaaaaaaa');
            $formation->save();

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'Nouvelle formation ajoutée avec succès',
                'data' =>  $formation,
            ]);
        } catch (Exception $e) {

            throw new \Exception($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $formation = Formation::find($id);
        return $formation;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
        try {
            // if (
            //     Role::where("nom", "AdminSimplon")->get()->first()->id == auth()->user()->role_id &&
            //     Formation::where("user_id", auth()->user()->id)->where("id", $formation->id)->exists()
            //     ) {
                // dd('kkkkk');
                $formation->titre = $request->titre;
                $formation->criteres = $request->criteres;
                $formation->duree = $request->duree;
                $formation->etat = $request->etat;
                $formation->archive = $request->archive;

                $formation->update();
                if ($formation->update()) {
                    return response()->json([
                        'statut_code' => 200,
                        'statut_message' => 'La formation a été modifiée avec succès',
                        'data' => $formation,
                    ]);
                } else {
                    return response()->json([
                        'statut_code' => 200,
                        'statut_message' => 'Impossible de modifier cette formation, Vous n\'avez pas les droits.',
                    ]);
                }
                return  response()->json([
                    'statut_code' => 422,
                    'statut_message' => 'Probleme d\'insertion...',
                ]);
            } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Cloturer the specified resource in storage.
     */

    public function changeEtatFormation(Formation $formation)
    {
        try {
            // if (
            //     Role::where("nom", "AdminSimplon")->get()->first()->id == auth()->user()->role_id &&
            //     Formation::where("user_id", auth()->user()->id)->where("id", $formation->id)->exists()
            // )
                $formation->update(['etat' => 'cloturee']);

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'La formation est clôturée avec succès',
                'data' => $formation,
            ]);
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Archive the specified resource in storage.
     */

    public function archiveFormation($id)
    {
        try {

            $formation = Formation::findOrFail($id);
            $formation->update(['archive' => true]);

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'La formation a été archivée avec succès.',
                'data' => $formation,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
      
        try {

            $formation->delete();

            return response()->json([
                'statut_code' => 200,
                'statut_message' => 'La formation a été supprimée avec succès.',
                'data' => $formation,
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }
}
