<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'street'=>$this->faker->streetName(),
            'door_number'=>rand(1,69),
            'zip_code'=>$this->faker->postcode(),
            'tenant_id'=>1,
        ];
    }
}
