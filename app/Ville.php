<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    public function commerces() {
        return $this->hasMany(Commerce::class);
    }
    
    public $timestamps = false;
}
