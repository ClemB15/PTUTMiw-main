<?php


namespace App;

use App\Role;
use App\Permission;
use Illuminate\Support\Facades\Auth;


class Rights
{

    /**
     * @param int $user
     * @param string $role
     * @return bool
     */
    public function is(int $user,string $role)
    {
        if($user->find($role)){
            return true;
        }
    }

    /**
     * @param int $user
     * @param string $permission
     * @return bool
     */
    public function can(int $user,string $permission)
    {
        if($user->find($permission)){
            return true;
        }
    }

    /**
     * @param int $user
     * @param array $permissions
     * @return bool
     */
    public function canAll(int $user,$permissions = [])
    {
        if($user->find($permissions)){
            return true;
        }
    }

    /**
     * @param int $user
     * @param array $permissions
     * @return bool
     */
    public function canAtLeast(int $user,$permissions = [])
    {
        if($user->contains('slug',$permissions)){
            return true;
        }
    }

    /**
     * @param string $role
     * @return bool
     */
    public function authIs(string $role)
    {
        $id = Auth::user();
        if($id->find($role)){
            return true;
        }
    }

}
