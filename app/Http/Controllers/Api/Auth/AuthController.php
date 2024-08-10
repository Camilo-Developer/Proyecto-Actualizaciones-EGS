<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            // Validamos los inputs
            $validateUser = Validator::make($request->all(), [
                'loginname' => 'required',
                'password' => 'required',
            ]);
    
            // Miramos si no hay un error general
            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validateUser->errors()
                ], 401);
            }
    
            // Nos ayuda a identificar el Email y el loginname
            $loginField = filter_var($request->loginname, FILTER_VALIDATE_EMAIL) ? 'email' : 'loginname';
    
            if (!Auth::attempt([$loginField => $request->loginname, 'password' => $request->password])) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email/Usuario y contraseña no coinciden con nuestros registros',
                ], 401);
            }
    
            $user = Auth::user();
            $UserData = [
                'id' => $user->id,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'loginname' => $user->loginname,
                'email' => $user->email,
                'state_id' => $user->state_id,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'profile_photo_url' => $user->profile_photo_url,
            ];
            $rol = $user->getRoleNames()->first();
            $permissions =  Auth::user()->getAllPermissions()->pluck('name');
    
            return response()->json([
                'status' => true,
                'message' => 'El usuario inició sesión',
                'access_token' => $user->createToken('authToken')->plainTextToken,
                'user' => $UserData,
                'rol' => $rol,
                'permissions' => $permissions,
            ], 200);
    
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    

    public function register(Request $request)
    {
        try{
            $validateUser = Validator::make($request->all(),[
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required|unique:users',
                'loginname' => 'required|unique:users',
                'password' => 'required',
                //'state_id' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validateUser->errors()
                ],401);
            }

            $user = User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'loginname' => $request->loginname,
                'password' => Hash::make($request->password),
                'state_id' => 1,
            ])->assignRole('Admin');

            return response()->json([
                'status' => true,
                'message' => 'Usuario creado correctamente',
                'acces_token' => $user->createToken('authToken')->plainTextToken,
                'user' => $user,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    
    }

    public function logout(Request $request)
    {
        try{
            $validateUser = Validator::make($request->all(),[
                'token' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validateUser->errors()
                ],401);
            }

            $user = Auth::user()->id;

            $idToken = explode('|', $request->token)[0];

            DB::table('personal_access_tokens')->where('id',$idToken)->update([
                'last_used_at' => Carbon::now(),
                'expires_at' => Carbon::now(),
            ]);

            return response()->json([
                'message' =>'Se ha cerrado la sesión correctamente',
                'data' => [],
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }

    }
}
