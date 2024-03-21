<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected static ?string $password;

    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $superAdmin = User::create(array_merge([
                'email' => 'superadmin@mail.com',
                'name' => 'superadmin',
            ], $default_user_value));
    
            $teacher = User::create(array_merge([
                'email' => 'teacher@mail.com',
                'name' => 'teacher',
            ], $default_user_value));
    
            $student = User::create(array_merge([
                'email' => 'student@mail.com',
                'name' => 'student',
            ], $default_user_value));
    
            $role_superadmin = Role::create(['name' => 'superadmin']);
            $role_teacher = Role::create(['name' => 'teacher']);
            $role_student = Role::create(['name' => 'student']);
    
            $permission = Permission::create(['name' => 'read role']);
            $permission = Permission::create(['name' => 'create role']);
            $permission = Permission::create(['name' => 'update role']);
            $permission = Permission::create(['name' => 'delete role']);
            Permission::create(['name' => 'read master']);

            $role_superadmin->givePermissionTo('read role');
            $role_superadmin->givePermissionTo('create role');
            $role_superadmin->givePermissionTo('update role');
            $role_superadmin->givePermissionTo(['delete role', 'read master']);
    
            $superAdmin->assignRole('superadmin');
            $teacher->assignRole('teacher');
            $student->assignRole('student');

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }

        
    }
}
