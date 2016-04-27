<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Personne;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;

class PersonneController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/personne",
     *     summary="Display a listing of all personnes.",
     *     tags={"personne"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Personne")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        return Personne::all();
    }

    /**
     * @SWG\Post(
     *     path="/personne",
     *     summary="Store a new personne in storage.",
     *     tags={"personne"},
     *     operationId="postPersonne",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Nom Identifier",
     *         in="formData",
     *         name="nom",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Prenom Identifier",
     *         in="formData",
     *         name="prenom",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Date de naissance",
     *         in="formData",
     *         name="date_naissance",
     *         type="string",
     *         format="date"
     *     ),
     *     @SWG\Parameter(
     *         description="email of the personne",
     *         in="formData",
     *         name="email",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="adresse of the personne",
     *         in="formData",
     *         name="adresse",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="code postal of the personne",
     *         in="formData",
     *         name="cpostal",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="ville of the personne",
     *         in="formData",
     *         name="ville",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="email of the personne",
     *         in="formData",
     *         name="pays",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Personne does not exist",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|unique:personnes,email',
                    'nom' => 'required',
                    'prenom' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }
        try {
            $personne = new Personne(Input::all());

            $personne->save();

            return response()->json(
                            $personne, 201); // HTTP Status code
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json(
                            'Problème lors de l\'insertion en base', 500); // HTTP Status code
        }
    }

    /**
     * @SWG\Get(
     *     path="/personne/{id_personne}/fonctions",
     *     summary="Affiche les personnes qui on la fonction {id}",
     *     tags={"personne"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Personne id to get",
     *         in="path",
     *         name="id_personne",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Personne")
     *         ),
     *     ),
     * )
     */
    public function getFonctions($id_personne)
    {
        $personne = Personne::find($id_personne);
        $personne->fonctions;
        return $personne;
    }

    /**
     * @SWG\Get(
     *     path="/personne/{id_personne}",
     *     summary="Display a personne.",
     *     tags={"personne"},
     *     operationId="getPersonne",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Personne id to get",
     *         in="path",
     *         name="id_personne",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Personne"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Personne does not exist",
     *     )
     * )
     */
    public function show($id)
    {
        $personne = Personne::find($id);

        if (empty($personne)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }

        return $personne;
    }

    /**
     * @SWG\Put(
     *     path="/personne/{id_personne}",
     *     summary="Update an existing personne in storage.",
     *     tags={"personne"},
     *     operationId="putPersonne",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Personne identifier",
     *         in="path",
     *         name="id_personne",
     *         type="integer",
     *         @SWG\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @SWG\Parameter(
     *         description="Nom Identifier",
     *         in="formData",
     *         name="nom",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Prenom Identifier",
     *         in="formData",
     *         name="prenom",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Date de naissance",
     *         in="formData",
     *         name="date_naissance",
     *         type="string",
     *         format="date"
     *     ),
     *     @SWG\Parameter(
     *         description="email of the personne",
     *         in="formData",
     *         name="email",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="adresse of the personne",
     *         in="formData",
     *         name="adresse",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="code postal of the personne",
     *         in="formData",
     *         name="cpostal",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="ville of the personne",
     *         in="formData",
     *         name="ville",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="email of the personne",
     *         in="formData",
     *         name="pays",
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Personne does not exist",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $personne = Personne::find($id);

        $validator = Validator::make($request->all(), [
                    'nom' => 'string',
                    'prenom' => 'string',
                    'date_naissance' => 'date',
                    'email' => 'string|unique:personnes,email',
                    'cpostal' => 'string',
                    'ville' => 'string',
                    'pays' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($personne)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }

        $personne->fill(Input::all());
        $personne->save();
        return response()->json(
                        ['Fields have correctly update'], 200
        );
    }

    /**
     * @SWG\Delete(
     *     path="/personne/{id_personne}",
     *     summary="Remove the specified personne from storage.",
     *     tags={"personne"},
     *     operationId="deletePersonne",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Personne identifier",
     *         in="path",
     *         name="id_personne",
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
     *         description="Personne does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $personne = Personne::find($id);

        if (empty($personne)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }

        $personne->delete();
    }

}
