<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;
use App\Models\Humidity;
use App\Models\Temperature;
use Carbon\Carbon;

class AlatsController extends Controller
{
    /**
     * Mengambil data terakhir dari database berdasarkan id_alat.
     */
    public function index(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:alat,id_alat',
        ]);

        // Ambil data terakhir dari tabel humidity
        $humidity = Humidity::where('id_alat', $request->id)
            ->orderBy('id_humidity', 'desc')
            // ->first();
            ->get();

        // Ambil data terakhir dari tabel temperature
        $temperature = Temperature::where('id_alat', $request->id)
            ->orderBy('id_temperature', 'desc')
            // ->first();
            ->get();

        // Respon JSON
        // return response()->json([
        //     'success' => true,
        //     'data' => [
        //         'humidity' => $humidity,
        //         'temperature' => $temperature,
        //     ],
        // ]);

        // Inisialisasi array untuk Round Robin
        $roundRobinData = [];
        $maxData = max(count($humidity), count($temperature));  // Ambil jumlah data terbanyak

        // Algoritma Round Robin untuk menyusun data humidity dan temperature secara bergiliran
        for ($i = 0; $i < $maxData; $i++) {
            // Menambahkan data humidity dan temperature secara bergiliran
            if (isset($humidity[$i])) {
                $roundRobinData[$i]['humidity'] = $humidity[$i];
                // Format created_at dan updated_at untuk humidity dengan milidetik
                $roundRobinData[$i]['humidity']['created_at'] = Carbon::parse($humidity[$i]->created_at)->format('Y-m-d H:i:s.v');
                $roundRobinData[$i]['humidity']['updated_at'] = Carbon::parse($humidity[$i]->updated_at)->format('Y-m-d H:i:s.v');
            }
            if (isset($temperature[$i])) {
                $roundRobinData[$i]['temperature'] = $temperature[$i];
                // Format created_at dan updated_at untuk temperature dengan milidetik
                $roundRobinData[$i]['temperature']['created_at'] = Carbon::parse($temperature[$i]->created_at)->format('Y-m-d H:i:s.v');
                $roundRobinData[$i]['temperature']['updated_at'] = Carbon::parse($temperature[$i]->updated_at)->format('Y-m-d H:i:s.v');
            }

            // Menghitung latency untuk setiap data yang diproses
            if (isset($humidity[$i]) && isset($temperature[$i])) {
                $roundRobinData[$i]['latency'] = $this->calculateLatency(
                    $humidity[$i]->created_at,
                    $temperature[$i]->created_at
                );
            }
        }

        // Menghitung throughput (misalnya dengan interval 10 menit / 600 detik)
        $throughput = $this->calculateThroughput(count($roundRobinData), 600);  // 600 detik = 10 menit

        // Simpan hasil throughput dan latency ke tabel `data`
        foreach ($roundRobinData as $data) {
            Data::create([
                'id_alat' => $request->id,
                'throughput' => $throughput,
                'latency' => $data['latency'] ?? 0,  // Jika latency tidak ada, set 0
            ]);
        }

        // Mengembalikan response dengan data yang sudah diolah dan throughput
        return response()->json([
            'success' => true,
            'data' => $roundRobinData,
            'throughput' => $throughput,  // Mengirimkan throughput yang telah dihitung
        ]);
    }

    // Fungsi untuk menghitung throughput (dataSize = 26 byte per transmisi)
    private function calculateThroughput($dataCount, $intervalInSeconds)
    {
        // Ukuran data per transmisi (26 byte)
        $dataSize = 26; // byte

        // Total data yang ditransmisikan
        $totalData = $dataCount * $dataSize; // dalam byte

        // Hitung throughput (bytes per second)
        $throughput = $totalData / $intervalInSeconds; // bytes per second

        return $throughput;
    }

    // Fungsi untuk menghitung latency antara dua timestamp
    private function calculateLatency($timestamp1, $timestamp2)
    {
        // Menggunakan Carbon untuk menghitung selisih waktu antara dua timestamp
        $start = Carbon::parse($timestamp1);
        $end = Carbon::parse($timestamp2);

        // Menghitung latency dalam milidetik
        $latency = $start->diffInMilliseconds($end);

        return $latency;
    }
}
