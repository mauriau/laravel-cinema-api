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
use App\Models\Forfait;

class ForfaitController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/forfait",
     *     summary="Display a listing of all forfait.",
     *     tags={"forfait"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="List of forfait",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Forfait")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="No find forfait",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Forfait")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $forfait = Forfait::all();

        if ($forfait->count() == 0) {

            return response()->json(
                            ['error' => 'No find forfait'], 204); // HTTP Status code
        }

        return $forfait;
    }

    /**
     * @SWG\Post(
     *     path="/forfait",
     *     summary="Add Forfait into storage",
     *     tags={"forfait"},
     *     operationId="postForfait",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Name of forfait",
     *         in="formData",
     *         name="nom",
     *         type="string",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Resum of forfait",
     *         in="formData",
     *         name="resum",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Price of forfait",
     *         in="formData",
     *         name="prix",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Time of forfait",
     *         in="formData",
     *         name="duree_jours",
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Membre inserted",
     *         @SWG\Schema(
     *             ref="#/definitions/Forfait"
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
                    'nom' => 'required|string|unique:forfaits,nom',
                    'prix' => 'numeric',
                    'resume' => 'string',
                    'duree_jours' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        $forfait = new Forfait(Input::all());
        if ($forfait->save()) {
            return response()->json(
                            $forfait, 201);
        }
        return response()->json(
                        ['errors' => 'fail to insert new forfait'], 422);
    }

    /**
     * @SWG\Get(
     *     path="/forfait/{id_forfait}",
     *     summary="Display the specified forfait.",
     *     tags={"forfait"},
     *     operationId="getForfait",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Forfait id to get",
     *         in="path",
     *         name="id_forfait",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Forfait"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Forfait does not exist",
     *     )
     * )
     */
    public function show($id)
    {
        $forfait = Forfait::find($id);
        if (empty($forfait)) {
            return response()->json(
                            ['error' => 'this forfait does not exist'], 404); // HTTP Status code
        }
        return $forfait;
    }

    /**
     * @SWG\Put(
     *     path="/forfait/{id_forfait}",
     *     summary="Update an existing forfait in storage.",
     *     tags={"forfait"},
     *     operationId="putForfait",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Id of forfait",
     *         in="formData",
     *         name="id_forfait",
     *         type="integer",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         description="Name of forfait",
     *         in="formData",
     *         name="nom",
     *         type="string",
     *         required=true,
     *     ), 
     *     @SWG\Parameter(
     *         description="Resum of forfait",
     *         in="formData",
     *         name="resum",
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         description="Price of forfait",
     *         in="formData",
     *         name="prix",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Time of forfait",
     *         in="formData",
     *         name="duree_jours",
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Forfait inserted",
     *         @SWG\Schema(
     *             ref="#/definitions/Forfait"
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
        $forfait = Forfait::find($id);

        $validator = Validator::make($request->all(), [
                    'nom' => 'required|string|unique:forfaits,nom',
                    'prix' => 'numeric',
                    'resume' => 'string',
                    'duree_jours' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($forfait)) {
            return response()->json(
                            ['error' => 'this forfait does not exist'], 404); // HTTP Status code
        }

        $forfait->fill(Input::all());
        if ($forfait->save()) {
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
     *     path="/forfait/{id_forfait}",
     *     summary="Remove the specified forfait from storage.",
     *     tags={"forfait"},
     *     operationId="deleteForfait",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Forfait identifier",
     *         in="path",
     *         name="id_forfait",
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
     *         description="Forfait does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $forfait = Forfait::find($id);

        if (empty($forfait)) {
            return response()->json(
                            ['error' => 'this forfait does not exist'], 404); // HTTP Status code
        }

        $forfait->delete();
    }

}
