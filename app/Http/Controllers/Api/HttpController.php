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

    // public function index(Request $request)
    // {
    //     $humidity = Humidity::where('id_alat', $request->id)
    //         ->orderBy('id_humidity', 'desc')
    //         ->first();

    //     $temperature = Temperature::where('id_alat', $request->id)
    //         ->orderBy('id_temperature', 'desc')
    //         ->first();

    //     return response()->json([
    //         'humidity' => $humidity,
    //         'temperature' => $temperature
    //     ]);
    // }

    public function index(Request $request)
    {
        $startTime = microtime(true);

        // ini untuk gett data humi and temp
        $humidity = Humidity::orderBy('id_humidity', 'desc')->get();
        $temperature = Temperature::orderBy('id_temperature', 'desc')->get();

        // ini buat cek apakah ada data yang diproses
        if ($humidity->isEmpty() || $temperature->isEmpty()) {
            return response()->json([
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $timeQuantum = $request->input('timeQuantum', 5);

        // Menggabungkan data menggunakan algoritma Round Robin
        $roundRobinData = $this->applyRoundRobin($humidity, $temperature, $timeQuantum);

        // Menghitung throughput
        $totalTransmits = count($roundRobinData['data']);
        $dataSizePerTransmit = 26; // ini transmit per byte
        $totalDataSize = $totalTransmits * $dataSizePerTransmit;

        // ini saya inisiasi per 10 menit
        $waktuDalamDetik = 10 * 60;

        // ini dijadikan per detik
        $throughput = $totalDataSize / $waktuDalamDetik;

        $endTime = microtime(true);

        // Menghitung waktu eksekusi dalam detik
        $executionTime = $endTime - $startTime;

        // ini hasil rspon kecepatan throughput
        return response()->json([
            'data' => $roundRobinData,
            'execution_time' => $executionTime,
            'throughput' => $throughput //ini proses througpiy
        ]);
    }

    // algoritma roundrobin
    private function applyRoundRobin($humidity, $temperature, $timeQuantum)
    {
        $roundRobinData = [];

        // jumlah data humidity sm temp
        $n = max(count($humidity), count($temperature));

        // data ditampung disini
        $remainingHumidityTimes = $humidity->pluck('nilai_humidity')->toArray();
        $remainingTemperatureTimes = $temperature->pluck('nilai_temperature')->toArray();

        $time = 0;

        // Algoritma Round Robin 
        while (true) {
            $done = true;

            // Proses data humidity
            for ($i = 0; $i < $n; $i++) {
                if (isset($remainingHumidityTimes[$i]) && $remainingHumidityTimes[$i] > 0) {
                    $done = false;
                    if ($remainingHumidityTimes[$i] > $timeQuantum) {
                        $time += $timeQuantum;
                        $remainingHumidityTimes[$i] -= $timeQuantum;
                    } else {
                        $time += $remainingHumidityTimes[$i];
                        $remainingHumidityTimes[$i] = 0;
                    }
                }
            }

            // ini proses data temperature
            for ($i = 0; $i < $n; $i++) {
                if (isset($remainingTemperatureTimes[$i]) && $remainingTemperatureTimes[$i] > 0) {
                    $done = false;
                    if ($remainingTemperatureTimes[$i] > $timeQuantum) {
                        $time += $timeQuantum;
                        $remainingTemperatureTimes[$i] -= $timeQuantum;
                    } else {
                        $time += $remainingTemperatureTimes[$i];
                        $remainingTemperatureTimes[$i] = 0;
                    }
                }
            }

            if ($done) break;
        }

        for ($i = 0; $i < $n; $i++) {
            if (isset($humidity[$i]) && isset($temperature[$i])) {
                $roundRobinData[] = [
                    'humidity' => [
                        'id_humidity' => $humidity[$i]->id_humidity,
                        'id_alat' => $humidity[$i]->id_alat,
                        'nilai_humidity' => $humidity[$i]->nilai_humidity,
                    ],
                    'temperature' => [
                        'id_temperature' => $temperature[$i]->id_temperature,
                        'id_alat' => $temperature[$i]->id_alat,
                        'nilai_temperature' => $temperature[$i]->nilai_temperature,
                    ]
                ];
            }
        }

        return [
            'data' => $roundRobinData
        ];
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
