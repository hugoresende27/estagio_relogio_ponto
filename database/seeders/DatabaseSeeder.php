<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Company;
use App\Models\Department;
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
        \App\Models\Tenant::factory(1)->create();
         
         
        //  \App\Models\Company::factory(1)->create();
        //  \App\Models\Department::factory(1)->create();

         \App\Models\User::factory(5)->create();
    }
}
