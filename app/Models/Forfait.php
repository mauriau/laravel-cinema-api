<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  required={"nom"},
 *  @SWG\Xml(name="Forfait"),
 *  @SWG\Property(format="int64", property="id_forfait", type="number", default=1),
 *  @SWG\Property(format="string", property="nom", type="string", default="etudiant"),
 *  @SWG\Property(format="string", property="resum", type="string", default="pour les etudiants"),
 *  @SWG\Property(format="int64", property="prix", type="number", default="15"),
 *  @SWG\Property(format="int64", property="duree_jours", type="number", default="15"),
 * )
 */
class Forfait extends Model
{
    protected $table = 'forfaits';

    protected $primaryKey = 'id_forfait';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'resum',
        'prix',
        'duree_jours'
    ];

    protected $guarded = [];

    public function abonnements()
    {
        return $this->hasMany('App\Models\Abonnement', 'id_abonnement');
    }    
        
}