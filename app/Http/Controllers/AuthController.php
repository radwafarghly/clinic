<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use DB;
use Hash;
use JWTAuth;
use Auth;
use Validator;
class AuthController extends Controller
{
    //
     //signup 
     public function signup(Request $request)
     {
         //validate
         $this->validate($request, [
             "name"=>"required",
             "email"=>"required|email|unique:users",
             "password"=> array(
                 'required'   
             )
         ]);
             //insert into users table
         $user=new User([
             "name"=>$request->input('name'),
             "email"=>$request->input('email'),
             "password"=>bcrypt($request->input('password')),
             "is_doctor"=>1
            
         ]);
 
         
         $user->save();  
         return response()->json(['message'=>"Create user successfully"],201);
     }
//signin
     public function signin(Request $request)
     {
        
                 //$loggin=false;
                $credentials = $request->only('email', 'password');
                $rules = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                $validator = Validator::make($credentials, $rules);
                if($validator->fails()) {
                    return response()->json([
                        'response' => 'error', 
                        'message'=> $validator->messages(),
                        'loggin'=>false
                        ]);
                }
        
                $token = '';
        
                try {
                    if (!$token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'response' => 'error',
                            'message' => 'invalid_credentials',
                            'loggin'=>false
                        ], 401);
                    }
                } catch (JWTAuthException $e) {
                    return response()->json([
                        'response' => 'error',
                        'message' => 'failed_to_create_token',
                        'loggin'=>false
                    ], 500);
                }
                
                 //$id=JWTAuth::toUser()->id; //this gives error should be authenticated
                return response()->json([
                    'response' => 'success',
                    'token' =>  $token,
                    'loggin'=>true,
                ],200);
            }
        
            public function getAuthUser(Request $request){
                // $user = JWTAuth::toUser($request->token);
                // return response()->json(['result' => $user]);
                $userToken=JWTAuth::parseToken()->toUser();
                $id=JWTAuth::toUser()->id;
                $response=DB::table('users')->select('name', 'email','is_doctor','is_active')
                ->where('id','=',$id)
                ->get();
                return response()->json($response,200);
            }
        
}
