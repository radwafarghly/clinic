<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Reservation;

use App\Patient;
use Validator;

class PatientController extends Controller
{
    //get patient details
    public function getPatient($id)
    {
        $patient=Patient::find($id);
        return response()->json(['patient'=>$patient],201);

    }
     //retrieve patients who reserved on this day
     public function getPatients($date)
     {
        
         $patients=DB::table('patients')
         ->join('reservations','patients.id','=','reservations.patient_id')
         ->select('patients.name','patients.card_number',
         'patients.id AS patient_id','reservations.id AS reservation_id')
         ->where('reservations.date_reservation',$date)
         ->get();
         if(empty($patients[0]))
         {
            return response()->json(['message'=>"no patients"],404);
         }
         else{
            return response()->json(['patients'=>$patients],201);
         }
        
        
     }
     //retrieve patients who reserved today
     public function getPatientsToday()
     {
        $date= Carbon::today()->toDateString();
        $patients=DB::table('patients')
        ->join('reservations','patients.id','=','reservations.patient_id')
        ->select('patients.name','patients.card_number','patients.id AS patient_id','reservations.id AS reservation_id')
        ->where('reservations.date_reservation',$date)
        ->get();
       
        return response()->json(['patients'=>$patients],201);
     }
     public function update(Request $request)
     {   
        $credentials = $request->all();
        $rules = [
            "name"=>"required",
            "age"=>"required",
            "gender"=>"required",
            "phone"=>"required",
            "card_number"=>"required", 
            
        ];
       //validate 
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json([ 
                'response' => 'error',
                'message'=> $validator->messages(),
            ],400);
        }
 
        
         
         $patient = Patient::find($request->input('id'));
         $patient->name=$request->input('name');
         $patient->age=$request->input('age');         
         $patient->gender=$request->input('gender');
         $patient->phone=$request->input('phone');
         $patient->card_number=$request->input('card_number');
         $patient->save(); 

   
         
         return response()->json([
                'response'=>'success',
                 'message' => 'Patient Updated Succesfully',
                 
         ],200);
     }
}
