<?php

namespace Database\Seeders;

use App\Models\Tipo_factura;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('demo1234'),
            'email_verified_at' => now(),
        ]);

        $this->call([
            TipoComprobanteSeeder::class,
            TipoFacturaSeeder::class,
            TipoImpuestoSeeder::class,
            CategoriaSeeder::class,

        ]);
    }
}
