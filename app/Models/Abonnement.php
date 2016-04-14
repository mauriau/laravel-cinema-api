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

        
}