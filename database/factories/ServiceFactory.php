<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class ServiceFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'url' => $this->faker->url(),
            'user_id' => User::factory()->create(),
        ];
    }
}
