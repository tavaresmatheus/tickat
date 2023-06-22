<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventName = fake()->sentence();
        $location = fake()->city() . ' - ' . fake()->state() . ' - ' . fake()->streetAddress();
        $opening = fake()->date() . ' ' . fake()->time();
        $closing = now();
        $organizer = User::factory();
        $status = fake()->randomElement(
            [
                'Active',
                'Canceled',
                'Done',
            ]
        );
        $category = fake()->randomElement(
            [
                'Music',
                'Gospel',
                'Vacation',
                'Other',
            ]
        );
        $capacity = fake()->randomNumber(
            5,
            false
        );

        return [
            'event_name' => $eventName,
            'location' => $location,
            'opening' => $opening,
            'closing' => $closing,
            'organizer' => $organizer,
            'status' => $status,
            'category' => $category,
            'capacity' => $capacity,
        ];
    }
}
