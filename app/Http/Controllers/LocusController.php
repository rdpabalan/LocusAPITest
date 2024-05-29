<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Models\OrderCallback;

class LocusController extends Controller 
{
    public function store(Request $request) {
        \Log::info('Received POST request to /order_callbacks');

        // Ensure the request includes the required authentication parameters
        $id = $request->query('id');
        $token = $request->query('token');


        \Log::info('Received id: ' . $id);
        \Log::info('Received token: ' . $token);

        // Validate the ID and token against the values provided by the third-party system
        if ($id !== 'gsdc-devo' || $token !== '43b1a084-3f4e-4207-9d7c-f0e2486b23ad') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $data = $request->validate([
            'order.id' => 'required',
            'order.date' => 'required',
            'order.orderStatus' => 'required',
            'order.orderSubStatus' => 'nullable',
            'order.triggerTime' => 'required',
            'order.latLng.lat' => 'required',
            'order.latLng.lng' => 'required',
            'order.teamId' => 'required',
            'order.homebaseId' => 'required',
            'order.locationId' => 'required',
            'order.tourDetail.riderId' => 'required',
            'order.tourDetail.riderName' => 'required',
            'order.tourDetail.vehicleId' => 'required',
            'order.currentEta' => 'required',
            'timestamp' => 'required',
        ]);

        // Extract 'order.id' from the validated data
        $data['id'] = $data['order']['id'];
        $data['date'] = $data['order']['date'];
        $data['order_status'] = $data['order']['orderStatus'];
        $data['order_sub_status'] = $data['order']['orderSubStatus'];
        $data['trigger_time'] = $data['order']['triggerTime'];
        $data['lat'] = $data['order']['latLng']['lat'];
        $data['lng'] = $data['order']['latLng']['lng'];
        $data['team_id'] = $data['order']['teamId'];
        $data['homebase_id'] = $data['order']['homebaseId'];
        $data['location_id'] = $data['order']['locationId'];
        $data['rider_id'] = $data['order']['tourDetail']['riderId'];
        $data['rider_name'] = $data['order']['tourDetail']['riderName'];
        $data['vehicle_id'] = $data['order']['tourDetail']['vehicleId'];
        $data['current_eta'] = date('Y-m-d H:i:s', strtotime($data['order']['currentEta']));
        $data['timestamp'] = date('Y-m-d H:i:s', strtotime($data['timestamp']));

        // Start a database transaction
        DB::beginTransaction();
           
        try {
            // Create the OrderCallback model instance
            $orderCallback = OrderCallback::create($data);

            // Commit the transaction
            DB::commit();

            // Return a success response
            return response()->json(['message' => 'Order posted successfully'], 201);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            // Log the error
            \Log::error('Error occurred while storing order: ' . $e->getMessage());

            // Return an error response
            return response()->json(['message' => 'Failed to store order'], 500);
        }
    }

    public function index() {
        // Retrieve all OrderCallbacks
        $orderCallbacks = OrderCallback::all();

        // Return the OrderCallbacks
        return response()->json($orderCallbacks);
    }
}