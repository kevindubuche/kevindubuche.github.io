<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    
    
    public $table = 'hospitals';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'nom',
        'adresse',
        'code_hospital',
        'maximum_visites_par_jour',
        'commune',
        'departement'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'code_hospital' => 'string',
        'adresse' => 'string',
        'maximum_visites_par_jour' => 'integer',
        'commune' => 'string',
        'departement' => 'string'
       
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'nullable|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'prenom' => 'nullable|string|max:255',
        'code_hospital' => 'nullable|string|max:255',
        'maximum_visites_par_jour' => 'nullable',
        'commune' => 'nullable|string|max:255',
        'departement' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];


}
