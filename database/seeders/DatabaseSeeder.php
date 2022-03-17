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

        // \DB::table('users')->insert([
        //     'name' => 'Administrador',
        //     'email' => 'admin@admin',
        //     'role' => 'admin',
        //     'password' => bcrypt('admin'),
        // ]);

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

         ///////////////////////////////////////////////////////////////////////////////////////////////

        for ($i = 1; $i<2;$i++)
        {
            \DB::table('companies')->insert([
                'name' => 'Empresa'.$i.'TEN1',
                'email' => 'e@e'.$i.'TEN1',
                'tenant_id'=> $i,
            ]);

            \DB::table('company_tenant')->insert([
                'company_id' => 1,
                'tenant_id'=> 1,
            ]);
           


            \DB::table('departments')->insert([
                'tenant_id'=>1,
                'name'=>'Human Resources'.$i,
            
                'company_id'=>1,
               
            ]);
        }

         ///////////////////////////////////////////////////////////////////////////////////////////////

        for ($i = 1; $i<2;$i++)
        {
            \DB::table('companies')->insert([
                'name' => 'Empresa'.$i.'TEN2',
                'email' => 'e@e'.$i.'TEN2',
                'tenant_id'=> 2,
            ]);

            \DB::table('company_tenant')->insert([
                'company_id' => 2,
                'tenant_id'=> 2,
            ]);

            \DB::table('departments')->insert([
                'tenant_id'=>2,
                'name'=>'Human Resources'.$i,
            
                'company_id'=>2,
               
            ]);
        }

         ///////////////////////////////////////////////////////////////////////////////////////////////


        for ($i = 1; $i<2;$i++)
        {
            \DB::table('employees')->insert([
                'name' => 'ze'.$i,
                'email' => 'ze'.$i,
         
                'role'=> 'dev',
                'nif'=>rand(111111111,999999999),
                'niss'=>rand(111111111,999999999),
                'iban'=>rand(111111111,999999999),
                'details'=>'junior dev',
                'emer_contact'=>rand(91111111,96222222),
                'bi_cc'=>rand(111111,999999),
                'company_id'=> 1,
                'department_id'=> 1,
                // 'tenant_id'=>Tenant::factory()
                'tenant_id'=>1,
                'start_date'=>now()
            ]);
            \DB::table('employees')->insert([
                'name' => 'maria'.$i*3,
                'email' => 'maria'.$i*3,
     
                'role'=> 'rookie',
                'nif'=>rand(111111111,999999999),
                'niss'=>rand(111111111,999999999),
                'iban'=>rand(111111111,999999999),
                'details'=>'trainee',
                'emer_contact'=>rand(91111111,96222222),
                'bi_cc'=>rand(111111,999999),
                'company_id'=> 2,
                'department_id'=> 2,
                // 'tenant_id'=>Tenant::factory()
                'tenant_id'=>2,
                'start_date'=>now()
            ]);
            
        }


        ///////////////////////////////////////////////////////////////////////////////////////////////
    
        for ($i=1; $i<3; $i++)
        {

            // \DB::table('departments')->insert([
            //     'tenant_id'=>1,
            //     'name'=>'Human Resources'.$i,
            
            //     'company_id'=>1,
               
            // ]);


            \DB::table('locations')->insert([
                'tenant_id'=>$i,
                'country'=>'Cazakistan',
                'city'=>'Kiev',
                'street'=>'Flower street, 2'.$i,
                'zip_code'=>'5556-123',
                'company_id'=>$i,
                'department_id'=>$i
            ]);
          
            \DB::table('schedules')->insert([
                'tenant_id'=>$i, 
                'company_id'=>$i,
                'department_id'=>$i,
                'shift_start'=>100000,
                'shift_end'=>180000,
                'shift_type'=>'day'.$i,
            ]);
        }
      
    }
}
