<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Genre
 */
class Genre extends Model
{
    protected $table = 'genres';

    protected $primaryKey = 'id_genre';

	public $timestamps = false;

    protected $fillable = [
        'nom'
    ];

    protected $guarded = [];

        
}