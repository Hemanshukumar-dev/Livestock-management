<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    // Allow mass assignment
    protected $fillable = ['user_id', 'owner_code', 'name', 'phone', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One owner has many livestock
    public function livestock()
    {
        return $this->hasMany(Livestock::class);
    }
}