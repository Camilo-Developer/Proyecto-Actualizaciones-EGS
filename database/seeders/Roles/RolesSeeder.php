<?php

namespace Database\Seeders\Roles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Rol2']);

        //Permiso admin Dashboard
        Permission::create([
            'name' => 'admin.dashboard',
            'description'=> 'Ver panel administrativo ( Admin )'
        ])->syncRoles([$role1]);

        //Permiso User Dashboard
        Permission::create([
            'name' => 'dashboard',
            'description'=> 'Ver panel administrativo rol 2'
        ])->syncRoles([$role1, $role2]);

        //Permisos de estados
        Permission::create([
            'name' => 'admin.states.index',
            'description'=> 'Listado de estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.create',
            'description'=> 'Creación del estado'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.edit',
            'description'=> 'Edición del estado'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.show',
            'description'=> 'Detalle del estado'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.destroy',
            'description'=> 'Eliminación del estado'
        ])->syncRoles([$role1]);


        //Permisos de Roles
        Permission::create([
            'name' => 'admin.roles.index',
            'description'=> 'Listado de Roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.create',
            'description'=> 'Creación del rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.edit',
            'description'=> 'Edición del rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.show',
            'description'=> 'Detalle del rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.destroy',
            'description'=> 'Eliminación del rol'
        ])->syncRoles([$role1]);

        //Permisos de Organizations
        Permission::create([
            'name' => 'admin.organizations.index',
            'description'=> 'Listado de organizaciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.organizations.create',
            'description'=> 'Creación de la organización'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.organizations.edit',
            'description'=> 'Edición de la organización'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.organizations.show',
            'description'=> 'Detalle de la organización'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.organizations.destroy',
            'description'=> 'Eliminación de la organización'
        ])->syncRoles([$role1]);


        //Permisos de Productos
        Permission::create([
            'name' => 'admin.products.index',
            'description'=> 'Listado de productos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.products.create',
            'description'=> 'Creación de la producto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.products.edit',
            'description'=> 'Edición de la producto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.products.show',
            'description'=> 'Detalle de la producto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.products.destroy',
            'description'=> 'Eliminación de la producto'
        ])->syncRoles([$role1]);


        //Permisos de proyectos
        Permission::create([
            'name' => 'admin.proyects.index',
            'description'=> 'Listado de proyectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.proyects.create',
            'description'=> 'Creación del proyecto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.proyects.edit',
            'description'=> 'Edición del proyecto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.proyects.show',
            'description'=> 'Detalle del proyecto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.proyects.destroy',
            'description'=> 'Eliminación del proyecto'
        ])->syncRoles([$role1]);

        //Permisos de Suscripciones
        Permission::create([
            'name' => 'admin.subscriptions.index',
            'description'=> 'Listado de suscripciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.subscriptions.create',
            'description'=> 'Creación de la suscripción'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.subscriptions.edit',
            'description'=> 'Edición de la suscripción'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.subscriptions.show',
            'description'=> 'Detalle de la suscripción'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.subscriptions.destroy',
            'description'=> 'Eliminación de la suscripción'
        ])->syncRoles([$role1]);

        //Permisos de Actualización de projectos de las organizaciones
        Permission::create([
            'name' => 'admin.uptproorganizations.index',
            'description'=> 'Listado de actualizaciones de los projectos de las organizaciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.uptproorganizations.create',
            'description'=> 'Creación de la actualización de los projectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.uptproorganizations.edit',
            'description'=> 'Edición de la actualización de los projectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.uptproorganizations.show',
            'description'=> 'Detalle de la actualización de los projectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.uptproorganizations.destroy',
            'description'=> 'Eliminación de la actualización de los projectos'
        ])->syncRoles([$role1]);


         //Permisos de logsuptproorgs 
         Permission::create([
            'name' => 'admin.logsuptproorgs.index',
            'description'=> 'Listado de Logs de la actualización del proyecto'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.logsuptproorgs.create',
            'description'=> 'Creación del log de la actualización de los projectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.logsuptproorgs.edit',
            'description'=> 'Edición del log de la actualización de los projectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.logsuptproorgs.show',
            'description'=> 'Detalle del log de la actualización de los projectos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.logsuptproorgs.destroy',
            'description'=> 'Eliminación del log de la actualización de los projectos'
        ])->syncRoles([$role1]);

        //Permisos de usuarios 
        Permission::create([
            'name' => 'admin.users.index',
            'description'=> 'Listado de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.create',
            'description'=> 'Creación del usuario'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.edit',
            'description'=> 'Edición del usuario'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.show',
            'description'=> 'Detalle del usuario'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.destroy',
            'description'=> 'Eliminación del usuario'
        ])->syncRoles([$role1]);
    }
}
