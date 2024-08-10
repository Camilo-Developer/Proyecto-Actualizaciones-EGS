<?php

namespace App\Http\Controllers\Api\Admin\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Organizations\OrganizationsCreateRequest;
use App\Models\Organization\Organization;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OrganizationsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.organizations.index', only: ['index']),
            new Middleware('permission:admin.organizations.edit', only: ['edit','update']),
            new Middleware('permission:admin.organizations.create', only: ['create','store']),
            new Middleware('permission:admin.organizations.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $organizations = Organization::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de organizaciones',
                'data' => $organizations,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(OrganizationsCreateRequest $request)
    {
        try{
            $organizations = Organization::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'La organización se creo correctamente',
                'data' => $organizations,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Organization $organization)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Detalle de la organización',
                'role' => $organization,
            ],200);

        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function update(OrganizationsCreateRequest $request, Organization $organization)
    {
        try{
            $organization->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'La organización se edito correctamente',
                'data' => $organization,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function destroy(Organization $organization)
    {
        try{
            $organization->delete();

            return response()->json([
                'status' => true,
                'message' =>'La organización se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
