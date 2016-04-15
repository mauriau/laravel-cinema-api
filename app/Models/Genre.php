<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 *
 *  @SWG\definition(
 *   required={"id_genre"},
 *   @SWG\Xml(name="Genre"),
 *   @SWG\Property(format="int64", property="id_genre", type="number", default=1),
 *   @SWG\Property(format="string", property="nom", type="string", default="genre"),
 *   )
 *
 *
 */
class Genre extends Model
{
    protected $table = 'genres';

    protected $primaryKey = 'id_genre';

    public $timestamps = false;

    protected $fillable = [
        'nom'
    ];

    protected $guarded = [];

    public function films()
    {
        return $this->hasMany('App\Models\Film', 'id_genre');
    }        
}