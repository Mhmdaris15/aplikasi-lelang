<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        return [
            "username" => $this->faker->userName,
            "firstname" => $this->faker->firstName,
            "lastname" => $this->faker->lastName,
            "email" => $this->faker->unique()->safeEmail,
            "role" => $this->faker->randomElement(["admin", "petugas", "user"]),
            "email_verified_at" => now(),
            "password" => "password",
            "phone" => $this->faker->phoneNumber,
            "address" => $this->faker->address,
            "city" => $this->faker->city,
            "country" => $this->faker->country,
            "postal" => $this->faker->postcode,
            "about" => $this->faker->text,
            "remember_token" => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
