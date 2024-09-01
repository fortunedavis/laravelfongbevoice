<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $validator = Role::create(['name' => 'validator']);
        $user = Role::create(['name' => 'user']);

        $p1  = Permission::create(['name' => 'delete record']);
        $p2  = Permission::create(['name' => 'delete user']);
        $p3  = Permission::create(['name' => 'edit user account']);
        $p4  = Permission::create(['name' => 'see user statistics']);
        $p5  = Permission::create(['name' => 'edit sentence']);
        $p6  = Permission::create(['name' => 'validate record']);
        $p7  = Permission::create(['name' => 'see own record']);
        $p8  = Permission::create(['name' => 'see all record']);

        $superadmin->syncPermissions([$p1,$p2,$p3,$p4,$p5,$p6]);
        $admin->syncPermissions([$p3,$p4,$p5,$p6]);
        $validator->syncPermissions([$p3,$p5,$p6]);
        $user->syncPermissions([$p3,$p7,$p5]);

        $superadmin_user = User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('RailsAfrica'),
        ]);

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        
        // $this->command->info('User seeded');
        $user->assignRole($admin);
        $superadmin_user->assignRole($superadmin);
    }
}
