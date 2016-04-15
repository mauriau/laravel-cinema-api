<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seance
 *
 * @SWG\definition(
 *   required={"id"},
 *   @SWG\Xml(name="Seance"),
 *   @SWG\Property(format="int64", property="id", type="number", default=1),
 *   @SWG\Property(format="int64", property="id_film", type="number", default=1),
 *   @SWG\Property(format="int64", property="id_salle", type="number", default=1),
 *   @SWG\Property(format="int64", property="id_personne_ouvreur", type="number", default=1),
 *   @SWG\Property(format="int64", property="id_personne_technicien", type="number", default=1),
 *   @SWG\Property(format="int64", property="id_personne_menage", type="number", default=1),
 *   @SWG\Property(format="date", property="debut_seance", type="date", default="2016-04-15 10:30:00"),
 *   @SWG\Property(format="date", property="fin_seance", type="date", default="2016-04-15 11:30:00"),
 *   )
 *
 */
class Seance extends Model
{
    protected $table = 'seances';

    public $timestamps = false;

    protected $fillable = [
        'id_film',
        'id_salle',
        'id_personne_ouvreur',
        'id_personne_technicien',
        'id_personne_menage',
        'debut_seance',
        'fin_seance'
    ];

    protected $guarded = [];

        
}