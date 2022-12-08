<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRolesAndPermissions;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndPermissions;

    // public function panier() {
    //     return $this->belongsToMany(Serie::class);
    // }
    public function logs() {
        return $this->hasMany(Log::class);
    }
    public function commerces() {
        return $this->hasMany(Commerce::class);
    }
    public function avis() {
        return $this->hasMany(Commentaire::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
