<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Sasha',
            'email' => 'test@example.com',
        ]);

        $service = Service::factory()->for($user)->create([
            'name' => 'Treblle API',
            'url' => 'https://api.treblle.com',
        ]);

        Check::factory()->for($service)->count(10)->create();
    }
}
