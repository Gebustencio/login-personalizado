<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{   private $days=[
                'Lunes','Martes',
                'Miercoles','Jueves',
                'Viernes','Sabado',
                'Domingo'];

    public function edit()
    {
        $workDays=WorkDay::where('user_id',auth()->id())->get();
        if(count($workDays)> 0 ){
            $workDays->map(function($workDay){
                $workDay->mornig_start=(new Carbon($workDay->mornig_start))->format('g:i A');
                $workDay->mornig_end=(new Carbon($workDay->mornig_end))->format('g:i A');
                $workDay->afternoon_start=(new Carbon($workDay->afternoon_start))->format('g:i A');
                $workDay->afternoon_end=(new Carbon($workDay->afternoon_end))->format('g:i A');
                return $workDay;
            } );
        }else{
            $workDays->collect();
            for($i=0;$i<7;$i++)
                $workDays->push(new WorkDay());

        }

      // dd($workDays->toArray());
        $days=$this->days;
        return view('calendario',compact('workDays','days'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $active=$request->input('active') ?: [];

        $mornig_start=$request->input('mornig_start');
        $mornig_end=$request->input('mornig_end');
        $afternoon_start=$request->input('afternoon_start');
        $afternoon_end=$request->input('afternoon_end');

        $errors=[];
        for($i=0;$i<7;$i++){
            if($mornig_start[$i]> $mornig_end[$i]){
                $errors[]='Las horas de la mañana son inconsistentes para el dia '. $this->days[$i] .'.';
            }
            if($afternoon_start[$i] > $afternoon_end[$i]){
                $errors[]='Las horas de la tarde son inconsistentes para el dia '.$this->days[$i].'.';
            }

            WorkDay::updateOrCreate(
                [
                'day' =>$i,
                 'user_id' =>auth()->id()
                ],
               [
                'active' => in_array($i,$active),
                'mornig_start' =>$mornig_start[$i],
                'mornig_end' =>$mornig_end[$i],
                'afternoon_start' =>$afternoon_start[$i],
                'afternoon_end' => $afternoon_end[$i]
                ]
            );
        }
            if(count($errors) >0 )
            {return back()->with(compact('errors'));}
        $notification="Los cambios se guardaron correctamente.";
        return back()->with(compact('notification'));
    }
}
