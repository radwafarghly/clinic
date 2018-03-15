<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Reservation;
use DB;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //retrieve patients who reserve in this day
    public function getPatients($date)
    {
        //$date = \Carbon\Carbon::now();
        $patients=DB::table('patients')
        ->join('reservations','patients.id','=','reservations.patient_id')
        ->select('patients.name','patients.card_number')
        ->where('reservations.date_reservation',$date)
        ->get();
       
        return response()->json(['patients'=>$patients],201);
    }
}
