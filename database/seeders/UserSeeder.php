<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            User::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } catch (QueryException $e) {
            // Manejar la excepción si es necesario
        }

        User::factory()->create([
            'id'    => 1062319107,
            'name' => 'OscarGalviz',
            'email' => 'croquetodg@gmail.com',
            'password' => Hash::make('password')
        ]);

        User::factory()->count(10)->create();
 
    }
}
