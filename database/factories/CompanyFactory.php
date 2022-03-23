<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'nif'=>rand(111111111,999999999),
            'tenant_id'=>1,
            'location_id'=>Location::factory(),
        ];
    }
}
