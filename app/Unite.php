<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    public function produits() {
        return $this->hasMany(Produit::class);
    }
    public $timestamps = false;
}
