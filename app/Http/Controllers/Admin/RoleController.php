<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
     {
         $this->middleware('can:admin.roles.index')->only('index');
         $this->middleware('can:admin.roles.create')->only('create','store');
         $this->middleware('can:admin.roles.edit')->only('edit','update');
         $this->middleware('can:admin.roles.destroy')->only('destroy');
     }

    public function index()
    {

       $roles = Role::all();

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions = Permission::all();

        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        "name"=> "required"
       ]);


          // crear Rol
        // $role = Role::create($request->all());  error de array!!!
        // $role = Role::create(['name' => $request->name]);

        // actualiza los permisos / sincroniza los permisos
        // $role->permissions()->sync($request->permissions);


       $role = Role::create($request->all());

       $role->permissions()->sync($request->permissions);

       return redirect()->route('admin.roles.edit',compact('role'))->with('info','El rol se creó con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
      return view('admin.roles.show',$role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        // return $role;

        // $this->authorize('author',$post);
         $this->authorize('editarAdmin',$role);

        $request->validate([
            "name"=> "required"
        ]);

           $role->update($request->all());

           $role->permissions()->sync($request->permissions);

           return redirect()->route('admin.roles.edit',compact('role'))->with('info','El rol se actualizó con éxito');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {

        // return $role->id !== 1 ;

        // if (Gate::authorize('update', $model)) {
        //     // Acción autorizada
        // }

        // $this->authorize('eliminarRoleAdmin',$role);

        $this->authorize('eliminarAdmin', $role);

       $role->delete();

       return redirect()->route('admin.roles.index')->with('info','El rol se se eliminó con éxito');
    }
}
