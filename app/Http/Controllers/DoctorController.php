<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;

class DoctorController extends Controller
{
    //allow doctor to add secretary
    public function addSecretary(Request $request)
    {
       $credentials = $request->only('email', 'password','name');
       $rules = [
           'name'=>'required',
           'email' => 'required|email',
           'password' => 'required',
       ];
        //validate
        $this->validate($request, [
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=> array(
                'required'   
            )
        ]);

        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return response()->json([ 
                'message'=> $validator->messages(),
                ]);
        }

            //insert into users table
        $user=new User([
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "password"=>bcrypt($request->input('password')),
            "is_doctor"=>0
           
        ]);

        
        $user->save();  
        return response()->json(['message'=>"Create secretary successfully"],201);
    }
}
