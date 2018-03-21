<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Reservation;
use DB;

use Illuminate\Http\Request;
use App\Patient;
use Validator;

class ReservationController extends Controller
{

   //add a reservation
   public function addReservation(Request $request)
   {
        //check that the number of patients on a day is less than 30
        //$date =$request->input('date_reservation');
        $date= Carbon::today()->toDateString();
        $num_patients=DB::table('reservations')
        ->where('date_reservation','=',$date)
        ->count();
        if($num_patients>30)
        {
            return response()->json([ 
            'response' => 'error',
            'message'=>'Number of patients is larger than 4'],
            400);
        }

        $credentials = $request->all();
        $rules = [
            "name"=>"required",
            "gender"=>"required",
            "age"=>"required",
            "phone"=>"required",
            "type"=>"required",
            "paid"=>"required", 
            "change"=>"required",
            "card_number"=>"required", 
            "date_reservation"=>"required",
        ];
       //validate 
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json([ 
                'response' => 'error',
                'message'=> $validator->messages(),
            ],400);
        }

        //check that this patient doesnot douplicate in patients table
        $patient_check=Patient::select('id')
        ->where('card_number',$request->input('card_number'))
        ->get();
        //return response()->json(['patient_check'=>$patient_check[0]]); 
        if($patient_check)
        {
            //check that this patient doesnot exist in this date_reservation
            $patient_reservation=Reservation::select('id')
            ->where('date_reservation',$date)
            ->where('patient_id',$patient_check[0]->id)
            ->get();
            
            if($patient_reservation)
            {
                return response()->json([
                    'response' => 'error',
                    'message'=>'This patient already has reserved in this day'],
                    400);
            }
            
            //create reservation record
            $reservation=new Reservation([
                //"date_reservation"=>$request->input('date_reservation'),
                "paid"=>$request->input('paid'),
                "change"=>$request->input('change'),
                "type"=>$request->input('type'),
                "patient_id"=>($patient_check[0]->id),
            ]);

            //save reservation in DB  patient_id
            $reservation->save();

            return response()->json([ 
                'response' => 'success',
                'message'=>'Create new reservation successfully',
                200]);
        }

        



       //create patient record
    $patient=new Patient([
        "name"=>$request->input('name'),
        "gender" => $request->input('gender'),
        "age"=>$request->input('age'),
        "phone"=>$request->input('phone'),
        "card_number"=>$request->input('card_number'),
    ]);

    //save patient record in DB
   $patient->save();

    //create reservation record
    $reservation=new Reservation([
        // "date_reservation"=>$request->input('date_reservation'),
        "paid"=>$request->input('paid'),
        "change"=>$request->input('change'),
        "type"=>$type,
        "patient_id"=>$patient->id,
    ]);

    //save reservation in DB  patient_id
     $reservation->save();

    return response()->json([
        'response' => 'success',
        'message'=>'Create new reservation successfully'],
        200);
   }
   public function update(Request $request )
   {
    $credentials = $request->all();
    $rules = [
        "type"=>"required",
        "paid"=>"required",
        "change"=>"required",
        "date_reservation"=>"required", 
        
    ];
   //validate 
    $validator = Validator::make($credentials, $rules);
    if($validator->fails()) {
        return response()->json([ 
            'response' => 'error',
            'message'=> $validator->messages(),
        ],400);
    } 
    $reservation= DB::table('reservations')
    ->where('id',$request->input('id'))
    ->get();
    $reservation->type=$request->input('type');
    $reservation->paid=$request->input('paid');
    $reservation->change=$request->input('change');
    $reservation->date_reservation=$request->input('date_reservation');
    $reservation->save();

    return response()->json([
        'response'=>'success',
         'message' => 'Reservation Updated Succesfully',
         
 ],200);

   }

   public function destroy($reservation_id,$patient_id)
   {
       Reservation::destroy($reservation_id);
       $patientId=Reservation::select('patient_id')
       ->where('patient_id',$patient_id)
       ->limit(1)
       ->get();
       //check if patient of this reservation has other reservations , not delete  ,else delete his info
       if(empty($patientId[0]))
       {
            Patient::destroy($patient_id);
            return response()->json([
                'response'=>'success',
                'message' => 'Reservation and patient deleted succesfully',
                'id'=>$patientId
                
                ],200);
       }
       else{
           
           return response()->json([
            'response'=>'success',
            'message' => 'Reservation deleted succesfully',
            'id'=>$patientId
            
            ],200);
       }
       

   }
   //return the details of reservation
   public function reservationDetails($id)
   {
        $reservation=Reservation::find($id);
        return response()->json(['reservation'=>$reservation],201);
   }
}
