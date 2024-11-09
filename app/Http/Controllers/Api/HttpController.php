<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Humidity;
use App\Models\Temperature;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $humidity = Humidity::where('id_alat', $request->id)
    //         ->offset(0)
    //         ->limit(1)
    //         ->orderBy('id_humidity', 'desc')
    //         ->get();
    //     $temperature = Temperature::where('id_alat', $request->id)
    //         ->offset(0)
    //         ->limit(1)
    //         ->orderBy('id_temperature', 'desc')
    //         ->get();

    //     return response()->json(['humidity' => $humidity, 'Temperature' => $temperature]);
    // }

    public function index(Request $request)
    {
        $humidity = Humidity::where('id_alat', $request->id)
            ->orderBy('id_humidity', 'desc')
            ->first();

        $temperature = Temperature::where('id_alat', $request->id)
            ->orderBy('id_temperature', 'desc')
            ->first();

        return response()->json([
            'humidity' => $humidity,
            'temperature' => $temperature
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
