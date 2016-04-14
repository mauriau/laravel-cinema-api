<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Forfait
 */
class Forfait extends Model
{
    protected $table = 'forfaits';

    protected $primaryKey = 'id_forfait';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'resum',
        'prix',
        'duree_jours'
    ];

    protected $guarded = [];

        
}