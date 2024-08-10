<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function profile(){
        try{
            $userData = Auth::user();
            $rol = Auth::user()->getRoleNames()->first();
            return response()->json([
                'message' =>'Profile Informacion',
                'data' => $userData,
                'rol' => $rol,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function profileUpdate(Request $request){
        try{
            $validateUser = Validator::make($request->all(),[
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'loginname' => 'required',
            ]);
    
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validateUser->errors()
                ],401);
            }
    
            $user = auth()->user();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->loginname = $request->loginname;
            $user->state_id = 1;
            $user->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Perfil actualizado correctamente',
                'user' => $user
            ],200);
    
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
    

    public function passwordUpdate(Request $request){
        try{
            $validateUser = Validator::make($request->all(),[
                'current_password' => 'required',
                'new_password' => 'required|min:3|different:current_password',
                'confirm_password' => 'required|same:new_password',
            ]);
    
            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validateUser->errors()
                ],401);
            }
    
            $user = auth()->user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'message' => 'La contraseña actual no es correcta',
                ], 401);
            }
    
            $user->password = Hash::make($request->new_password);
            $user->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Contraseña actualizada correctamente',
            ],200);
    
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
