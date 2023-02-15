<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);

        Permission::create(['name' => 'admin.home',
                            'description' => 'Ver Panel de Control'])->syncRoles([$role1,$role2]);//Ruta principal para el DashBoard

        Permission::create(['name' => 'admin.users.index',
                            'description' => 'Ver Listado de Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit',
                            'description' => 'Editar Roles del Usuario'])->syncRoles([$role1]);
                

        Permission::create(['name' => 'admin.categories.index',
                            'description' => 'Ver Lista de Categorías'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.categories.create',
                            'description' => 'Crear Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit',
                            'description' => 'Editar Categorías'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy',
                            'description' => 'Eliminar Categorías'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.tags.index',
                            'description' => 'Ver Lista de Etiquetas'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.tags.create',
                            'description' => 'Crear Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit',
                            'description' => 'Editar Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy',
                            'description' => 'Eliminar Etiquetas'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.posts.index',
                            'description' => 'Ver Listado de Posts'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.posts.create',
                            'description' => 'Crear Nuevo Post'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.posts.edit',
                            'description' => 'Editar Post'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'admin.posts.destroy',
                            'description' => 'Eliminar Post'])->syncRoles([$role1,$role2]);

        
    }
}
