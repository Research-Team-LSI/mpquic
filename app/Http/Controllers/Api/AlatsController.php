<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use App\Models\Humidity;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AlatsController extends Controller
{
    /**
     * Mengambil data terakhir dari database berdasarkan id_alat.
     */
    public function index(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id' => 'required|exists:alat,id_alat',
        ]);

        $idAlat = $validated['id'];

        // Ambil data terakhir dari tabel humidity
        $humidity = Humidity::where('id_alat', $idAlat)
            ->orderBy('id_humidity', 'desc')
            ->get();

        // Ambil data terakhir dari tabel temperature
        $temperature = Temperature::where('id_alat', $idAlat)
            ->orderBy('id_temperature', 'desc')
            ->get();

        // Cek jika data kosong
        if ($humidity->isEmpty() && $temperature->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan untuk id_alat yang diberikan.',
            ], 404);
        }

        // Algoritma Round Robin untuk menyusun data humidity dan temperature
        $roundRobinData = [];
        $maxData = max(count($humidity), count($temperature));

        for ($i = 0; $i < $maxData; $i++) {
            if (isset($humidity[$i])) {
                $roundRobinData[$i]['humidity'] = [
                    'value' => $humidity[$i]->value,
                    'created_at' => $humidity[$i]->created_at->format('Y-m-d H:i:s.v'),
                ];
            }
            if (isset($temperature[$i])) {
                $roundRobinData[$i]['temperature'] = [
                    'value' => $temperature[$i]->value,
                    'created_at' => $temperature[$i]->created_at->format('Y-m-d H:i:s.v'),
                ];
            }

            // Perhitungan latensi jika kedua data tersedia
            if (isset($humidity[$i]) && isset($temperature[$i])) {
                $roundRobinData[$i]['latency'] = $this->calculateLatency(
                    $humidity[$i]->created_at,
                    $temperature[$i]->created_at
                );
            }
        }

        // Hitung throughput (dalam interval 10 menit)
        $throughput = $this->calculateThroughput(count($roundRobinData), 600);

        // Simpan data ke tabel `data`
        foreach ($roundRobinData as $data) {
            Data::create([
                'id_alat' => $idAlat,
                'throughput' => $throughput,
                'latency' => $data['latency'] ?? 0,
            ]);
        }

        // Mengembalikan response dengan data yang sudah diolah dan throughput
        return response()->json([
            'success' => true,
            'data' => $roundRobinData,
            'throughput' => $throughput,
        ]);
    }

    // Fungsi untuk menghitung throughput
    private function calculateThroughput($dataCount, $intervalInSeconds)
    {
        $dataSize = 26; // byte per data
        $totalData = $dataCount * $dataSize;
        return $totalData / $intervalInSeconds; // bytes per second
    }

    // Fungsi untuk menghitung latency
    private function calculateLatency($timestamp1, $timestamp2)
    {
        $start = Carbon::parse($timestamp1);
        $end = Carbon::parse($timestamp2);
        return $start->diffInMilliseconds($end);
    }
}
