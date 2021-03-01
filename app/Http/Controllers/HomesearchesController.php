<?php

namespace App\Http\Controllers;

class HomesearchesController extends Controller
{
    public function index()
    {
        return view('admin.homesearches.index');
    }
}