<?php

namespace App\Traits;

use App\Role;
use App\Permission;
trait HasRolesAndPermissions
{


    public function isAdmin()
    {
        if($this->roles->contains('slug', 'admin')){
            return true;
        }
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'users_roles');
    }

    /**
     * Check if the user has Role
     *
     * @param [type] $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if( strpos($role, ',') !== false ){//check if this is an list of roles

            $listOfRoles = explode(',',$role);

            foreach ($listOfRoles as $role) {
                if ($this->roles->contains('slug', $role)) {
                    return true;
                }
            }
        }else{
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }
}
