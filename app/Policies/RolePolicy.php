<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {
    //     //
    // }


    public function editarAdmin(User $user, Role $role)
    {


        // return $role->id !== 1 ? Response::allow('Permitido') : Response::deny('No se puede editar el rol Admin');

        return $role->id !== 1;


        // // return $role->id === "2"; 


    }


    // public function eliminarAdmin(User $user){

    //     return $user->roles->pluck("id")->contains(1) ? true : false;

    //     // $user->roles->pluck("id")->contains(1)

    //     // return $user->id  ;

    //     // if($user->id){
    //     //     return $role->id !== 1 ? Response::allow('Permitido'): Response::deny('No se debe eliminar el rol Admin');
    //     // }



    // }

    public function eliminarAdmin(User $user, Role $role)
    {
        // // Verificar si el usuario tiene el permiso "eliminar-rol"
        // if ($user->can('admin.roles.destroy')) {
        //     // Verificar si el rol no tiene el ID 1 (administrador)
        //     if ($role->id !== 2) {
        //         return true; // Se permite eliminar el rol
        //     }
        // }

        // return false; // No se permite eliminar el rol

        return $role->id !== 1;
    }
}
