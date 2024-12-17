<?php

namespace App\Http\Controllers;

use App\Models\Humidity;
use App\Models\Temperature;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    // Method untuk mengambil data suhu dan kelembaban berdasarkan id_alat
    public function getDataByIdAlat(Request $request)
    {
        // Validasi data id_alat
        $request->validate([
            'id_alat' => 'required|integer',
        ]);

        try {
            // Ambil data suhu berdasarkan id_alat
            $temperatureData = Temperature::where('id_alat', $request->id_alat)->get();
            // Ambil data kelembaban berdasarkan id_alat
            $humidityData = Humidity::where('id_alat', $request->id_alat)->get();

            // Jika tidak ada data suhu dan kelembaban
            if ($temperatureData->isEmpty() && $humidityData->isEmpty()) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }

            // Gabungkan data suhu dan kelembaban
            return response()->json([
                'temperature' => $temperatureData,
                'humidity' => $humidityData
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $th->getMessage()], 500);
        }
    }
}
