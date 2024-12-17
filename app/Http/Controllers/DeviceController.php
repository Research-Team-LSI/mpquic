<?php

namespace App\Http\Controllers;

use App\Models\Humidity;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function temperature(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id_alat' => 'required|integer',
            'nilai' => 'required|numeric',
        ]);

        try {
            $date = Carbon::now();
            $data = Temperature::create([
                'id_alat' => $request->id_alat,
                'nilai_temperature' => $request->nilai, // Make sure this field is provided in the request
                'created_at' => $date,
            ]);

            return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal ditambahkan', 'error' => $th->getMessage()], 500);
        }
    }

    public function humidity(Request $request)
    {
        try {
            $date = Carbon::now();
            $data = Humidity::create([
                'id_alat' => $request->id_alat,
                'nilai_humidity' => $request->nilai,
                'created_at' => $date,
            ]);

            return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data gagal ditambahkan', 'error' => $th->getMessage()], 500);
        }
    }
}
