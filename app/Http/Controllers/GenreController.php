<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class GenreController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/genre",
     *     summary="Display all of the genres.",
     *     tags={"genre"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
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
        $genre = Genre::all();
        return $genre;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/genre",
     *     summary="Add a genre.",
     *     tags={"genre"},
     *     operationId="postGenre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="nom",
     *         in="formData",
     *         description="Name of the genre",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The informations can't be validated!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
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
        $validator = Validator::make($request->all(), [
                    'nom' => 'required|string|unique:genres,nom',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            [
                        'message' => 'Woops! The informations can\'t be validated!',
                        'errors' => $validator->errors()->all()
                            ], 422); //HTTP Status code
        }

        $genre = new Genre(Input::all());

        if ($genre->save()) {
            return response()->json($genre, 200); //HTTP Status code
        }
    }

    /**
     *
     *
     * @param  int  $id_genre
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/genre/{id_genre}",
     *     summary="Display a genre.",
     *     tags={"genre"},
     *     operationId="getGenre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_genre",
     *         in="path",
     *         description="Id of the genre",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The genre that you looking for doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
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
        $genre = Genre::find($id);

        if (empty($genre)) {
            return response()->json(
                            ['error' => 'Woops! The genre that you looking for doesn\'t exist!'], 404); //HTTP Status code
        }
        return $genre;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_genre
     * @return \Illuminate\Http\Response
     *
     * @SWG\Put(
     *     path="/genre/{id_genre}",
     *     summary="Modify a genre.",
     *     tags={"genre"},
     *     operationId="putGenre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_genre",
     *         in="path",
     *         description="Id of the genre",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Parameter(
     *         name="nom",
     *         in="formData",
     *         description="Name of the genre",
     *         required=true,
     *         type="string",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The genre that you looking for doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=422,
     *          description="Woops! The informations can't be validated!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
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
    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (empty($genre)) {
            return response()->json(
                            ['error' => 'Woops! The genre that you looking for doesn\'t exist!'], 404); //HTTP Status code
        }

        $validator = Validator::make($request->all(), [
                    'nom' => 'string|unique:genres,nom',
        ]);

        if ($validator->fails()) {
            return response()->json(
                            ['errors' => $validator->errors()->all()], 422); //HTTP Status code
        }

        $genre->fill(Input::all());
        $genre->save();
        return response()->json(
                        ['Fields have correctly been updated'], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_genre
     * @return \Illuminate\Http\Response
     *
     *  @SWG\Delete(
     *     path="/genre/{id_genre}",
     *     summary="Delete a genre.",
     *     tags={"genre"},
     *     operationId="deleteGenre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_genre",
     *         in="path",
     *         description="Id of the genre",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The genre that you want to delete doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
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
    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (empty($genre)) {
            return response()->json(
                            ['error' => 'Woops! The genre that you want to delete doesn\'t exist!'], 404); //HTTP Status code
        }
        $genre->delete();
    }

    
        /**
     *
     *
     * @param  int  $id_genre
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/genre/{id_genre}/films",
     *     summary="Display a genre with films.",
     *     tags={"genre"},
     *     operationId="getGenre",
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="id_genre",
     *         in="path",
     *         description="Id of the genre",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Woops! The genre that you looking for doesn't exist!",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Genre")
     *          ),
     *     ),
     *     @SWG\Response(
     *          response="default",
     *          description="An error has been occured",
     *     ),
     * )
     *
     */
    public function getFilms($id)
    {
        $genre = Genre::find($id);

        if (empty($genre)) {
            return response()->json(
                            ['error' => 'this genre does not exist'], 404); // HTTP Status code
        }
        $genre->films;
        return $genre;
    }

}
