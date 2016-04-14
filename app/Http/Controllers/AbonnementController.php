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
use App\Models\Abonnement;

class AbonnementController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/abonnement",
     *     summary="Display a listing of all abonnement.",
     *     tags={"abonnement"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Abonnement")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $abo = Abonnement::all();
        return $abo;
    }

    /**
     * @SWG\Post(
     *     path="/abonnement",
     *     summary="Store a new created abonnement in storage.",
     *     tags={"abonnement"},
     *     operationId="postAbonnement",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="id of forfait",
     *         in="formData",
     *         name="id_forfait",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Time of the abonnement",
     *         in="formData",
     *         name="debut",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Abonnement"
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
                    'id_forfait' => 'required|numeric|exists:forfaits',
                    'debut' => 'required|date_format:"Y-m-d"|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        $abonnement = new Abonnement(Input::all());


        if ($abonnement->save()) {

            return response()->json(
                            $abonnement, 201); // HTTP Status code
        }
    }

    /**
     * @SWG\Get(
     *     path="/abonnement/{id_abonnement}",
     *     summary="Display the specified abonnement.",
     *     tags={"abonnement"},
     *     operationId="getAbonnement",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Abonnement id to get",
     *         in="path",
     *         name="id_abonnement",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Abonnement"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Abonnement does not exist",
     *     )
     * )
     */
    public function show($id)
    {
        $abonnement = Abonnement::find($id);
        if (empty($abonnement)) {
            return response()->json(
                            ['error' => 'this abonnement does not exist'], 404); // HTTP Status code
        }
        return $abonnement;
    }

    /**
     * @SWG\Put(
     *     path="/abonnement/{id_abonnement}",
     *     summary="Update an existing abonnement in storage.",
     *     tags={"abonnement"},
     *     operationId="putAbonnement",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="id of forfait",
     *         in="formData",
     *         name="id_forfait",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Time of the abonnement",
     *         in="formData",
     *         name="debut",
     *         type="string",
     *         format="date",
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
     *         description="Abonnement does not exist",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $abonnement = Abonnement::find($id);

        $validator = Validator::make($request->all(), [
                    'id_forfait' => 'required|numeric|exists:forfaits',
                    'debut' => 'required|date_format:"Y-m-d"|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($abonnement)) {
            return response()->json(
                            ['error' => 'this abonnement does not exist'], 404); // HTTP Status code
        }

        $abonnement->fill(Input::all());
        if ($abonnement->save()) {
            return response()->json(
                            ['Fields have correctly update'], 200
            );
        }
        return response()->json(
                        ['Fields have fail update'], 422
        );
    }

    /**
     * @SWG\Delete(
     *     path="/abonnement/{id_abonnement}",
     *     summary="Remove the specified abonnement from storage.",
     *     tags={"abonnement"},
     *     operationId="deleteAbonnement",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Abonnement identifier",
     *         in="path",
     *         name="id_abonnement",
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
     *         description="Abonnement does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $abonnement = Abonnement::find($id);

        if (empty($abo)) {
            return response()->json(
                            ['error' => 'this abonnement does not exist'], 404); // HTTP Status code
        }

        $abonnement->delete();
    }

}
