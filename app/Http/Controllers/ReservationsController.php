<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Reservation;
use DB;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function destroy($id,Reservation $reserve)
    {
       $reserve->find($id)->delete();
      
    }
    public function update($id,Request $request)
    {  
        $reserve=Reservation::find($id);
         
        $reserve->fill($request->all())->save();
       
        
    }
}
