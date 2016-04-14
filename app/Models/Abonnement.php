<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Abonnement
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
    
    public function membre()
    {
        return $this->hasMany('App\Models\Membre', 'id_membre');
    }
}