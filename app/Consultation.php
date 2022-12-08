<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    public function commerce() {
    	return $this->belongsTo(Commerce::class);
    }
}
