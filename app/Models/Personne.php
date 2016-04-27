<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(
 *  required={"email"},
 *  @SWG\Xml(name="Personne"),
 *  @SWG\Property(format="int64", property="id_personne", type="number", default=1),
 *  @SWG\Property(format="string", property="nom", type="string", default="Oscar"),
 *  @SWG\Property(format="string", property="prenom", type="string", default="Rabé"),
 *  @SWG\Property(format="date", property="date_naissance", type="date", default="1994-01-01"),
 *  @SWG\Property(format="string", property="email", type="string", default="toto@test.com"),
 *  @SWG\Property(format="string", property="adresse", type="string", default="rue rivolie"),
 *  @SWG\Property(format="string", property="cpostal", type="string", default="75001"),
 *  @SWG\Property(format="string", property="ville", type="string", default="Paris"),
 *  @SWG\Property(format="string", property="pays", type="string", default="France"),
 * )
 */
class Personne extends Model
{

    protected $table = 'personnes';
    protected $primaryKey = 'id_personne';
    public $timestamps = false;
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'email',
        'adresse',
        'cpostal',
        'ville',
        'pays'
    ];
    protected $guarded = [];
    
    
    public function fonctions()
    {
        return $this->belongsToMany('App\Models\Fonction', 'employes', 'id_personne', 'id_fonction');
    }

}
