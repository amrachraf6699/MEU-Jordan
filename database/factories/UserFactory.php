<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'employee_number' => $this->faker->unique()->numberBetween(1000, 9000),
            'role' => $this->faker->randomElement(['admin', 'committee_member' , 'user']),
            'username' => $this->faker->unique()->userName,
            'password' => 'Password'
        ];
    }

    /**
     * Indicate that the user is admin
     */
    public function admin(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'username' => 'admin',
                'role' => 'admin',
                'password' => 'Admin3@1'
            ];
        });
    }

    /**
     * Indicate that the user has full information
     */

    public function fullInformation(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'full_name' => $this->faker->name,
                'employee_number' => $this->faker->unique()->numberBetween(1000, 9000),
                'role' => $this->faker->randomElement(['admin', 'committee_member' , 'user']),
                'username' => $this->faker->unique()->userName,
                'password' => 'Password'
            ];
        });
    }

    /**
     * Indicate that the user has full details
     */
    public function fullDetails(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'program_id' => $this->faker->numberBetween(1, 4),
                'department_id' => $this->faker->numberBetween(1, 4),
            ];
        });
    }
}
