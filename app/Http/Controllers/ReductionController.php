<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Reduction;

class ReductionController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/reduction",
     *     summary="Affiche une liste de réductions.",
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
     * )
     *
     */
    public function index()
    {
        $reduc = Reduction::all();
        return $reduc;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     *
     *
     * @param  int  $id_reduction
     * @return \Illuminate\Http\Response
     *
     *
     * @SWG\Get(
     *     path="/reduction/{id_reduction}",
     *     summary="Affiche une réduction spécifique.",
     *     tags={"reduction"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_reduction",
     *         in="path",
     *         description="Id de la réduction",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Reduction/{$id}")
     *          ),
     *     ),
     * )
     *
     */
    public function show($id)
    {
        $reduc = Reduction::find($id);

        if(empty($reduc)){
            return response()->json(
                ['error' => 'Cette redéduction n\'existe pas !'],404); //HTTP Status code
        }
        return $reduc;
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
