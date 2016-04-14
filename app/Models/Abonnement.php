<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @SWG\Definition(
 *  required={"id_forfait"},
 *  @SWG\Xml(name="Abonnement"),
 *  @SWG\Property(format="int64", property="id_abonnement", type="number", default=1),
 *  @SWG\Property(format="int64", property="id_forfait", type="number", default=1),
 *  @SWG\Property(format="date", property="debut", type="date", default="1994-06-01"),
 * )
 */
class Abonnement extends Model
{
    protected $table = 'abonnements';

    protected $primaryKey = 'id_abonnement';

	public $timestamps = false;

    protected $fillable = [
        'id_forfait',
        'debut'
    ];

    protected $guarded = [];

    public function forfait()
    {
        return $this->belongsTo('App\Models\Forfait', 'id_forfait');
    }
    
    public function membres()
    {
        return $this->hasMany('App\Models\Membre', 'id_membre');
    }
}