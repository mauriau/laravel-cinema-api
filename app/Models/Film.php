<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Film
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

        
}