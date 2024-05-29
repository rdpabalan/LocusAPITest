<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Handle POST requests.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function post(Request $request)
    {
        // Check basic authentication
        $username = $request->header('PHP_AUTH_USER');
        $password = $request->header('PHP_AUTH_PW');

        if ($username !== 'gsdc-devo' || $password !== '43b1a084-3f4e-4207-9d7c-f0e2486b23ad') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Extract JSON data from the request
        $jsonData = $request->json()->all();

        // Process the JSON data (e.g., store it in the database)

        // Respond with a success message or appropriate response
        return response()->json(['message' => 'Data dumped successfully'], 200);
    }
    
    /**
     * Handle GET requests.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        // Check basic authentication
        $username = $request->header('PHP_AUTH_USER');
        $password = $request->header('PHP_AUTH_PW');

        if ($username !== 'gsdc-devo' || $password !== '43b1a084-3f4e-4207-9d7c-f0e2486b23ad') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Your logic for handling GET requests goes here

        // Respond with a success message or appropriate response
        return response()->json(['message' => 'GET request processed successfully'], 200);
    }
}
