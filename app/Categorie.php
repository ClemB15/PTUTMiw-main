<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function sousCategories() {
		return $this->hasMany(SousCategorie::class);
    }
    public function commerces() {
		return $this->hasMany(Commerce::class);
    }
    public $timestamps = false;

}
