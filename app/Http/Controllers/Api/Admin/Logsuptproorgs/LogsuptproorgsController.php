<?php

namespace App\Http\Controllers\Api\Admin\Logsuptproorgs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Logsuptproorgs\LogsuptproorgsCreateRequest;
use App\Models\LogsUptProOrg\Logsuptproorg;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LogsuptproorgsController extends Controller implements HasMiddleware
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
            $logsuptproorgs = Logsuptproorg::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de logs de actualizaciones de los proyectos de las organizaciones',
                'data' => $logsuptproorgs,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(LogsuptproorgsCreateRequest $request)
    {
        try{
            $logsuptproorgs = Logsuptproorg::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El log se creo correctamente',
                'data' => $logsuptproorgs,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Logsuptproorg $logsuptproorg)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Listado de logs de actualizaciones de los proyectos de las organizaciones',
                'data' => $logsuptproorg,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function edit(Logsuptproorg $logsuptproorg)
    {
        //
    }

    public function update(LogsuptproorgsCreateRequest $request, Logsuptproorg $logsuptproorg)
    {
        try{
            $logsuptproorg->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El log de la actualización se edito correctamente',
                'data' => $logsuptproorg,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function destroy(Logsuptproorg $logsuptproorg)
    {
        try{
            $logsuptproorg->delete();

            return response()->json([
                'status' => true,
                'message' =>'El log de la actualización se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
