<?php

namespace App\Http\Controllers\Api\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function index()
    {
        try {
            if(Auth::user()->can('admin.dashboard')){
                return response()->json([
                    'status' => true,
                    'message' => 'El usuario Esta en el dashboard',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
