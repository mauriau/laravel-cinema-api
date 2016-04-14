<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Employe
 */
class Employe extends Model
{
    protected $table = 'employes';

    protected $primaryKey = 'id_employe';

	public $timestamps = false;

    protected $fillable = [
        'id_personne',
        'id_fonction'
    ];

    protected $guarded = [];

        
}