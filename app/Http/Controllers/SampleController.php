<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sample;

class SampleController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'myAge' => 'required',

        ]);

        $sample = Sample::create($data); //use model name in the 1st code
        
        return response()->json(['message' => 'Sample created successfully'], 201);
    }

    public function index() {
        return Sample::all();
    }   
}
