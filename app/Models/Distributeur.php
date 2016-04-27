<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Distributeur
 *
 *  @SWG\definition(
 *   required={"id_distributeur"},
 *   @SWG\Xml(name="Distributeur"),
 *   @SWG\Property(format="int64", property="id_distributeur", type="number", default=1),
 *   @SWG\Property(format="string", property="nom", type="string", default="Pathe"),
 *   @SWG\Property(format="string", property="telephone", type="string", default="0147200001"),
 *   @SWG\Property(format="string", property="adresse", type="string", default="nation"),
 *   @SWG\Property(format="string", property="cpostal", type="string", default="75012"),
 *   @SWG\Property(format="string", property="ville", type="string", default="Paris"),
 *   @SWG\Property(format="string", property="pays", type="string", default="France"),
 *   )
 *
 *
 */
class Distributeur extends Model
{

    protected $table = 'distributeurs';
    protected $primaryKey = 'id_distributeur';
    public $timestamps = false;
    protected $fillable = [
        'nom',
        'telephone',
        'adresse',
        'cpostal',
        'ville',
        'pays'
    ];
    protected $guarded = [];

    public function films()
    {
        return $this->hasMany('App\Models\Film', 'id_distributeur');
    }

}
