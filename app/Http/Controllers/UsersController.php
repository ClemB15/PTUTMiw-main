<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;

            return $permissions;
        }

        $roles = Role::all();

        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //validate the fields
        $request->validate([
            'nomUser' => 'required|max:255',
            'prenomUser' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'telUser' => 'max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = new User;
        $user->nomUser = $request->nomUser;
        $user->prenomUser = $request->prenomUser;
        $user->email = $request->email;
        $user->telUser = $request->telUser;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }else{
            $user->roles()->attach('user');
            $user->save();
        }

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $userRole = $user->roles->first();
        if($userRole != null){
            $rolePermissions = $userRole->allRolePermissions;
        }else{
            $rolePermissions = null;
        }

        // dd($rolePermission);

        return view('admin.users.edit', [
            'user'=>$user,
            'roles'=>$roles,
            'userRole'=>$userRole,
            'rolePermissions'=>$rolePermissions
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $id = $user->id;

        //validate the fields
        $request->validate([
            'nomUser' => 'required|max:255',
            'prenomUser' => 'required|max:255',
            'telUser' => 'max:255',
            'email' => 'required||email|unique:users,email,'.$id,
        ]);


        $user->nomUser = $request->nomUser;
        $user->prenomUser = $request->prenomUser;
        $user->email = $request->email;
        $user->telUser = $request->telUser;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $user->roles()->detach();

        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }

        return redirect('/profile');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect('/users');
    }
}
