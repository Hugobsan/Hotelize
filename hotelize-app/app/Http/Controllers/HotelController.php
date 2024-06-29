<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        
        return response()->json($hotels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        $hotel = Hotel::create($request->validated());
        
        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        return response()->json($hotel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, string $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->validated());
        
        return response()->json($hotel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        
        return response()->status(204);
    }
}
