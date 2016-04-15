<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  required={"id_membre", "id_seance"},
 *  @SWG\Xml(name="HistoriqueMembre"),
 *  @SWG\Property(format="int64", property="id_historique", type="number", default=1),
 *  @SWG\Property(format="int64", property="id_membre", type="number", default=1),
 *  @SWG\Property(format="int64", property="id_seance", type="number", default=1),
 *  @SWG\Property(format="date", property="date", type="date", default="2016-04-01"),
 * )
 */
class HistoriqueMembre extends Model
{

    protected $table = 'historique_membre';
    protected $primaryKey = 'id_historique';
    public $timestamps = false;
    protected $fillable = [
        'id_membre',
        'id_seance',
        'date'
    ];
    protected $guarded = [];

//    public function membre()
//    {
//        return $this->belongsTo('App\Models\Membre', 'id_membre');
//    }
//
//    public function sceance()
//    {
//        return $this->belongsTo('App\Models\Sceance', 'id_sceance');
//    }

}
