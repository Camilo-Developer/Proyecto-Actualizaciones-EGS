<?php

namespace App\Http\Controllers\Api\Admin\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Products\ProductsCreateRequest;
use App\Models\Product\Product;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:admin.products.index', only: ['index']),
            new Middleware('permission:admin.products.edit', only: ['edit','update']),
            new Middleware('permission:admin.products.create', only: ['create','store']),
            new Middleware('permission:admin.products.destroy', only: ['destroy']),
        ];
    }

    public function index()
    {
        try{
            $products = Product::all();
            return response()->json([
                'status' => true,
                'message' =>'Listado de los productos',
                'data' => $products,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function store(ProductsCreateRequest $request)
    {
        try{
            $products = Product::create($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El producto se creo correctamente',
                'data' => $products,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function show(Product $product)
    {
        try{
            return response()->json([
                'status' => true,
                'message' =>'Detalle del producto',
                'data' => $product,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(ProductsCreateRequest $request, Product $product)
    {
        try{
            $product->update($request->all());

            return response()->json([
                'status' => true,
                'message' =>'El producto se edito correctamente',
                'data' => $product,
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }


    public function destroy(Product $product)
    {
        try{
            $product->delete();

            return response()->json([
                'status' => true,
                'message' =>'El producto se elimino correctamente',
            ],200);
        } catch(\Throwable $th){
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ],500);
        }
    }
}
