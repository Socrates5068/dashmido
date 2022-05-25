<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        // create permissions for admin
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'register user']);
        Permission::create(['name' => 'deregister user']);

        // create permissions for patient
        Permission::create(['name' => 'read clocking']);
        Permission::create(['name' => 'update clocking']);
        Permission::create(['name' => 'delete clocking']);

        // create permissions for staff
        Permission::create(['name' => 'create history']);
        Permission::create(['name' => 'read history']);
        Permission::create(['name' => 'update history']);
        Permission::create(['name' => 'delete history']);

        // create roles and assign existing permissions to patient
        $role1 = Role::create(['name' => 'Paciente']);
        $role1->givePermissionTo('read clocking');
        $role1->givePermissionTo('update clocking');
        $role1->givePermissionTo('delete clocking');

        // create roles and assign existing permissions to staff
        $role2 = Role::create(['name' => 'Médico']);
        $role2->givePermissionTo('create history');
        $role2->givePermissionTo('read history');
        $role2->givePermissionTo('update history');
        $role2->givePermissionTo('delete history');
        $role2->givePermissionTo('update user');


        // create roles and assign existing permissions to a nurse
        $role3 = Role::create(['name' => 'Enfermera']);
        $role3->givePermissionTo('create history');
        $role3->givePermissionTo('read history');
        $role3->givePermissionTo('update history');
        $role3->givePermissionTo('delete history');
        $role2->givePermissionTo('update user');

        // create roles and assign existing permissions to an administrator
        $role4 = Role::create(['name' => 'Administrador']);
        $role4->givePermissionTo('create user');
        $role4->givePermissionTo('read user');
        $role4->givePermissionTo('update user');
        $role4->givePermissionTo('register user');
        $role4->givePermissionTo('deregister user');
        $role4->givePermissionTo('create history');
        $role4->givePermissionTo('read history');
        $role4->givePermissionTo('update history');
        $role4->givePermissionTo('delete history');
        $role4->givePermissionTo('read clocking');
        $role4->givePermissionTo('update clocking');
        $role4->givePermissionTo('delete clocking');
        $role4->givePermissionTo('create history');
        $role4->givePermissionTo('update history');
        $role4->givePermissionTo('delete history');
        $role4->givePermissionTo('delete history');

        // create demo users
        User::create([
            'person_id' => 1,
            'name' => 'Administrador', // administrador
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'email_verified_at' => now()
        ])->assignRole($role4);

        User::create([
            'person_id' => 2,
            'name' => 'Yolanda Yañez', // enfermera
            'username' => '8746523',
            'password' => bcrypt('8746523'),
            'email_verified_at' => now()
        ])->assignRole($role3);

        User::create([
            'person_id' => 3,
            'name' => 'Jairo Carrion', // pediatra
            'username' => '12012568',
            'password' => bcrypt('12012568'),
            'email_verified_at' => now()
        ])->assignRole($role2);

        User::create([
            'person_id' => 4,
            'name' => 'Elias Ramos', // Genecólogo
            'username' => '1207568',
            'password' => bcrypt('1207568'),
            'email_verified_at' => now()
        ])->assignRole($role2);

        User::create([
            'person_id' => 5,
            'name' => 'Maria Eugenia', // médico general
            'username' => '12496568',
            'password' => bcrypt('12496568'),
            'email_verified_at' => now()
        ])->assignRole($role2);

        User::create([
            'person_id' => 6,
            'name' => 'Paciente',
            'username' => 'paciente',
            'password' => bcrypt('123456'),
            'email_verified_at' => now()
        ])->assignRole($role1);
        
        // User::factory(99)->create();
    }
}
