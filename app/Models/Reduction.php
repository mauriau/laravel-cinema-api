<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reduction
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