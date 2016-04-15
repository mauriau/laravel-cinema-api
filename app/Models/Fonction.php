<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  required={"nom"},
 *  @SWG\Xml(name="Fonction"),
 *  @SWG\Property(format="int64", property="id_fonction", type="number", default=5),
 *  @SWG\Property(format="string", property="nom", type="string", default="Admin"),
 *  @SWG\Property(format="string", property="resum", type="string", default="film de gangsters américain réalisé par Quentin Tarantino et sorti en 1994"),
 *  @SWG\Property(format="date", property="date_debut_affiche", type="date", default="1994-01-01"),
 *  @SWG\Property(format="date", property="date_fin_affiche", type="date", default="1994-06-01"),
 *  @SWG\Property(format="int64", property="duree_minutes", type="number", default=240),
 *  @SWG\Property(format="int64", property="annee_production", type="number", default=1993)
 * )
 */
class Fonction extends Model
{
    protected $table = 'fonctions';

    protected $primaryKey = 'id_fonction';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'salaire',
        'cadre'
    ];

    protected $guarded = [];

    public function personnes()
    {
        return $this->belongsToMany('App\Models\Personne', 'employes', 'id_fonction', 'id_personne');
    }
        
}