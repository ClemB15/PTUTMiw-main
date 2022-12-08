<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{

    public function photos() {
    	return $this->hasMany(Photo::class);
    }
    public function sousCategorie() {
    	return $this->belongsTo(SousCategorie::class);
    }
    public function categorie() {
    	return $this->belongsTo(Categorie::class);
    }
    public function ville() {
    	return $this->belongsTo(Ville::class);
    }
    public function consultations() {
    	return $this->hasMany(Consultation::class);
    }
    public function offre() {
    	return $this->hasOne(Offre::class, 'offrechoisie');
    }
    public function avis() {
    	return $this->hasMany(Commentaire::class);
    }
    public function user() {
    	return $this->belongsTo(User::class);
    }
    public function log() {
    	return $this->hasOne(Log::class);
    }
    public function produits() {
    	return $this->hasMany(Produit::class);
    }

    public $timestamps = false;
	
    public static function commercesInBetween($northWest, $southEast) {
        return Commerce::whereBetween('latCom', [$southEast[0], $northWest[0]])
                        ->whereBetween('longCom', [$northWest[1], $southEast[1]])
                        ;
    }
}
