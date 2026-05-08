<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    protected $table = 'livestock'; // FIX: correct table name

    protected $fillable = [
        'owner_id',
        'type',
        'breed',
        'age',
        'health_status',
        'tag_number',
        'source',
        'date_added',
    ];

    protected $casts = [
        'date_added' => 'date',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function histories()
    {
        return $this->hasMany(LivestockHistory::class, 'livestock_id');
    }
}