<?php

namespace App\Http\Controllers\Api\Admin\Proyects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Proyects\ProyectsCreateRequest;
use App\Models\Proyect\Proyect;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class ProyectsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.proyects.index', only: ['index']),
            new Middleware('permission:admin.proyects.edit', only: ['edit','update']),
            new Middleware('permission:admin.proyects.create', only: ['create','store']),
            new Middleware('permission:admin.proyects.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $proyects = Proyect::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de los proyectos',
                'data' => $proyects,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(ProyectsCreateRequest $request)
    {
        try{
            $proyects = Proyect::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El proyecto se creo correctamente',
                'data' => $proyects,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Proyect $proyect)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Detalle del proyecto',
                'data' => $proyect,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function edit(Proyect $proyect)
    {
        //
    }

    public function update(ProyectsCreateRequest $request, Proyect $proyect)
    {
        try{
            $proyect->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El proyecto se edito correctamente',
                'data' => $proyect,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function destroy(Proyect $proyect)
    {
        try{
            $proyect->delete();

            return response()->json([
                'status' => true,
                'message' =>'El proyecto se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
