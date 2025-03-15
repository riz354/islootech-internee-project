<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function(){
            $admin = User::create([
                'name'=>'Admin',
                'email'=>"admin@gmail.com",
                'phone_number'=>123,
                'password'=>Hash::make('admin'),


            ]);
            $role = Role::where('role_name','Admin')->first()->id;
            $admin->roles()->attach($role);
        });

    }
}
