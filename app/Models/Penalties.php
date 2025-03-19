<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalties extends Model
{
    protected $guarded = ['id'];

    public function car() {
        return $this->belongsTo(Car::class, 'id_car', 'id');
    }

    public function carReturns() {
        return $this->hasMany(CarReturn::class);
    }
}
