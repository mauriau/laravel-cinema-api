<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  required={"titre"},
 *  @SWG\Xml(name="Film"),
 *  @SWG\Property(format="int64", property="id_film", type="number", default=42),
 *  @SWG\Property(format="int64", property="id_genre", type="number", default=17),
 *  @SWG\Property(format="int64", property="id_distributeur", type="number", default=12),
 *  @SWG\Property(format="string", property="titre", type="string", default="Pulp Fiction"),
 *  @SWG\Property(format="string", property="resum", type="string", default="film de gangsters américain réalisé par Quentin Tarantino et sorti en 1994"),
 *  @SWG\Property(format="date", property="date_debut_affiche", type="date", default="1994-01-01"),
 *  @SWG\Property(format="date", property="date_fin_affiche", type="date", default="1994-06-01"),
 *  @SWG\Property(format="int64", property="duree_minutes", type="number", default=240),
 *  @SWG\Property(format="int64", property="annee_production", type="number", default=1993)
 * )
 */
class Film extends Model
{

    protected $table = 'films';
    protected $primaryKey = 'id_film';
    public $timestamps = false;
    protected $fillable = [
        'id_genre',
        'id_distributeur',
        'titre',
        'resum',
        'date_debut_affiche',
        'date_fin_affiche',
        'duree_minutes',
        'annee_production'
    ];
    protected $guarded = [];

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre', 'id_genre');
    }

    public function distributeur()
    {
        return $this->belongsTo('App\Models\Distributeur', 'id_distributeur');
    }

}
