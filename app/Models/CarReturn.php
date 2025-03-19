<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarReturn extends Model
{
    protected $guarded = ['id'];

    public function register() {
        return $this->belongsTo(Register::class, 'id_tenant', 'id');
    }

    public function car() {
        return $this->belongsTo(Car::class, 'id_car', 'id');
    }

    public function penalties() {
        return $this->belongsTo(Penalties::class, 'id_penalties', 'id');
    }
}
