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
        $role1 = Role::create(['name' => 'patient']);
        $role1->givePermissionTo('read clocking');
        $role1->givePermissionTo('update clocking');
        $role1->givePermissionTo('delete clocking');

        // create roles and assign existing permissions to staff
        $role2 = Role::create(['name' => 'general']);
        $role2->givePermissionTo('create history');
        $role2->givePermissionTo('update history');
        $role2->givePermissionTo('delete history');
        $role2->givePermissionTo('delete history');

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role3 = Role::create(['name' => 'Super-Admin']);

        // create demo users
        User::create([
            'name' => 'Example Patient User',
            'username' => 'patient',
            'password' => bcrypt('123456')
        ])->assignRole($role1);

        User::create([
            'name' => 'Example Medical User',
            'username' => 'general',
            'password' => bcrypt('123456')
        ])->assignRole($role2);

        User::create([
            'name' => 'Example Super-Admin User',
            'username' => 'admin',
            'password' => bcrypt('123456')
        ])->assignRole($role3);
        

        /* User::create([
            'name' => 'Marcos Socrates',
            'email' => 'correo@correo.com',
            'password' => bcrypt('123456')
        ]); */

        // User::factory(99)->create();
    }
}
