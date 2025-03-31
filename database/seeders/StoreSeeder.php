<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'id'    => 1,
            'nombre'    => "Copilco",
            'alias'     => "Matriz",
            'correo_principal' => 'pasteleriacopilco@gmail.com',
            'correo_secundario' => "pasteleriacopilco@hotmail.com",
            'telefono_principal' => "5556586728",
            'telefono_secundario' => "",
            'calle' => "Av Copilco",
            'numero_externo' => "269",
            'numero_interno' => "",
            'colonia' => "Copilco Universidad",
            'entidad' => "Coyacán",
            'estado' => "Ciudad de México",
            'cp' => "04360",
            'nota_direccion' => "Pastelería y cafetería"
        ]);
    }
}
