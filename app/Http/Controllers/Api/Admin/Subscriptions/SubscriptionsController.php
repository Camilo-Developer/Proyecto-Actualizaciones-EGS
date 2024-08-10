<?php

namespace App\Http\Controllers\Api\Admin\Subscriptions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Subscriptions\SubscriptionsCreateRequest;
use App\Models\Subscription\Subscription;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SubscriptionsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.subscriptions.index', only: ['index']),
            new Middleware('permission:admin.subscriptions.edit', only: ['edit','update']),
            new Middleware('permission:admin.subscriptions.create', only: ['create','store']),
            new Middleware('permission:admin.subscriptions.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $subscriptions = Subscription::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de suscripciones',
                'data' => $subscriptions,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(SubscriptionsCreateRequest $request)
    {
        try{
            $subscriptions = Subscription::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'La suscripción se creo correctamente',
                'data' => $subscriptions,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Subscription $subscription)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Detalle de la suscripción',
                'data' => $subscription,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function edit(Subscription $subscription)
    {
        //
    }

    public function update(SubscriptionsCreateRequest $request, Subscription $subscription)
    {
        try{
            $subscription->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'La suscripción se edito correctamente',
                'data' => $subscription,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function destroy(Subscription $subscription)
    {
        try{
            $subscription->delete();

            return response()->json([
                'status' => true,
                'message' =>'La suscripción se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
