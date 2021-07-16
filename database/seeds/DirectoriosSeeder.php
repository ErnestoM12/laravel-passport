<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectoriosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('directorios')->insert([
            [
                'nombre' => 'Ernesto Maya Morales',
                'direccion' => 'cedro oriente 9',
                'telefono' => '44256368238',
                'foto' => null

            ],
            [
                'nombre' => 'Juan Perez',
                'direccion' => 'cedro oriente 9',
                'telefono' => '44256368458',
                'foto' => null

            ],
            [
                'nombre' => 'laiz soto',
                'direccion' => 'cedro oriente 9',
                'telefono' => '44256368445',
                'foto' => null

            ],

        ]);
    }
}
