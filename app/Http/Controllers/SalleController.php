<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Salle;

class SalleController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/salle",
     *     summary="Display a listing of all room.",
     *     tags={"salle"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Salle")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $salles = Salle::all();

        if ($salles->count() == 0) {

            return response()->json(
                            ['error' => 'No find room'], 204); // HTTP Status code
        }

        return $salle;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @SWG\Get(
     *     path="/salle/{id_salle}",
     *     summary="Display a room.",
     *     tags={"salle"},
     *     operationId="getSalle",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Salle id to get",
     *         in="path",
     *         name="id_salle",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Salle"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Room does not exist",
     *     )
     * )
     */
    public function show($id)
    {
        $salle = Salle::find($id);

        if (empty($salle)) {
            return response()->json(
                            ['error' => 'this room does not exist'], 404); // HTTP Status code
        }

        return $salle;
    }

    /**
     * @SWG\Put(
     *     path="/salle/{id_salle}",
     *     summary="Update an existing room in storage.",
     *     tags={"salle"},
     *     operationId="putSalle",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Room identifier",
     *         in="path",
     *         name="id_salle",
     *         type="integer",
     *         @SWG\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @SWG\Parameter(
     *         description="Room number",
     *         in="formData",
     *         name="numero_salle",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Room's name",
     *         in="formData",
     *         name="nom_salle",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Etage room",
     *         in="formData",
     *         name="etage_salle",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Place number of room",
     *         in="formData",
     *         name="places",
     *         type="integer"
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
     *         description="Room does not exist",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $salle = Salle::find($id);

        if (empty($salle)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }
        $validator = Validator::make($request->all(), [
                    'numero_salle' => 'numeric',
                    'nom_salle' => 'string',
                    'date_naissance' => 'date',
                    'etage_salle' => 'numeric',
                    'place' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }



        $salle->fill(Input::all());
        $salle->save();
        return response()->json(
                        ['Fields have correctly update'], 200
        );
    }

    /**
     * @SWG\Delete(
     *     path="/salle/{id_salle}",
     *     summary="Remove the specified room from storage.",
     *     tags={"salle"},
     *     operationId="deleteSalle",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Room identifier",
     *         in="path",
     *         name="id_salle",
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
     *         description="Room does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $salle = Salle::find($id);

        if (empty($salle)) {
            return response()->json(
                            ['error' => 'this room does not exist'], 404); // HTTP Status code
        }

        $salle->delete();
    }

}
