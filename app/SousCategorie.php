<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    public $timestamps = false;
    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }
    public function commerces() {
        return $this->hasMany(Commerce::class);
    }
}
