<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Fonction
 */
class Fonction extends Model
{
    protected $table = 'fonctions';

    protected $primaryKey = 'id_fonction';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'salaire',
        'cadre'
    ];

    protected $guarded = [];

    public function personnes()
    {
        return $this->belongsToMany('App\Models\Personne', 'employes', 'id_fonction', 'id_personne');
    }
        
}