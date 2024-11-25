<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marker;

class MarkerController extends Controller
{

    public function store(Request $request)
    {        
        $validated = $request->validate([
            'place_name' => 'required|string|max:255',
            'detail_address' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'category' => 'required|string|max:100',
        ]);
        
        $marker = new Marker();
        $marker->place_name = $validated['place_name'];
        $marker->detail_address = $validated['detail_address'];
        $marker->description = $validated['description'];
        $marker->latitude = $validated['latitude'];
        $marker->longitude = $validated['longitude'];
        $marker->category = $validated['category'];
        $marker->save();
        
        return redirect()->back()->with('success', 'Marker berhasil disimpan!');
    }
    public function getMarkers(Request $request)
    {        
        $category = $request->query('category');
                
        if ($category) {
            $markers = Marker::where('category', $category)->get();
        } else {
            $markers = Marker::all();
        }

        return response()->json($markers);
    }

}
