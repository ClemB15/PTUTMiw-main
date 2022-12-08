<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    public function commerce() {
    	return $this->belongsToMany(Commerce::class, 'offrechoisie');
    }
}
