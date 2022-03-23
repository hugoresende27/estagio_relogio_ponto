<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clockpointentry>
 */
class ClockpointentryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employee_id' => rand(1,20),
            'clock_in' => '2022/01/15:'.rand(0,23).':'.rand(1,59).':00', 
            'clock_out'=>'2022/01/15:'.rand(0,23).':'.rand(1,59).':00',
            'tenant_id'=>1
        ];
    }
}
