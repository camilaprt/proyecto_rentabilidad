<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Persona;
use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'persona_id'=> Persona::factory()
        ];
    }
}
