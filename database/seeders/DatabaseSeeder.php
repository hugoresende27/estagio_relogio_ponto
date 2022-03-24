<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Tenant;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Models\Clockpointentry;
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
        \App\Models\Tenant::factory(3)->create();
         
         
         \App\Models\Company::factory(5)->create();
         \App\Models\Department::factory(2)->create();

         \App\Models\User::factory(5)->create();
        
         
        
        

        \DB::table('schedules')->insert([
            'company_id' => 1,
            'department_id'=>1,
            'shift_start' => '000000', 
            'shift_end'=>'080000', 
            'shift_type'=>'NIGHT',
            'shift_total'=>'080000',
            'tenant_id'=>1
        ]);
        \DB::table('schedules')->insert([
            'company_id' => 1,
            'department_id'=>1,
            'shift_start' => '080000', 
            'shift_end'=>'160000', 
            'shift_type'=>'DAY',
            'shift_total'=>'080000',
            'tenant_id'=>1
        ]);
        \DB::table('schedules')->insert([
            'company_id' => 1,
            'department_id'=>1,
            'shift_start' => '160000', 
            'shift_end'=>'000000', 
            'shift_type'=>'EVENING',
            'shift_total'=>'080000',
            'tenant_id'=>1
        ]);

        \App\Models\Employee::factory(20)->create();
        \App\Models\Clockpointentry::factory(20)->create();

        //  \DB::table('users')->insert([
        //     'name' => 'Administrador',
        //     'email' => 'admin@admin',
        //     'role' => 'admin',
        //     'password' => bcrypt('1111'),
        // ]);

       
    }
}
