<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    public function doctores(Especialidad $especialidad)
    {
        return  $especialidad->users()->get(['users.id','users.name']);

    }
}
