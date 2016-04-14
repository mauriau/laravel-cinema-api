<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoriqueMembre
 */
class HistoriqueMembre extends Model
{
    protected $table = 'historique_membre';

    protected $primaryKey = 'id_historique';

	public $timestamps = false;

    protected $fillable = [
        'id_membre',
        'id_seance',
        'date'
    ];

    protected $guarded = [];

        
}