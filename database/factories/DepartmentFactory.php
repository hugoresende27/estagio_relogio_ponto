<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            
            'name' => $this->faker->word(),
            'email' => $this->faker->unique()->safeEmail(),
            'company_id'=>1,
            
            'tenant_id'=>1
        ];
    }
}
