<?php

namespace App\Http\Controllers\Api\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\State\State;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UsersController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.logsuptproorgs.index', only: ['index']),
            new Middleware('permission:admin.logsuptproorgs.edit', only: ['edit','update']),
            new Middleware('permission:admin.logsuptproorgs.create', only: ['create','store']),
            new Middleware('permission:admin.logsuptproorgs.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $users = User::all();
            $states = State::all();
            $roles = Role::all();

            return response()->json([
                'status' => true,
                'message' =>'Listado de usuarios',
                'users' => $users,
                'states' => $states,
                'roles' => $roles,
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }

    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'loginname' => 'required|unique:users', 
                'email' => ['required', 'email', Rule::unique('users')], 
                'password' => 'required',
                'state_id' => 'required',
                'roles' => ['required', 'array', 'min:1'],
            ]);

            User::create([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'loginname' => $request->loginname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'state_id' => $request->state_id,
            ])->roles()->sync($request->roles);

            return response()->json([
                'status' => true,
                'message' =>'El Usuario se ha creado correctamente.',
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
    
    public function update(Request $request, User $user)
    {
        try{

            $request->validate([
                'name' => 'required',
                'lastname' => 'nullable',
                'loginname' => 'nullable',
                'email' => ['required', 'email'],
                'state_id' => 'required',
                'roles' => ['required', 'array', 'min:1'],
            ]);
            $data = $request->all();
            // Verificar si se proporcionó una nueva contraseña
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                // Eliminar la clave "password" del array si no se proporcionó una nueva contraseña
                unset($data['password']);
            }

            $user->update($data);
            $user->roles()->sync($request->roles);

            return response()->json([
                'status' => true,
                'message' =>'El Usuario se ha editado correctamente.',
                'data' =>$user,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function destroy(User $user)
    {
        try {

            if ($user->id === 1) {
                return response()->json([
                    'status' => false,
                    'message' =>'Este usuario no se puede eliminar ya que es uno de los principales en el sistema',
                ],401);
            }

            $user->delete();
            return response()->json([
                'status' => true,
                'message' =>'El Usuario se ha eliminado correctamente.',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
