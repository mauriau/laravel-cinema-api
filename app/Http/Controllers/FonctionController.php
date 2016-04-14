<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Fonction;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;

class FonctionController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/fonction",
     *     summary="Display a listing of all fonctions.",
     *     tags={"fonction"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Fonction")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        return Fonction::all();
    }

        /**
     * @SWG\Get(
     *     path="/fonction/{id_fonction}/personnes",
     *     summary="Display the specified fonction with personnes.",
     *     tags={"fonction"},
     *     operationId="getFilm",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Fonction à chercher",
     *         in="path",
     *         name="id_fonction",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Fonction"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="La fonction n'existe pas.",
     *     )
     * )
     */
    public function getPersonnes($id_fonction)
    {
        $fonction = Fonction::find($id_fonction);
        $fonction->personnes;
        return $fonction;
    }

    /**
     * @SWG\Post(
     *     path="/fonction",
     *     summary="Post a new in storage.",
     *     tags={"fonction"},
     *     operationId="postFonction",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Nom Identifier",
     *         in="formData",
     *         name="nom",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Salaire Identifier",
     *         in="formData",
     *         name="salaire",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Date de naissance",
     *         in="formData",
     *         name="cadre",
     *         type="integer",
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
     *         description="Fonction does not exist",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'nom' => 'required|unique:fonction'
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }
        try {
            $fonction = new Fonction(Input::all());

            $fonction->save();

            return response()->json(
                            $fonction, 201); // HTTP Status code
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json(
                            'Problème lors de l\'insertion en base', 500); // HTTP Status code
        }
    }

    /**
     * @SWG\Get(
     *     path="/fonction/{id_fonction}",
     *     summary="Display the specified fonction.",
     *     tags={"fonction"},
     *     operationId="getFilm",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Fonctionà chercher",
     *         in="path",
     *         name="id_fonction",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Fonction"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="La fonction n'existe pas.",
     *     )
     * )
     */
    public function show($id)
    {
        $fonction = Fonction::find($id);

        if (empty($fonction)) {
            return response()->json(
                            ['error' => 'La fonction n\'existe pas.'], 404); // HTTP Status code
        }

        return $fonction;
    }

    /**
     * @SWG\Put(
     *     path="/fonction/{id_fonction}",
     *     summary="Update an existing fonction in storage.",
     *     tags={"fonction"},
     *     operationId="putFonction",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Fonction identifier",
     *         in="path",
     *         name="id_fonction",
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
     *         description="Salaire Identifier",
     *         in="formData",
     *         name="salaire",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Date de naissance",
     *         in="formData",
     *         name="cadre",
     *         type="integer",
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
     *         description="Fonction does not exist",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $fonction = Fonction::find($id);

        $validator = Validator::make($request->all(), [
                    'nom' => 'required',
                    'salaire' => 'string',
                    'cadre' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($fonction)) {
            return response()->json(
                            ['error' => 'this fonction does not exist'], 404); // HTTP Status code
        }

        $fonction->fill(Input::all());
        $fonction->save();
        return response()->json(
                        ['Fields have correctly update'], 200
        );
    }

    /**
     * @SWG\Delete(
     *     path="/fonction/{id_fonction}",
     *     summary="Remove the specified fonction from storage.",
     *     tags={"fonction"},
     *     operationId="deleteFonction",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Fonction identifier",
     *         in="path",
     *         name="id_fonction",
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
     *         description="Fonction does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $fonction = Fonction::find($id);

        if (empty($fonction)) {
            return response()->json(
                            ['error' => 'this fonction does not exist'], 404); // HTTP Status code
        }

        if ($fonction->delete()) {
            return response()->json(
                            ['Fields have correctly deleted'], 200); // HTTP Status code
        }
    }

}
