<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Distributeur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class DistributeurController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/distributeur",
     *     summary="Show distributeur.",
     *     tags={"distributeur"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Distributeur")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     *
     */
    public function index()
    {
        return Distribtueur::all();//
    }

    /**
     * @SWG\Post(
     *     path="/distributeur",
     *     summary="Ajouter un distributeur.",
     *     tags={"distributeur"},
     *     operationId="postDistributeur",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="nom",
     *         in="formData",
     *         description="Nom du distributeur",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="telephone",
     *         in="formData",
     *         description="Telephone",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="adresse",
     *         in="formData",
     *         description="Adresse",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="cpostal",
     *         in="formData",
     *         description="Code postal",
     *         required=false,
     *         type="string",
     *     ),
     *
     *     @SWG\Parameter(
     *         name="ville",
     *         in="formData",
     *         description="Ville",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="pays",
     *         in="formData",
     *         description="Pays",
     *         required=false,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Distributeur")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The informations can't be validated!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Distributeur")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     *
     */
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nom'=>'required|string|unique:distributeurs,nom',
            'telephone'=>'string',
            'cpostal'=>'string',
            'ville'=>'string',
            'pays'=>'string',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'message' => 'Woops! The informations can\'t be validated!',
                    'errors' => $validator->errors()->all()
                ], 422); //HTTP Status code
        }

        $reduc = new Distributeur(Input::all());

        if($reduc->save()){
            return response()->json($reduc, 200); //HTTP Status code
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
