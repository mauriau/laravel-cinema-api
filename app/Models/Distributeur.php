<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Distributeur
 */
class Distributeur extends Model
{
    protected $table = 'distributeurs';

    protected $primaryKey = 'id_distributeur';

	public $timestamps = false;

    protected $fillable = [
        'nom',
        'telephone',
        'adresse',
        'cpostal',
        'ville',
        'pays'
    ];

    protected $guarded = [];

        
}