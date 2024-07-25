<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            "name"=>"required|string|max:255",
            "email"=>"required|email|max:255",
            "password"=>"required|string|min:8|confirmed"
        ]);

        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()],301);
        }
        // return response()->json(["request"=>$request->all()],201);
        $password = bcrypt($request->password);
        $access_token = Str::random(64);
        //return response()->json(["pass"=>$password,"access"=>$access_token],201);
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>$password,
            "access_token"=>$access_token
        ]);
        return response()->json([
            "msg"=>"registered successfully",
            "access+token"=>$access_token
        ],201);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            "email"=>"required",
            "password"=>"required"
        ]);

        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()],301);
        }
        $user = User::where("email","=",$request->email)->first();
        if(! $user){
            return response()->json(["msg"=>"email not found"],301);
        }

        $truepass = $user->password;
        $pass_check = Hash::check($request->password,$truepass);

        if(! $pass_check){
            return response()->json(["msg"=>"email or password not correct"],301);
        }

        $access_token = Str::random(64);
        $user->update([
            "access_token"=>$access_token
        ]);
        return response()->json([
            "msg"=>"login success",
            "access_token"=>$access_token
        ],201);
    }

    public function logout(Request $request){
        $access_token = $request->header("access_token");
        if($access_token !== null){
            $user = User::where("access_token","=",$access_token)->first();
            //return response()->json(["user"=>$user,"flag"=>($user !==null)]);
            if($user !== null){
                $user->update([
                    "access_token"=>null
                ]);
                return response()->json([
                    "msg"=>"loged out successfully"
                ],201);
            }else{
                return response()->json(["msg","user not found"],404);
            }
        }else{
            return response()->json(["msg"=>"access token not found"],404);
        }
    }
}
