<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $patients=User::patients()->paginate(2);
      //  $patients['patients']=User::paginate(1);
      $patients=User::patients()->get();
        return view('pacientes.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
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

        User::create(
            $request ->only('name','email','ci','address','phone')+[
                'role'=>'patient',
                'password'=>bcrypt($request->input('password'))
            ]
        );

        $notification='El Paciente se ha registrado correctamente';
        return redirect('/pacientes')->with(compact('notification'));
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


    public function edit( $id)
    {
        $patient=User::patients()->findOrFail($id);
        return view('pacientes.edit',compact('patient'));
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
        $user=User::patients()->findOrFail($id);
        $data=$request ->only('name','email','ci','address','phone');
        $password = $request->input('password');
        if($password)
            $data['password']=bcrypt($password);

        $user->fill($data);
        $user->Save(); //Update


        $notification='El Paciente se ha  Actualizado correctamente';
        return redirect('/pacientes')->with(compact('notification'));
    }


    public function destroy(Request $request, $id)
    {
        $patient=User::patients()->findOrFail($id);
        $patientName=$patient->name;
        $patient->delete();

         $notification="El Paciente $patientName  ha eliminado correctamente";
        return redirect('/pacientes')->with(compact('notification'));

    }
}
