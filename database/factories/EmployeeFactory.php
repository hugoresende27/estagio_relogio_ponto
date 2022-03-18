<?php

namespace Database\Factories;

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
            'emer_contact'=>rand(91111111,96222222),
            'bi_cc'=>rand(111111,999999),
            'company_id'=> 1,
            // 'department_id'=> Department::factory(),
            // 'tenant_id'=>Tenant::factory()
            'tenant_id'=>1
        ];
    }
}
