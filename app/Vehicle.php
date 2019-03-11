<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id', 'name','number','type'
    ];
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
