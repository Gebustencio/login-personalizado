<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    protected  $fillable=[
      'descripcion',
      'especialidad_id',
      'doctor_id',
      'paciente_id',
      'fecha_programacion',
      'hora_programacion',
      'tipo'
    ];
}
