<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Models\cita;
use App\Models\User;
use Carbon\Carbon;
class CitaController extends Controller
{
    public function create()
    {
        $especialidades=Especialidad::all();

        $especialidadId=old('especialidad_id');
        if($especialidadId)
        {
            $especialidad=Especialidad::find($especialidadId);
            $doctors=$especialidad->users;
        }else{
            $doctors=collect(); //coleccion vacio o se puede enviar matriz vacio
        }

        return view('citas.create',compact('especialidades','doctors'));

    }
    public function store(Request $request)
    {   $rules=[
        'descripcion' => 'required',
        'especialidad_id' => 'exists:especialidads,id',
        'doctor_id' => 'exists:users,id',
        'hora_programacion' => 'required',
       ];
        $messages=[
            'hora_programacion.required' => 'Por favor seleccione una hora valida para la cita'
             ];
        $this->validate($request,$rules,$messages);
        $data=$request->only([
            'descripcion',
            'especialidad_id',
            'doctor_id',
            'fecha_programacion',
            'hora_programacion',
            'tipo'
        ]);
        $data['paciente_id']=auth()->id();
        //dar formato  la hora
        $carbonTime= Carbon::createFromFormat('g:i A',$data['hora_programacion']);
        $data['hora_programacion']=$carbonTime->format('H:i:s');

         cita::create($data);
         $notification="La cita se ha registrado correctamente";
         return back()->with(compact('notification'));

    }
}
