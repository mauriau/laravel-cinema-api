<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Personne
 */
class Personne extends Model
{
    protected $table = 'personnes';

    protected $primaryKey = 'id_personne';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'email',
        'adresse',
        'cpostal',
        'ville',
        'pays'
    ];

    protected $guarded = [];

        
}