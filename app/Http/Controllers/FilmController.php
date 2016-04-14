<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Film;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Input;

class FilmController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/film",
     *     summary="Affiche la liste des films.",
     *     tags={"film"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Film")
     *         ),
     *     ),
     * )
     */
    public function index()
    {
        $films = Film::all();
    }

    /**
     * @SWG\Post(
     *     path="/film",
     *     summary="Store a newly created film in storage.",
     *     tags={"film"},
     *     operationId="postFilm",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Genre Identifier",
     *         in="formData",
     *         name="id_genre",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Distibuteur identifier",
     *         in="formData",
     *         name="id_distributeur",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Film title",
     *         in="formData",
     *         name="titre",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Abstract of the film",
     *         in="formData",
     *         name="resum",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Release start date of the film",
     *         in="formData",
     *         name="date_debut_affiche",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         description="Release end date of the film",
     *         in="formData",
     *         name="date_fin_affiche",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         description="Duration of the film (in minutes)",
     *         in="formData",
     *         name="duree_minutes",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Production year of the film",
     *         in="formData",
     *         name="annee_production",
     *         type="integer"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             ref="#/definitions/Film"
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
                    'titre' => 'required|unique:films',
                    'id_genre' => 'required|exists:genres,id_genre',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        $film = new Film;
        $film->titre = $request->titre;
        $film->save();

        return response()->json(
                        $film, 201); // HTTP Status code
    }

    /**
     * @SWG\Get(
     *     path="/film/{id_film}",
     *     summary="Display the specified film.",
     *     tags={"film"},
     *     operationId="getFilm",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Film id to get",
     *         in="path",
     *         name="id_film",
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
        $film = Film::find($id);

        if (empty($film)) {
            return response()->json(
                            ['error' => 'this film does not exist'], 404); // HTTP Status code
        }

        return $film;
    }

    /**
     * @SWG\Put(
     *     path="/film/{id_film}",
     *     summary="Update an existing film in storage.",
     *     tags={"film"},
     *     operationId="putFilm",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Film identifier",
     *         in="path",
     *         name="id_film",
     *         type="integer",
     *         @SWG\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @SWG\Parameter(
     *         description="Genre Identifier",
     *         in="formData",
     *         name="id_genre",
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         description="Distibuteur Identifier",
     *         in="formData",
     *         name="id_distributeur",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Film title",
     *         in="formData",
     *         name="titre",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Abstract of the film",
     *         in="formData",
     *         name="resum",
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         description="Release start date of the film",
     *         in="formData",
     *         name="date_debut_affiche",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         description="Release end date of the film",
     *         in="formData",
     *         name="date_fin_affiche",
     *         type="string",
     *         format="date",
     *     ),
     *     @SWG\Parameter(
     *         description="Duration of the film (in minutes)",
     *         in="formData",
     *         name="duree_minutes",
     *         type="integer"
     *     ),
     *     @SWG\Parameter(
     *         description="Production year of the film",
     *         in="formData",
     *         name="annee_production",
     *         type="integer"
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
     *         description="Film does not exist",
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $film = Film::find($id);

        $validator = Validator::make($request->all(), [
                    'titre' => 'required|unique:films',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); // HTTP Status code
        }

        if (empty($film)) {
            return response()->json(
                            ['error' => 'this film does not exist'], 404); // HTTP Status code
        }

        $film->titre = $request->titre;
        $film->save();
    }

    /**
     * @SWG\Delete(
     *     path="/film/{id_film}",
     *     summary="Remove the specified film from storage.",
     *     tags={"film"},
     *     operationId="deleteFilm",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         description="Film identifier",
     *         in="path",
     *         name="id_film",
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
     *         description="Film does not exist",
     *     )
     * )
     */
    public function destroy($id)
    {
        $film = Film::find($id);

        if (empty($film)) {
            return response()->json(
                            ['error' => 'this film does not exist'], 404); // HTTP Status code
        }

        $film->delete();
    }

}
