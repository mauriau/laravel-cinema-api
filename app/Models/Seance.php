<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Seance
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