<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Reduction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ReductionController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/reduction",
     *     summary="Display all of the discounts.",
     *     tags={"reduction"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
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
        $reduc = Reduction::all();
        return $reduc;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     *@SWG\Post(
     *     path="/reduction",
     *     summary="Add a discount.",
     *     tags={"reduction"},
     *     operationId="postReducation",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="nom",
     *         in="formData",
     *         description="Name of the discount",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="date_debut",
     *         in="formData",
     *         description="Begin of the discount",
     *         required=false,
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         name="date_fin",
     *         in="formData",
     *         description="End of the discount",
     *         required=false,
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         name="pourcentage_reduction",
     *         in="formData",
     *         description="Percentage of the discount",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The informations can't be validated!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
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
            'nom'=>'required|string|unique:reductions,nom',
            'date_debut'=>'date|before:date_fin',
            'date_fin'=>'date|after:date_debut',
            'pourcentage_reduction'=>'required|numeric|between:0,100',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'message' => 'Woops! The informations can\'t be validated!',
                    'errors' => $validator->errors()->all()
                ], 422); //HTTP Status code
        }

        $reduc = new Reduction(Input::all());

        if($reduc->save()){
            return response()->json($reduc, 200); //HTTP Status code
        }
    }

    /**
     *
     *
     * @param  int  $id_reduction
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/reduction/{id_reduction}",
     *     summary="Display a discount.",
     *     tags={"reduction"},
     *     operationId="getReducation",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_reduction",
     *         in="path",
     *         description="Id of the discount",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The discount that you looking for doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     *
     */
    public function show($id)
    {
        $reduc = Reduction::find($id);

        if(empty($reduc)){
            return response()->json(
                ['error' => 'Woops! The discount that you looking for doesn\'t exist!'],404); //HTTP Status code
        }
        return $reduc;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     *  @param  int  $id_reduction
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     *     path="/reduction/{id_reduction}",
     *     summary="Modify a discount.",
     *     tags={"reduction"},
     *     operationId="putReducation",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_reduction",
     *         in="path",
     *         description="Id of the discount",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         name="nom",
     *         in="formData",
     *         description="Name of the discount",
     *         required=true,
     *         type="string",
     *     ),
     *
     *     @SWG\Parameter(
     *         name="date_debut",
     *         in="formData",
     *         description="Begin of the discount",
     *         required=true,
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         name="date_fin",
     *         in="formData",
     *         description="End of the discount",
     *         required=true,
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         name="pourcentage_reduction",
     *         in="formData",
     *         description="Percentage of the discount",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The discount that you looking for doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Woops! The informations can't be validated!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
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
        $reduc = Reduction::find($id);
        if(empty($reduc)){
            return response()->json(
                ['error' => 'Woops! The discount that you looking for doesn\'t exist!'],404); //HTTP Status code
        }

        $validator = Validator::make($request->all(),[
            'nom'=>'string',
            'date_debut'=>'date|before:date_fin',
            'date_fin'=>'date|after:date_debut',
            'pourcentage_reduction'=>'numeric|between:0,100',
        ]);

        if($validator->fails()){
            return response()->json(
                ['errors' => $validator->errors()->all()], 422); //HTTP Status code

        }

        $reduc->fill(Input::all());
        $reduc->save();
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
     *
     * @SWG\Delete(
     *     path="/reduction/{id_reduction}",
     *     summary="Delete a discount.",
     *     tags={"reduction"},
     *     operationId="deleteReducation",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_reduction",
     *         in="path",
     *         description="Id of the discount",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The discount that you want to delete doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     */
    public function destroy($id)
    {
        $Reduc = Reduction::find($id);
        if(empty($Reduc)){
            return response()->json(
                ['error' => 'Woops! The discount that you want to delete doesn\'t exist!'],404); //HTTP Status code
        }
        $Reduc->delete();
    }
}
