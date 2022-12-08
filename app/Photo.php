<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public static function findOrFail(Commerce $commerce)
    {
    }

    public function commerce() {
    	return $this->belongsTo(Commerce::class);
    }

    public $timestamps = false;
}
