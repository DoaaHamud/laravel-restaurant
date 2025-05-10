<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class AuthController extends Controller
{
    public function Register(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
                "email" => "required|email|unique:users,email",
                "password" => "required|min:8|confirmed",
                "phone_number" => "required|digits:10|numeric|unique:users,phone_number",
                "address" => "required",
                "role" => "in:user,admin,manager,captain"
            ]);

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "phone_number" => $request->phone_number,
                "address" => $request->address,
                "role" => $request->role ?? 'user',

            ]);
            if ($user) {
                return response()->json(['status' => 'تم', 'message' => ' successfiy insert data ', 'data' => $user], 201);
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email",
                "password" => "required|min:8"
            ]);
            if (!Auth::attempt(["email" => $request->email, "password" => $request->password])) {
                return response()->json(['status' => 'error', 'message' => 'unable login'], 400);
            }
            $user = Auth::user();
            $token = $user->createToken('api_Token')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'login success', 'role' => $user->role, 'token' => $token], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    public function profile(){
        $user=Auth::user();
        return response()->json(['status'=>'success','message'=>'successfly get data','data'=>$user],200);
    }

   


}
