<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo_comprobante;

class TipoComprobanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los valores a insertar
        $tipos = [
            ['tipo' => 'Ticket'],
            ['tipo' => 'Cargo'],
        ];

        // Insertar los valores en la base de datos
        foreach ($tipos as $tipo) {
            Tipo_comprobante::create($tipo);
        }
    }
}
