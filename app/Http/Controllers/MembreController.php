<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Membre;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;

class MembreController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/membre",
     *     summary="Display a listing of all membres.",
     *     tags={"membre"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="List of members",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Membre")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="No find members",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Membre")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $membres = Membre::all();

        if ($membres->count() == 0) {

            return response()->json(
                            ['error' => 'No find members'], 204); // HTTP Status code
        }

        return $membres;
    }

    /**
     * @SWG\Post(
     *     path="/membre",
     *     summary="Add Membre into storage",
     *     tags={"membre"},
     *     operationId="postMembre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="id of personne",
     *         in="formData",
     *         name="id_personne",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Id of abonnement",
     *         in="formData",
     *         name="id_abonnement",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Created date",
     *         in="formData",
     *         name="date_inscription",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         description="Started abonnement date",
     *         in="formData",
     *         name="debut_abonnement",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Membre inserted",
     *         @SWG\Schema(
     *             ref="#/definitions/Membre"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'id_personne' => 'required|numeric',
                    'id_abonnement' => 'required|numeric',
                    'date_inscription' => 'required|date_format:"Y-m-d"',
                    'debut_abonnement' => 'required|date_format:"Y-m-d"',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        $membre = new Membre(Input::all());
        if ($membre->save()) {
            return response()->json(
                            $membre, 201);
        }
        return response()->json(
                        ['errors' => 'fail to insert new membre'], 422);
    }

    /**
     * @SWG\Get(
     *     path="/membre/{id_membre}",
     *     summary="Display a member",
     *     tags={"membre"},
     *     operationId="getMembre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Id of membre",
     *         in="path",
     *         name="id_membre",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Membre finded",
     *         @SWG\Schema(
     *             ref="#/definitions/Membre"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Membre does not exist",
     *     )
     * )
     */
    public function show($id, $pers, $abo, $forfait)
    {
        $membre = Membre::find($id);

        if (empty($membre)) {
            return response()->json(
                            ['error' => 'This membre does not exist'], 404); // HTTP Status code
        }

        return $membre;
    }

    /**
     * @SWG\Get(
     *     path="/membre/{id_membre}/extras/{pers}/{abo}/{forfait}",
     *     summary="Display a member",
     *     tags={"membre"},
     *     operationId="getMembre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Id of membre",
     *         in="path",
     *         name="id_membre",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="get personne 1/0; default:0",
     *         in="path",
     *         name="pers",
     *         required=false,
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="get abonnement 1/0; default:0",
     *         in="path",
     *         name="abo",
     *         required=false,
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="get forfait 1/0; default:0",
     *         in="path",
     *         name="forfait",
     *         required=false,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Membre finded",
     *         @SWG\Schema(
     *             ref="#/definitions/Membre"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Membre does not exist",
     *     )
     * )
     */
    public function getMembreWithExtras($id, $pers = 0, $abo = 0, $forfait = 0)
    {
        $membre = Membre::find($id);

        if (empty($membre)) {
            return response()->json(
                            ['error' => 'This membre does not exist'], 404); // HTTP Status code
        }
        if ($pers) {
            $membre->personne;
        }
        if ($abo) {
            $membre->abonnement;
            if ($forfait) {
                $membre->abonnement->forfait;
            }
        }
        return $membre;
    }

    /**
     * @SWG\Put(
     *     path="/membre/{id_membre}",
     *     summary="Update a Membre",
     *     tags={"membre"},
     *     operationId="putMembre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="id of membre",
     *         in="formData",
     *         name="id_membre",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="id of membre",
     *         in="formData",
     *         name="id_personne",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Id of abonnement",
     *         in="formData",
     *         name="id_abonnement",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Created date",
     *         in="formData",
     *         name="date_inscription",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         description="Started abonnement date",
     *         in="formData",
     *         name="debut_abonnement",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Membre inserted",
     *         @SWG\Schema(
     *             ref="#/definitions/Membre"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $membre = Membre::find($id);

        $validator = Validator::make($request->all(), [
                    'id_membre' => 'required|numeric|exists:membres',
                    'id_personne' => 'required|numeric',
                    'id_abonnement' => 'required|numeric',
                    'date_inscription' => 'date_format:"Y-m-d"',
                    'debut_abonnement' => 'date_format:"Y-m-d"',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($fonction)) {
            return response()->json(
                            ['error' => 'this membre does not exist'], 404); // HTTP Status code
        }

        $membre->fill(Input::all());
        if ($membre->save()) {
            return response()->json(
                            ['Membre have correctly update'], 200
            );
        }
        return response()->json(
                        ['errors' => 'update error'], 422); // HTTP Status code
    }

    /**
     * @SWG\Delete(
     *     path="/membre/{id_membre}",
     *     summary="Remove the specified member from storage.",
     *     tags={"membre"},
     *     operationId="deleteMembre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Membre identifier",
     *         in="path",
     *         name="id_membre",
     *         type="integer",
     *         @SWG\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Member does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $membre = Membre::find($id);

        if (empty($membre)) {
            return response()->json(
                            ['error' => 'This member does not exist'], 404); // HTTP Status code
        }

        if ($membre->delete()) {
            return response()->json(
                            ['Member have been correctly deleted'], 200); // HTTP Status code
        }
        return response()->json(
                        ['Member have been failed deleted'], 422); // HTTP Status code
    }

}
