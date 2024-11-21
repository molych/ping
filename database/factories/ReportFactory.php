<?php

namespace Database\Factories;

use App\Models\Check;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'content_type' => $this->faker->mimeType(),
            'status' => Response:: HTTP_OK,
            'header_size' => 0,
            'request_size' => 0,
            'redirect_count' => 0,
            'http_version' => 2,
            'areconnect time' => 0,
            'connect_time' => 0,
            'nameleakup_time' => 0,
            'pretransfer-time' => 0,
            'redirect_time' => 0,
            'Stanttransfer-time' => 0,
            'total_time' => 0,
            'check_id' => Check::factory(),
            'started_at' => $start = Carbon:: parse (
                time: $this->faker->dateTimeThisMonth ()
            ),
            'finished_at' => $start->addSeconds($this->faker->randomDigit())
        ];
    }
}
