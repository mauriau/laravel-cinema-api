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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
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
            'adresse'=>'string',
            'cpostal'=>'string',
            'ville'=>'string',
            'pays'=>'string'
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'message' => 'Woops! The informations can\'t be validated!',
                    'errors' => $validator->errors()->all()
                ], 422); //HTTP Status code
        }

        $distributeur = new Distributeur(Input::all());

        if($distributeur->save()){
            return response()->json($distributeur, 200); //HTTP Status code
        }
    }

    /**
     * @SWG\Get(
     *     path="/disrtibuteur/{id_distributeur}",
     *     summary="Display a movie dealer",
     *     tags={"membre"},
     *     operationId="getDistributeur",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Id of movie dealer",
     *         in="path",
     *         name="id_distributeur",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Distributeur finded",
     *         @SWG\Schema(
     *             ref="#/definitions/Distributeur"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Distributeur does not exist",
     *     )
     * )
     */
    public function show($id)
    {
        $distributeur = Distributeur::find($id);

        if (empty($distributeur)) {
            return response()->json(
                            ['error' => 'This dealer does not exist'], 404); // HTTP Status code
        }

        return $distributeur;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *  @param  int  $id_distributeur
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     *     path="/distributeur/{id_distributeur}",
     *     summary="Modify a discount.",
     *     tags={"distributeur"},
     *     operationId="putDistributeur",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_distributeur",
     *         in="path",
     *         description="Id of the distributeur",
     *         required=true,
     *         type="integer",
     *     ),
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
     *          description="Woops! The discount that you looking for doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Distributeur")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=422,
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
     */
    public function update(Request $request, $id)
    {
        $distributeur = Distributeur::find($id);
        if(empty($distributeur)){
            return response()->json(
                ['error' => 'Woops! The distributeur that you looking for doesn\'t exist!'],404); //HTTP Status code
        }

        $validator = Validator::make($request->all(),[
            'nom'=>'required|string|unique:distributeurs,nom',
            'telephone'=>'string',
            'cpostal'=>'string',
            'ville'=>'string',
            'pays'=>'string'
        ]);

        if($validator->fails()){
            return response()->json(
                ['errors' => $validator->errors()->all()], 422); //HTTP Status code

        }

        $distributeur->fill(Input::all());
        $distributeur->save();
        return response()->json(
            ['Fields have correctly been updated'],
            200
        );

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
