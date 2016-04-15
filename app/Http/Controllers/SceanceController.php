<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Seance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class SceanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/seance",
     *     summary="Display all of the sessions.",
     *     tags={"seance"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Seance")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     */
    public function index()
    {
        $seance = Seance::all();
        return $seance;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/seance",
     *     summary="Add a session.",
     *     tags={"seance"},
     *     operationId="postSeance",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_film",
     *         in="formData",
     *         description="id of the movie associated",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="id_salle",
     *         in="formData",
     *         description="id of the place associated",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="id_personne_ouvreur",
     *         in="formData",
     *         description="id of the person 'ouvreur' associated",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="id_personne_technicien",
     *         in="formData",
     *         description="id of the technician associated",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="id_personne_menage",
     *         in="formData",
     *         description="id of the person 'menage' associated",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Parameter(
     *         name="debut_seance",
     *         in="formData",
     *         description="Begin of the session",
     *         required=true,
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         name="fin_seance",
     *         in="formData",
     *         description="End of the session",
     *         required=true,
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Seance")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The informations can't be validated!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Seance")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     *
     *
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_film'=>'required|numeric',
            'id_salle'=>'required|numeric',
            'id_personne_ouvreur'=>'required|numeric',
            'id_personne_technicien'=>'required|numeric',
            'id_personne_menage'=>'required|numeric',
            'debut_seance'=>'date|before:fin_seance',
            'fin_seance'=>'date|after:debut_seance',
        ]);

        if($validator->fails()){
            return response()->json(
                [
                    'message' => 'Woops! The informations can\'t be validated!',
                    'errors' => $validator->errors()->all()
                ], 422); //HTTP Status code
        }

        $seance = new Seance(Input::all());

        if($seance->save()){

            return response()->json($seance, 200); //HTTP Status code
        }
    }


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
