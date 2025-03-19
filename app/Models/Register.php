<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $guarded =['id'];

    public function rents() {
        return $this->hasMany(Rent::class);
    }

    public function carReturns() {
        return $this->hasMany(CarReturn::class);
    }
}
