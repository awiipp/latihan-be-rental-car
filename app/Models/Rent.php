<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $guarded = ['id'];

    public function register() {
        return $this->belongsTo(Register::class, 'id_tenant', 'id');
    }

    public function car() {
        return $this->belongsTo(Car::class, 'id_car', 'id');
    }
}
