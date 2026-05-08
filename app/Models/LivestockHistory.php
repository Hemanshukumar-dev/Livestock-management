<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LivestockHistory extends Model
{
    protected $table = 'livestock_histories';

    protected $fillable = [
        'livestock_id',
        'event_type',
        'description',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function livestock()
    {
        return $this->belongsTo(Livestock::class, 'livestock_id');
    }
}
