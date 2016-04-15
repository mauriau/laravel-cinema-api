<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Models\HistoriqueMembre;

class HistoriqueController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/historique",
     *     summary="Display a listing of all historique.",
     *     tags={"historique"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="List of historique",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/HistoriqueMembre")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="No find historique",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/HistoriqueMembre")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $historique = Historique::all();

        if ($historique->count() == 0) {

            return response()->json(
                            ['error' => 'No find historique'], 204); // HTTP Status code
        }

        return $historique;
    }

    /**
     * @SWG\Post(
     *     path="/historique",
     *     summary="Add historique into storage",
     *     tags={"historique"},
     *     operationId="postHistorique",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Member id",
     *         in="formData",
     *         name="id_membre",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Sceance id",
     *         in="formData",
     *         name="id_sceance",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Date of historique",
     *         in="formData",
     *         name="date",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Historique inserted",
     *         @SWG\Schema(
     *             ref="#/definitions/HistoriqueMembre"
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
                    'id_membre' => 'required|numeric',
                    'id_sceance' => 'required|numeric',
                    'date' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        $historique = new HistoriqueMembre(Input::all());
        if ($forfait->save()) {
            return response()->json(
                            $historique, 201);
        }
        return response()->json(
                        ['errors' => 'fail to insert new historique'], 422);
    }

    /**
     * @SWG\Get(
     *     path="/historique/{id_historique}",
     *     summary="Display the specified historique.",
     *     tags={"historique"},
     *     operationId="getHistorique",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Historique id to get",
     *         in="path",
     *         name="id_historique",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/HistoriqueMembre"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Historique does not exist",
     *     )
     * )
     */
    public function show($id)
    {
        $historique = HistoriqueMembre::find($id);
        if (empty($historique)) {
            return response()->json(
                            ['error' => 'this historique does not exist'], 404); // HTTP Status code
        }
        return $historique;
    }

    /**
     * @SWG\Put(
     *     path="/historique/{id_historique}",
     *     summary="Update historique from storage",
     *     tags={"historique"},
     *     operationId="putHistoriqueMembre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Historique id",
     *         in="formData",
     *         name="id_historique",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Member id",
     *         in="formData",
     *         name="id_membre",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Sceance id",
     *         in="formData",
     *         name="id_sceance",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Date of historique",
     *         in="formData",
     *         name="date",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Historique inserted",
     *         @SWG\Schema(
     *             ref="#/definitions/HistoriqueMembre"
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
        $historique = HistoriqueMembre::find($id);

        $validator = Validator::make($request->all(), [
                    'id_membre' => 'numeric',
                    'id_sceance' => 'numeric',
                    'date' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($historique)) {
            return response()->json(
                            ['error' => 'this historique does not exist'], 404); // HTTP Status code
        }

        $historique->fill(Input::all());
        if ($historique->save()) {
            return response()->json(
                            ['Fields have been correctly update'], 200
            );
        }
        return response()->json(
                        ['Fields have been fail update'], 422
        );
    }

    /**
     * @SWG\Delete(
     *     path="/historique/{id_historique}",
     *     summary="Remove the specified historique from storage.",
     *     tags={"historique"},
     *     operationId="deleteHistorique",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Historique identifier",
     *         in="path",
     *         name="id_historique",
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
     *         description="Historique does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $historique = HistoriqueMembre::find($id);

        if (empty($historique)) {
            return response()->json(
                            ['error' => 'this historique does not exist'], 404); // HTTP Status code
        }

        $historique->delete();
    }

}
