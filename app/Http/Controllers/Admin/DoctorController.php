<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Especialidad;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors=User::doctors()->get();

        return view('doctores.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades=Especialidad::all();
        return view('doctores.create',compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules=[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'ci' => 'nullable',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',


        ];

        $this->validate($request,$rules);

        $user=User::create(
            $request ->only('name','email','ci','address','phone')+[
                'role'=>'doctor',
                'password'=>bcrypt($request->input('password'))
            ]
          );
        $user->especialidades()->attach($request->input('especialidad'));

        $notification='El Medico se registro correctamente';
        return redirect('/doctores')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor=User::doctors()->findOrFail($id);

        $especialidades=Especialidad::all();

        $especialidad_ids = $doctor->especialidades()->pluck('especialidads.id');
        return view('doctores.edit',compact('doctor','especialidades','especialidad_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'name' => 'required|min:3',
            'email' => 'required|email',
            'ci' => 'nullable',
            'address' => 'nullable|min:5',
            'phone' => 'nullable|min:6',


        ];
        $this->validate($request,$rules);
        $user=User::doctors()->findOrFail($id);
        $data=$request ->only('name','email','ci','address','phone');
        $password = $request->input('password');
        if($password)
            $data['password']=bcrypt($password);

        $user->fill($data);
        $user->Save(); //Update

        $user->especialidades()->sync($request->input('especialidad'));

        $notification='El Medico se  Actualizo correctamente';
        return redirect('/doctores')->with(compact('notification'));
    }

    public function destroy(Request $request, $id )
    {
        $doctor=User::doctors()->findOrFail($id);
        $doctorName=$doctor->name;
        $doctor->delete();

         $notification="El Medico $doctorName se ha eliminado correctamente";
        return redirect('/doctores')->with(compact('notification'));
    }

}
