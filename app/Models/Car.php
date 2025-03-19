<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = ['id'];

    public function rents() {
        return $this->hasMany(Car::class);
    }

    public function penalties() {
        return $this->hasMany(Penalties::class);
    }

    public function carReturns() {
        return $this->hasMany(CarReturn::class);
    }
}
