<?php

namespace App\Http\Controllers\Admin;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $especialidades=Especialidad::all();
        return view('especialidades.index',compact('especialidades'));
    }

    public function create()
    {
        return view('especialidades.create');
    }
    public function store( Request $request)
    {
       // dd($request->all());
       $rules=[
           'nombre' => 'required|min:3|string|max:100',

       ];
       $mensaje=[
        'nombre.required'=>'El nombre es requerido.',
        'nombre.min'=>'Como minimo el nombre debe tener mas de 3 caracteres',
        ];
       $this->validate($request,$rules,$mensaje);

       $Especialidad= new Especialidad();
       $Especialidad->nombre=$request->input('nombre');
       $Especialidad->descripcion=$request->input('descripcion');
       $Especialidad->save();  //insert al base de datos
       $notification='La especialidad se registro correctamente';
       return redirect('/especialidades')->with(compact('notification'));
    }
    public function edit(Especialidad $especialidad)
    {
        return view('especialidades.edit',compact('especialidad'));
    }
    public function update( Request $request, Especialidad $Especialidad)
    {
       // dd($request->all());
       $rules=[
           'nombre' => 'required|min:3|string|max:100',

       ];
       $mensaje=[
        'nombre.required'=>'El nombre es requerido.',
        'nombre.min'=>'Como minimo el nombre debe tener mas de 3 caracteres',
        ];
       $this->validate($request,$rules,$mensaje);

       $Especialidad->nombre=$request->input('nombre');
       $Especialidad->descripcion=$request->input('descripcion');
       $Especialidad->save();  //insert al base de datos
       $notification='La especialidad se Actualizo correctamente';
       return redirect('/especialidades')->with(compact('notification'));
    }

    public function destroy (Especialidad $Especialidad)
    {
        $Especialidad->delete();
        $notification='La especialidad '.$Especialidad->nombre.' se Elimino correctamente';
        return redirect('/especialidades')->with(compact('notification'));
    }
}




