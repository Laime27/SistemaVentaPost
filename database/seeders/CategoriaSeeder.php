<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorias;
use database\factories\CategoriaFactory;

class CategoriaSeeder extends Seeder
{
  
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Categorias::create([
                'id_usuario' => 1, // Cambia esto según necesites
                'nombre' => 'Categoria ' . $i // Cambia el nombre para que sea único
            ]);
        }
    }
}
