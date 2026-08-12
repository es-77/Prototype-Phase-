<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleService;

class VehicleServiceController extends Controller
{
    // index action to show dashboard and handle search query
    public function index(Request $request)
    {
        $services = VehicleService::all();
        $searchedService = null;
        $searchPerformed = false;

        // check if user searched for specific service id
        if ($request->has('search_id') && $request->input('search_id') !== null) {
            $searchId = $request->input('search_id');
            $searchedService = VehicleService::find($searchId);
            $searchPerformed = true;
        }

        return view('welcome', compact('services', 'searchedService', 'searchPerformed'));
    }

    // store new service in db
    public function store(Request $request)
    {
        $request->validate([
            'ServiceName' => 'required|string|max:255',
            'VehicleModel' => 'required|string|max:255',
            'ServiceType' => 'required|string',
            'ServiceAmount' => 'required|numeric|min:0',
            'Picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $picturePath = null;
        // handle upload picture file
        if ($request->hasFile('Picture')) {
            $file = $request->file('Picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $picturePath = 'uploads/' . $filename;
        }

        // save to db
        VehicleService::create([
            'ServiceName' => $request->input('ServiceName'),
            'VehicleModel' => $request->input('VehicleModel'),
            'ServiceType' => $request->input('ServiceType'),
            'ServiceAmount' => $request->input('ServiceAmount'),
            'Picture' => $picturePath,
        ]);

        return redirect()->back()->with('success', 'Vehicle service record added successfully!');
    }

    // update existing service by ServiceId
    public function update(Request $request)
    {
        $request->validate([
            'ServiceId' => 'required|integer',
            'ServiceName' => 'required|string|max:255',
            'VehicleModel' => 'required|string|max:255',
            'ServiceType' => 'required|string',
            'ServiceAmount' => 'required|numeric|min:0',
            'Picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = VehicleService::find($request->input('ServiceId'));

        if (!$service) {
            return redirect()->back()->with('error', 'Service record not found with that Service ID!');
        }

        // update data
        $service->ServiceName = $request->input('ServiceName');
        $service->VehicleModel = $request->input('VehicleModel');
        $service->ServiceType = $request->input('ServiceType');
        $service->ServiceAmount = $request->input('ServiceAmount');

        // check if new picture upload
        if ($request->hasFile('Picture')) {
            // delete old picture if exists
            if ($service->Picture && file_exists(public_path($service->Picture))) {
                @unlink(public_path($service->Picture));
            }

            $file = $request->file('Picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $service->Picture = 'uploads/' . $filename;
        }

        $service->save();

        return redirect()->back()->with('success', 'Vehicle service record updated successfully!');
    }

    // delete service record from database
    public function destroy(Request $request)
    {
        $request->validate([
            'ServiceId' => 'required|integer',
        ]);

        $service = VehicleService::find($request->input('ServiceId'));

        if (!$service) {
            return redirect()->back()->with('error', 'Cannot find service record to delete!');
        }

        // delete picture from folder first
        if ($service->Picture && file_exists(public_path($service->Picture))) {
            @unlink(public_path($service->Picture));
        }

        $service->delete();

        return redirect()->back()->with('success', 'Vehicle service record deleted successfully!');
    }
}
