<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_id' => 1,
            'shift_start' => rand(11,23).'0000', 
            'shift_end'=>rand(11,23).'0000', 
            'shift_type'=>'SHIFT_TEST',
            'shift_total'=>0,
            'tenant_id'=>1
        ];
    }
}
