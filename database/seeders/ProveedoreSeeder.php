<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\Proveedore;

class ProveedoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Obtener 5 personas
        $personas = Persona::take(5)->get();

        // Crear un proveedor para cada persona      
        foreach ($personas as $persona) {
            Proveedore::create([
                'persona_id' =>$persona->id,
            ]);             
        }
        

    }
}
