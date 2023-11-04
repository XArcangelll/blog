<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function edit(User $user)
    {


        $permissions = $user->permissions;

        //    return $permissions->pluck('pivot')->pluck('status');

        // foreach ($permissions as $permission) {
        //     $pivot = $user->permissions->find($permission->id)->pivot;
        //     $status = $pivot->status;
        //     // Ahora tienes acceso al estado de cada permiso.
        // }

        //  return $status;

        // return $permissions;

        return view('admin.permissions.edit', compact('permissions', 'user'));
    }

    public function update(Request $request, User $user)
    {

        // return $request->all();
        // return $request->permissions;


        //    $user->permissions()->whereNotIn('permission_id', $request->permissions)->get();

        if(count($user->permissions)){
            if ($request->permissions) {
                $permisosNoAceptados =  $user->permissions()->whereNotIn('permission_id', $request->permissions)->pluck('id');
                $user->permissions()->whereIn('permission_id', $request->permissions)->updateExistingPivot($request->permissions, ['status' => 1]);
                $user->permissions()->whereNotIn('permission_id', $request->permissions)->updateExistingPivot($permisosNoAceptados, ['status' => 2]);
            }else{
                $user->permissions()->updateExistingPivot($user->permissions->pluck('id'), ['status' => 2]);
            }

            return redirect()->route('admin.permissions.edit',$user)->with('info','Permisos actualizados correctamente');
        }else{
            return redirect()->route('admin.permissions.edit',$user)->with('info','Usted no tiene ningun permiso directo');
        }
    }
}
