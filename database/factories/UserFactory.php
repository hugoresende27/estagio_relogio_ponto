<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'email_verified_at' => now(),
            'password' => bcrypt('1111'), // password
            'remember_token' => Str::random(10),
            'role'=> 'USER',
            'nif'=>rand(111111111,999999999),
            'emer_contact'=>rand(91111111,96222222),
            'bi_cc'=>rand(111111,999999),
            // 'company_id'=> Company::factory(),
            // 'department_id'=> Department::factory(),
            // 'tenant_id'=>Tenant::factory()
            'tenant_id'=>rand(1,3)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
