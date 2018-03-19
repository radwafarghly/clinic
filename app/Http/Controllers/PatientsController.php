<?php

namespace App\Http\Controllers;
use App\Patient;
use Illuminate\Http\Request;
use DB;

class PatientController extends Controller
{


    
    //
    public function getPatient($id)
    {
        $patient=Patient::find($id);
        return response()->json(['patient'=>$patient],201);

    }
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
     public function destroy($id,Patient $item)
     {
        $item->find($id)->delete();
       
     }

     public function update($id,Request $request)
     {  
         $updatePatient=Patient::find($id);
          
         $updatePatient->fill($request->all())->save();
        
         
     }
}
