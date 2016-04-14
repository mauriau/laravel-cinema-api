<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @SWG\Definition(
 *  required={"id_personne", "id_abonnement"},
 *  @SWG\Xml(name="Membre"),
 *  @SWG\Property(format="int64", property="id_personne", type="number", default=1),
 *  @SWG\Property(format="int64", property="id_abonnement", type="number", default=1),
 *  @SWG\Property(format="date", property="date_inscription", type="date", default="1994-01-01"),
 *  @SWG\Property(format="date", property="debut_abonnement", type="date", default="1994-06-01"),
 * )
 */
class Membre extends Model
{
    protected $table = 'membres';

    protected $primaryKey = 'id_membre';

	public $timestamps = false;

    protected $fillable = [
        'id_personne',
        'id_abonnement',
        'date_inscription',
        'debut_abonnement'
    ];

    protected $guarded = [];

    public function abonnement()
    {
        return $this->belongsTo('App\Models\Abonnement', 'id_abonnement');
    }
        
}