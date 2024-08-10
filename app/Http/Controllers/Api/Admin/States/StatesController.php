<?php

namespace App\Http\Controllers\Api\Admin\States;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\States\StatesCreateRequest;
use App\Models\State\State;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class StatesController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.states.index', only: ['index']),
            new Middleware('permission:admin.states.edit', only: ['edit','update']),
            new Middleware('permission:admin.states.create', only: ['create','store']),
            new Middleware('permission:admin.states.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $states = State::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de estados',
                'data' => $states,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(StatesCreateRequest $request)
    {
        try{
            $states = State::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El estado se creo correctamente',
                'data' => $states,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(State $state)
    {
        //
    }

    public function edit(State $state)
    {
        //
    }

    public function update(StatesCreateRequest $request, State $state)
    {
        try{
            $state->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El estado se edito correctamente',
                'data' => $state,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function destroy(State $state)
    {
        try{
            $state->delete();

            return response()->json([
                'status' => true,
                'message' =>'El estado se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
