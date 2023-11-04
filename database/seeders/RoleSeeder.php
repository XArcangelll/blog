<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      $role1 = Role::create(["name"=>"Admin"]);
      $role2 =  Role::create(["name"=>"Bloguer"]);

       Permission::create(['name'=>"admin.home","description"=>"Ver Dashboard"])->syncRoles([$role1,$role2]);

       Permission::create(['name'=>"admin.users.index","description"=>"Ver Listado de Usuarios"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.users.edit","description"=>"Ver Asignación de Rol"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.users.update","description"=>"Asignar Rol"])->syncRoles([$role1]);

       Permission::create(['name'=>"admin.permissions.edit","description"=>"Ver Estado de los Permisos"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.permissions.update","description"=>"Cambiar estado de los Permisos"])->syncRoles([$role1]);

       Permission::create(['name'=>"admin.roles.index","description"=>"Ver Listado de Roles"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.roles.create","description"=>"Crear Rol"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.roles.edit","description"=>"Editar Rol"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.roles.destroy","description"=>"Eliminar Rol"])->syncRoles([$role1]);

       Permission::create(['name'=>"admin.categories.index","description"=>"Ver Listado de Categorías"])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>"admin.categories.create","description"=>"Crear Categoría"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.categories.edit","description"=>"Editar Categoría"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.categories.destroy","description"=>"Eliminar Categoría"])->syncRoles([$role1]);

       Permission::create(['name'=>"admin.tags.index","description"=>"Ver listado de Etiquetas"])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>"admin.tags.create","description"=>"Crear Etiqueta"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.tags.edit","description"=>"Editar Etiqueta"])->syncRoles([$role1]);
       Permission::create(['name'=>"admin.tags.destroy","description"=>"Eliminar Etiqueta"])->syncRoles([$role1]);


       Permission::create(['name'=>"admin.posts.index","description"=>"Ver listado de Posts"])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>"admin.posts.create","description"=>"Crear Post"])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>"admin.posts.edit","description"=>"Editar Post"])->syncRoles([$role1,$role2]);
       Permission::create(['name'=>"admin.posts.destroy","description"=>"Eliminar Post"])->syncRoles([$role1,$role2]);

    }
}
