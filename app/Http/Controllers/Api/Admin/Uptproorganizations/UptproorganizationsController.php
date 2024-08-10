<?php

namespace App\Http\Controllers\Api\Admin\Uptproorganizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Uptproorganizations\UptproorganizationsCreateRequest;
use App\Models\Uptproorgananization\Uptproorganization;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UptproorganizationsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.uptproorganizations.index', only: ['index']),
            new Middleware('permission:admin.uptproorganizations.edit', only: ['edit','update']),
            new Middleware('permission:admin.uptproorganizations.create', only: ['create','store']),
            new Middleware('permission:admin.uptproorganizations.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $uptproorganizations = Uptproorganization::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de actualizaciones de los projectos de las organizaciones',
                'data' => $uptproorganizations,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(UptproorganizationsCreateRequest $request)
    {
        try{
            $uptproorganizations = Uptproorganization::create($request->all());

            $projects = $request->input('proyects');
            $projectData = [];

            foreach ($projects as $projectId) {
                $projectData[$projectId] = [
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            $uptproorganizations->proyects()->sync($projectData);

            return response()->json([
                'status' => true,
                'message' =>'La actualizacion del projecto de la organizacion se creo correctamente',
                'data' => $uptproorganizations,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Uptproorganization $uptproorganization)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Detalle de actualización del projecto de la organización',
                'data' => $uptproorganization,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function edit(Uptproorganization $uptproorganization)
    {
        //
    }

    public function update(UptproorganizationsCreateRequest $request, Uptproorganization $uptproorganization)
    {
        try{
            $uptproorganization->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'La actualización del projecto de la organización se edito correctamente',
                'data' => $uptproorganization,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function destroy(Uptproorganization $uptproorganization)
    {
        try{
            $uptproorganization->delete();

            return response()->json([
                'status' => true,
                'message' =>'La actualización del projecto de la organización se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
