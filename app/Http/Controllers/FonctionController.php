<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Fonction;

class FonctionController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/fonction",
     *     summary="Display a listing of all fonctions.",
     *     tags={"personne"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/fonction")
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
     *     summary="Affiche les fonctions qui on la personne {id}",
     *     tags={"personne_fonction"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/fonction")
     *         ),
     *     ),
     * )
     */
    public function getPersonnes($id_fonction)
    {
        $fonction = Fonction::find($id_fonction);
        $fonction->personnes;
        return $fonction;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
                            $personne, 201); // HTTP Status code
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
     *     tags={"film"},
     *     operationId="getFonction",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Fonction id to get",
     *         in="path",
     *         name="id_fonction",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Film"
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Film does not exist",
     *     )
     * )
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
