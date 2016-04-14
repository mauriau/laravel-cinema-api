<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reduction
 */

/**
 *
 *   @SWG\definition(
 *   required={"id_reduction"},
 *   @SWG\Xml(name="Film"),
 *   @SWG\Property(format="int64", property="id_reduction", type="number", default=1),
 *   @SWG\Property(format="string", property="nom", type="string", default="réduction"),
 *   @SWG\Property(format="date", property="date_debut", type="date", default="2000-01-01"),
 *   @SWG\Property(format="date", property="date_fin", type="date", default="2000-01-02"),
 *   @SWG\Property(format="int64", property="pourcentage_reduction", type="number", default=0),
 *   )
 *
 */
class Reduction extends Model
{
    protected $table = 'reductions';

    protected $primaryKey = 'id_reduction';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'date_debut',
        'date_fin',
        'pourcentage_reduction'
    ];

    protected $guarded = [];

        
}