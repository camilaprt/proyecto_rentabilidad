<?php

namespace Database\Seeders;

use App\Models\Tipo_impuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los valores a insertar
        $tipos = [
            ['tipo_IVA' => 21.00],
            ['tipo_IVA' => 10.00],
        ];

        // Insertar los valores en la base de datos
        foreach ($tipos as $tipo) {
            Tipo_impuesto::create($tipo);
        }
    }
}
