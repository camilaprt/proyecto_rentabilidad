<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tipo_factura;

class TipoFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los valores a insertar
        $tipos = [
            ['tipo' => 'Venta'],
            ['tipo' => 'Compra'],
        ];

        // Insertar los valores en la base de datos
        foreach ($tipos as $tipo) {
            Tipo_factura::create($tipo);
        }
    }
}
