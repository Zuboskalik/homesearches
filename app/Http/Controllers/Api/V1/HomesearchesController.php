<?php

namespace App\Http\Controllers\Api\V1;

use App\Homesearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomesearchesController extends Controller
{
    public function index()
    {
        return Homesearch::all();
    }

    public function search(Request $request)
    {
        $homes = Homesearch::where('name', 'like', '%' . $request->keywords . '%')->get();

        return response()->json($homes);
    }
}
