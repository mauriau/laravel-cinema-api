<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Personne;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;


class PersonnelController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/personne",
     *     summary="Display a listing of all personnes.",
     *     tags={"personne"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Perrsonne")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        return Personne::all();
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
                    'email' => 'required|unique:personne', 'nom' => 'required:personne', 'prenom' => 'required:personne'
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }
        try {
            $personne = new Personne(Input::all());

            $personne->save();

            return response()->json(
                            $personne, 201); // HTTP Status code
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json(
                            'Problème lors de l\'insertion en base', 500); // HTTP Status code
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
        $personne = Personne::find($id);

        if (empty($personne)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }

        return $personne;
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
        $personne = Personne::find($id);

        $validator = Validator::make($request->all(), [
                    'email' => 'required|unique:personne',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($personne)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }

        $personne->email = $request->email;
        $personne->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $personne = Personne::find($id);

        if (empty($personne)) {
            return response()->json(
                            ['error' => 'this personne does not exist'], 404); // HTTP Status code
        }

        $personne->delete();
    }

}
