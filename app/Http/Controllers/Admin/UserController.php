<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit');
        $this->middleware('can:admin.users.update')->only('update');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {


        // return $user->roles->pluck("id")->all();

        // return Role::whereIn('id',$request->roles)->get();

        //  $permisosBloguer = Role::where('id',2)->get()->flatMap(function($role){
        //      return $role->permissions->pluck('name');
        //  });

        //  return $permisosBloguer;


        // return Role::where('id',2)->get()->flatMap(function ($role) {
        //     return $role->permissions;
        // });

        //     return $user->roles->flatMap(function ($role) {
        //         return $role->permissions;
        //     });

        //  return $request->roles;






        $user->roles()->sync($request->roles);
        // $permisosBloguer = Role::where('id',2)->get()->flatMap(function($role){
        //     return $role->permissions->pluck('id');
        //  });
        if ($request->roles) {


            $roles =  Role::whereIn('id', $request->roles)->get();

            $permissions = [];

            foreach ($roles as $role) {
                // return $role->permissions;
                if($role->id == 1){
                    continue;
                }

                $permissions = array_merge($permissions, $role->permissions->toArray());
            }
            $uniquePermissions = collect($permissions)->unique('id')->values()->pluck('name')->toArray();

             $permisosQuitables = ["admin.posts.create", "admin.posts.edit", "admin.posts.destroy"];

            $permisosFiltrados = array_filter($permisosQuitables, function ($permiso) use ($uniquePermissions) {
                return in_array($permiso, $uniquePermissions);
            });

            $permisosIds = Permission::whereIn('name', $permisosFiltrados)->pluck('id')->toArray();

            $user->permissions()->sync($permisosIds);

            // foreach ($request->roles as $rol) {



            //     if ($rol == 2) {
            //         $user->givePermissionTo(["admin.posts.create", "admin.posts.edit", "admin.posts.destroy"]);
            //     } else {
            //         $user->permissions()->sync([]);
            //     }
            // }
        } else {
            $user->permissions()->sync([]);
        }




        return redirect()->route("admin.users.edit", $user)->with("info", "Se asignaron los roles correctamente");
    }
}
