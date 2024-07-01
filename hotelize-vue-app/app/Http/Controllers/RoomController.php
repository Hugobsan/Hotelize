<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomRequest $request)
    {
        try {
            $room = Room::create($request->validated());
        } catch (\Exception $e) {
            toastr()->error('Erro ao cadastrar quarto');
            return redirect()->back();
        }
        toastr()->success('Quarto cadastrado com sucesso');
        
        return redirect()->route('hotels.show', $room->hotel_id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(RoomRequest $request, string $id)
    {
        try{
            $room = Room::findOrFail($id);
            $room->update($request->validated());
        } catch (\Exception $e) {
            toastr()->error('Erro ao atualizar quarto');
            return redirect()->back();
        }
        toastr()->success('Quarto atualizado com sucesso');

        return redirect()->route('hotels.show', $room->hotel_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $room = Room::findOrFail($id);
            $room->delete();
        } catch (\Exception $e) {
            return redirect()->back();
        }

        return redirect()->route('hotels.show', $room->hotel_id);
    }
}
