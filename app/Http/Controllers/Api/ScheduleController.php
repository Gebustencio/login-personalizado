<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WorkDay;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ScheduleController extends Controller
{
    public function hours(Request $request)
    {
        $rules=[
            'date'=>'required|date_format:"Y-m-d"',
            'doctor_id'=>'required|exists:users,id',
        ];
        $this->validate($request,$rules);

        $date=$request->input('date');
        $dateCarbon= new Carbon($date);
        $i=$dateCarbon->dayOfWeek;
        $day=($i==0 ? 6 : $i-1);

        $doctorId=$request->input('doctor_id');

        $workDay=WorkDay::where('active',true)->where('day',$day)
                        ->where('user_id',$doctorId)
                        ->first(['mornig_start','mornig_end','afternoon_start','afternoon_end']);
        if(!$workDay)
        {
            return [];
        }
        $mornigIntervals=$this->getIntervals( $workDay->mornig_start,$workDay->mornig_end  );
        $afternoonIntervals=$this->getIntervals( $workDay->afternoon_start,$workDay->afternoon_end);
        $data=[];
        $data['morning']=$mornigIntervals;
        $data['afternoon']=$afternoonIntervals;
        return $data;
    }
    private function getIntervals($start,$end){

        $start= new Carbon($start);
        $end= new Carbon($end);

        $intervals=[];
        while($start < $end){
            $interval=[];
            $interval['start'] = $start->format('g:i A');
            $start->addMinutes(30);
            $interval['end'] = $start->format('g:i A');
            $intervals[]=$interval;

        }
        return $intervals;
    }
}
