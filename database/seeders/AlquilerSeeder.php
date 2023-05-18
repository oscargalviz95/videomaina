<?php

namespace Database\Seeders;

use App\Models\Alquiler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlquilerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Alquiler::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (QueryException $e) {
            // Manejar la excepción si es necesario
        }
        

        Alquiler::factory()->count(10)->create();

    }
}
