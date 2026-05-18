<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    protected $fillable = [
        'title',
        'category',
        'animal_type',
        'scheme_type',
        'state_name',
        'eligibility',
        'benefits',
        'deadline',
        'apply_link',
        'description',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];
}
