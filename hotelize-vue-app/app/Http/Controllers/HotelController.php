<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::with('rooms')->orderBy('name')->get();

        return Inertia::render('Hotels/Index', [
            'hotels' => $hotels,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        try{
            $hotel = Hotel::create($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar hotel');
        }
        return redirect()->route('hotels.index')->with('success', 'Hotel criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Hotel::findOrFail($id);
        
        return view('hotels.show', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HotelRequest $request, string $id)
    {
        try{
            $hotel = Hotel::findOrFail($id);
            $hotel->update($request->validated());
        } catch (\Exception $e) {
            toastr()->error('Erro ao atualizar hotel');
            return redirect()->back();
        }
        toastr()->success('Hotel atualizado com sucesso');
        
        return redirect()->route('hotels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $hotel = Hotel::findOrFail($id);
            $hotel->delete();
        } catch (\Exception $e) {
            toastr()->error('Erro ao excluir hotel');
            return redirect()->back();
        }
        toastr()->success('Hotel excluído com sucesso');
        return redirect()->route('hotels.index');
    }
}
