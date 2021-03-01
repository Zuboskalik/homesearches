<?php

namespace App\Http\Controllers\Api\V1;

use DB;
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
        $query = DB::table('homesearches');
        $searchFields = json_decode($request->searchFields);

        if ($searchFields->name) {
            $query->where('name', 'like', '%' . $searchFields->name . '%');
        }
        if ($searchFields->price) {
            if ($searchFields->price->min) {
                $query->where('price', '>=', $searchFields->price->min);
            }
            if ($searchFields->price->max) {
                $query->where('price', '<=', $searchFields->price->max);
            }
        }
        if ($searchFields->bedrooms) {
            $query->where('bedrooms', $searchFields->bedrooms);
        }
        if ($searchFields->bathrooms) {
            $query->where('bathrooms', $searchFields->bathrooms);
        }
        if ($searchFields->storeys) {
            $query->where('storeys', $searchFields->storeys);
        }
        if ($searchFields->garages) {
            $query->where('garages', $searchFields->garages);
        }

        return response()->json($query->get());
    }
}
