<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *   @SWG\definition(
 *   required={"id_salle"},
 *   @SWG\Xml(name="Salle"),
 *   @SWG\Property(format="int64", property="id_salle", type="number", default=1),
 *   @SWG\Property(format="int64", property="numero_salle", type="number", default=1),
 *   @SWG\Property(format="string", property="nom_salle", type="string", default="Vador"),
 *   @SWG\Property(format="int64", property="etage_salle", type="number", default=0),
 *   @SWG\Property(format="int64", property="places", type="number", default=350),
 *   )
 *
 */
class Salle extends Model
{

    protected $table = 'salles';
    protected $primaryKey = 'id_salle';
    public $timestamps = false;
    protected $fillable = [
        'numero_salle',
        'nom_salle',
        'etage_salle',
        'places'
    ];
    protected $guarded = [];

    public function sceances()
    {
        return $this->hasMany('App\Models\Sceance', 'id_salle');
    }

}
