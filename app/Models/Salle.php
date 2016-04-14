<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Salle
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

        
}