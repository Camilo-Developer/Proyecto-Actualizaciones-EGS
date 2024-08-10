<?php

namespace App\Http\Controllers\Api\Admin\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.roles.index', only: ['index']),
            new Middleware('permission:admin.roles.edit', only: ['edit','update']),
            new Middleware('permission:admin.roles.create', only: ['create','store']),
            new Middleware('permission:admin.roles.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $roles = Role::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de roles',
                'data' => $roles,
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
                'permissions' => 'required'
            ]);
            $role = Role::create($request->all());

            $role->permissions()->sync($request->permissions);

            return response()->json([
                'status' => true,
                'message' =>'El rol se creo correctamente',
                'data' => $role,
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function show(Role $role)
    {
        try{
            $permissions = Permission::all();
            return response()->json([
                'status' => true,
                'message' =>'Detalle del rol',
                'role' => $role,
                'permissions' => $permissions,
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function update(Request $request, Role $role)
    {
        try{
            $request->validate([
                'name' => 'required',
            ]);
            $role->update($request->all());
            $role->permissions()->sync($request->permissions);
            return response()->json([
                'status' => true,
                'message' =>'El rol se edito correctamente',
                'role' => $role,
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function destroy(Role $role)
    {
        try {
            if ($role->id <= 2) {
                return response()->json([
                    'status' => false,
                    'message' => 'Este rol no se puede eliminar ya que es uno de los principales en el sistema',
                ], 401);
            }
    
            Role::where('id',$role->id)->delete();
            return response()->json([
                'status' => true,
                'message' => 'El rol se eliminó correctamente.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Error al eliminar el rol. Consulte los registros para más detalles.',
            ], 500);
        }
    }
}
