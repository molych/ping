<?php

namespace Database\Factories;

use App\Models\Check;
use App\Models\Credential;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class CheckFactory extends Factory
{
    /** @var class-string<Model> */
    public $model = Check::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'path' => $this->faker->filePath(),
            'method' => 'GET',
            'body' => null,
            'headers' => null,
            'parameters' => null,
            'credential_id' => $this->faker->boolean()
                ? Credential::factory() : null,
            'service_id' => Service::factory(),
        ];
    }
}
