<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Tenant::factory(2)->create();
         
         
        //  \App\Models\Company::factory(1)->create();
        //  \App\Models\Department::factory(1)->create();

        //  \App\Models\User::factory(5)->create();

        for ($i = 1; $i<3;$i++)
        {
            \DB::table('tenants')->insert([
                'name' => 'tenant'.$i,        
            ]);
        }

        \DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin',
            'role' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        \DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'a@a',
            'role'=>'boss',
            'password' => bcrypt('1111'),
            'tenant_id'=>1,
        ]);

        \DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'b@b',
            'role'=>'boss',
            'password' => bcrypt('1111'),
            'tenant_id'=>2,
        ]);

        for ($i = 1; $i<3;$i++)
        {
            \DB::table('companies')->insert([
                'name' => 'Empresa'.$i,
                'email' => 'e@e'.$i,
                'tenant_id'=> 1,
            ]);
            \DB::table('companies')->insert([
                'name' => 'Empresa'.$i*3,
                'email' => 'e@e'.$i,
                'tenant_id'=> 2,
            ]);

            \DB::table('users')->insert([
                'name' => 'func'.$i,
                'email' => 'func1'.$i,
                'email_verified_at' => now(),
                'password' => bcrypt('1111'), // password
                'remember_token' => Str::random(10),
                'role'=> 'func',
                'nif'=>rand(111111111,999999999),
                'emer_contact'=>rand(91111111,96222222),
                'bi_cc'=>rand(111111,999999),
                'company_id'=> $i,
                // 'department_id'=> $i,
                // 'tenant_id'=>Tenant::factory()
                'tenant_id'=>1
            ]);
            \DB::table('users')->insert([
                'name' => 'func'.$i*3,
                'email' => 'func2'.$i*3,
                'email_verified_at' => now(),
                'password' => bcrypt('1111'), // password
                'remember_token' => Str::random(10),
                'role'=> 'func',
                'nif'=>rand(111111111,999999999),
                'emer_contact'=>rand(91111111,96222222),
                'bi_cc'=>rand(111111,999999),
                'company_id'=> $i,
                // 'department_id'=> $i,
                // 'tenant_id'=>Tenant::factory()
                'tenant_id'=>2
            ]);
            
        }
    
      
    }
}
