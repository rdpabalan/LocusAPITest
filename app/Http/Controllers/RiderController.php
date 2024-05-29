<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;

class RiderController extends Controller 
{
    public function store(Request $request) {
        $data = $request->validate([
            'clientId' => 'required',
            'name' => 'required',
            'code' => 'required',
            'status' => 'required',
            'phoneNumber' => 'required',
            'teamId' => 'required',
            'type' => 'required',
            'isActive' => 'required',
            'retainAuth' => 'required'
        ]);

        $rider = Rider::create($data);
        // return response()->json('message' => 'Riders Added Successfully', 201);
        return response()->json(['message' => 'Rider created successfully'], 201);
    }

    public function index() {
        return Rider::all();
    }
}
