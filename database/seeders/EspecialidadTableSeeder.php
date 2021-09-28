<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especialidad;
class EspecialidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $esp= new Especialidad();
        $esp->nombre="Ondodoncia";
        $esp->descripcion ="medico especialista en ";
        $esp->save();
    }
}
