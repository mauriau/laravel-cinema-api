<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Membre
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