<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class Produit extends Model
{
    // public function panier() {
    // 	return $this->belongsToMany(Panier::class);
    // }
    public function unite() {
    	return $this->belongsTo(Unit::class);
    }
    public function commerce() {
    	return $this->belongsTo(Commerce::class);
    }

    public $timestamps = false;
}
