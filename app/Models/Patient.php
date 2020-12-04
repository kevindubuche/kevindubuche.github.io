<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    
    public $table = 'patients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'nom',
        'prenom',
        'sexe',
        'date_naissance',
        'departement',
        'commune',
        'rue',
        'raison_test',
        'date_voyage',
        'hospital',
        'telephone',
        'date_rendez_vous'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'prenom' => 'string',
        'sexe' => 'string',
        'date_naissance' => 'date',
        'departement' => 'string',
        'commune' => 'string',
        'rue' => 'string',
        'raison_test' => 'string',
        'date_voyage' => 'date',
        'hospital' => 'string',
        'telephone' => 'string',
        'date_rendez_vous' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nom' => 'nullable|string|max:45',
        'role' => 'nullable|string|max:45',
        'prenom' => 'nullable|string|max:45',
        'sexe' => 'nullable|string|max:45',
        'departement' => 'nullable|string|max:255',
        'commune' => 'nullable|string|max:255',
        'rue' => 'nullable|string|max:255',
        'raison_test' => 'nullable|string|max:255',
        'hospital' => 'nullable|string|max:255',
        'telephone' => 'nullable|string|max:45',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/

    public function Hospital()
    {
        return $this->belongsTo(\App\Models\Hospital::class, 'hospital');
    }

}
