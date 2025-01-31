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
        $hotels = Hotel::orderBy('name')->get();
        
        return view('hotels.index', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HotelRequest $request)
    {
        try{
            $hotel = Hotel::create($request->validated());
        } catch (\Exception $e) {
            toastr()->error('Erro ao cadastrar hotel');
            return redirect()->back();
        }
        toastr()->success('Hotel cadastrado com sucesso');
        return redirect()->route('hotels.index');
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
