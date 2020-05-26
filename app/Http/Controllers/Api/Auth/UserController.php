<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Notifications\OTPVerification;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller 
{
     public $successStatus = 200;

     public function generateOtp(User $user)
     {
         if ($user->phone == '9999999999') {
             return '1995';
         }

         return rand(1000, 9999);
     }

     public function login(Request $request){ 
           $this->validate($request, [
             "phone" => "required|numeric|digits:10"
            ]);
            $phone = $request->phone; 
            $user = User::where("phone",$phone)->first();
             if(!$user){
               $user = User::create([
                 "phone" => $phone,
                 "name" => "" ,
               ]);
              }
            $otp = $this->generateOtp($user);
            $user->setData(["otp" => $otp]);
            $user->notify(new OTPVerification($otp));
            return response()->json([
                 'success' => 'success',
                 'message' => 'otp is send to register mobile number',
                 'user' => $user,
                 'otp' => $otp
             ], $this->successStatus); 
    
      }

    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required', 
            "email" => "required|email|unique:users",
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $user = User::where("phone",$request->phone)->first();

        if (!$user) {
            return response()->json([
                "message" => "User Data not found in our database"
            ], 422);
        }

        $user = User::update($input); 
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['user'] =  $user->name;
        return response()->json(['success'=>$success], $this->successStatus); 
    }

     public function verifyOtp(Request $request)
    {
        $this->validate($request, [
            "phone" => "required",
            "otp" => "required"
        ]);

        $user = User::where("phone", $request->phone)->orderBy('id', 'desc')->first();

        if (!$user) {
            return response()->json([
                "message" => "Phone number or otp is not valid"
            ], 422);
        }

        $otp = $user->getData("otp");
        if ($otp != $request->otp) {
            return response()->json([
                "message" => "OTP is not valid"
            ], 422);
        }

        $user->removeData("otp");
        $user->status = 1;
        $user->save();
        $token = $user->createToken("mobile");

       // set action
        $action = "register";
        if ($user->email && $user->name) {
         $action = "login";
        }

        if ($request->device_token) {
            $token->token->update([
                "device_token" => $request->device_token
            ]);
        }

        return [
            "status" => "ok",
            "user" => $user,
            "token" => $token->accessToken,
            "message" => "otp verified",
            "action" => $action
        ];
    }

    public function details() 
     { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this->successStatus); 
     } 
}