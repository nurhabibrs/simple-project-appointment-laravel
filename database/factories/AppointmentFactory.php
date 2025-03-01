<?php

namespace Database\Factories;

use App\Enums\AppointmentEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' =>  $this->faker->firstName,
            'last_name' =>  $this->faker->lastName,
            'phone' =>  $this->faker->phoneNumber,
            'birth_place' =>   $this->faker->city,
            'birth_date' =>  $this->faker->date,
            'gender' =>  $this->faker->randomElement([0, 1]),
            'address' =>  $this->faker->address,
            'email' =>   $this->faker->email,
            'appoint_for' =>  $this->faker->randomElement(AppointmentEnum::class)->name,
            'appointment_date' =>  now()->addWeeks(1)->format('Y-m-d H:i:s'),
        ];
    }
}
