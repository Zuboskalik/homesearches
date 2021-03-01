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
        $searchFields = json_decode($request->searchFields);
        $query = Homesearch::query();

        if ($searchFields->name) {
            $query->name($searchFields->name);
        }
        if ($searchFields->price) {
            if ($searchFields->price->min !== "") {
                $query->priceMin($searchFields->price->min);
            }
            if ($searchFields->price->max !== "") {
                $query->priceMax($searchFields->price->max);
            }
        }
        if ($searchFields->bedrooms !== "") {
            $query->bedrooms($searchFields->bedrooms);
        }
        if ($searchFields->bathrooms !== "") {
            $query->bathrooms($searchFields->bathrooms);
        }
        if ($searchFields->storeys !== "") {
            $query->storeys($searchFields->storeys);
        }
        if ($searchFields->garages !== "") {
            $query->garages($searchFields->garages);
        }

        return response()->json($query->get());
    }
}
