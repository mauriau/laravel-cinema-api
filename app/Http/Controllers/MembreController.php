<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class MembreController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/membre",
     *     summary="Retourne tous les membres ou un code erreur 204 si aucun membre trouvé",
     *     tags={"membre"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="liste des membres trouvés",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Membre")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="pas de membres trouvés",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Membre")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
    	$membres = Membre::all();

    	if ($membres->count() == 0)
    	{

    		return response()->json(
    				['error' => 'Aucun membre trouve'],
    				204); // HTTP Status code
    	}
    	
        return $membres;
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
