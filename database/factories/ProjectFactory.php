<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Scopes\ActiveClientsScope;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $clients = Client::withoutGlobalScope(ActiveClientsScope::class)->get();
        
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'deadline' => $this->faker->date(),
            'user_id' => $users->random(),
            'client_id' => $clients->random(),
            'status' => $this->faker->randomElement(['open', 'closed']),
        ];
    }
}
