<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assigner_hospital_a_communes extends Model
{
    
    
    public $table = 'assigner_hospital_a_communes';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'id_hospital',
        'commune'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_hospital' => 'integer',
        'commune' => 'string'
       
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'commune' => 'nullable|string|max:255'
    ];
}
