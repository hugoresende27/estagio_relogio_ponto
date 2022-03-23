<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            
   
            'role'=> 'EMP',
            'nif'=>rand(111111111,999999999),
            'niss'=>rand(111111111,999999999),
            'emercontact'=>rand(91111111,96222222),
            'bicc'=>rand(111111,999999),
           
            
            'iban'=>rand(111111,99999),
            'details'=>'details here',
            'start_date'=>'19'.rand(88,99).'/'.rand(1,12).'/'.rand(1,27),

            'company_id'=> 1,
            'department_id'=> 1,
            'schedule_id'=> rand(1,3),
            'tenant_id'=>1,
            'location_id'=>Location::factory(),
            
        ];
    }
}
