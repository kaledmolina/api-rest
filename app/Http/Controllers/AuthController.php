<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Doctrine\Common\Lexer\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register ( Request $request ) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data'=>$user, 'access_token'=>$token, 'Token_type'=>'Bearer' ]);
        }

        public function login ( Request $request  ){
            $validator = Validator::make($request->all(), [
                'email'=> 'required|string|email|max:255',
                'password'=> 'required|string|min:8',
            ]);
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $user = User::where('email', $request->email)->first();
            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json(['error'=>'The provided credentials are incorrect.'], 401);
            }
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['data'=>$user, 'access_token'=>$token, 'Token_type'=>'Bearer' ]);
        }
    public function logout ( Request $request ){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Token deleted successfully'], 200);
    }

}
