<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Data;
use App\Models\Humidity;
use App\Models\Temperature;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function index()
    {
        function getLatestData($id_alat)
        {
            return [
                'Humidity' => Humidity::where('id_alat', $id_alat)->limit(1)->latest()->get(),
                'Temperature' => Temperature::where('id_alat', $id_alat)->limit(1)->latest()->get(),
            ];
        }

        $data1 = getLatestData(1);
        $data2 = getLatestData(2);
        $data3 = getLatestData(3);
        $data4 = getLatestData(4);

        $data = [
            'Humidity1' => $data1['Humidity'],
            'Temperature1' => $data1['Temperature'],

            'Humidity2' => $data2['Humidity'],
            'Temperature2' => $data2['Temperature'],

            'Humidity3' => $data3['Humidity'],
            'Temperature3' => $data3['Temperature'],

            'Humidity4' => $data4['Humidity'],
            'Temperature4' => $data4['Temperature'],
        ];

        return view('dashboard', $data);
    }

    public function detaildashboard(Request $request, $id)
    {
        return view('dashboard/detaildashboard');
    }

    public function humidity(Request $request, $id)
    {
        try {
            $speeds = Humidity::where('id_alat', $id)->latest()->take(30)->get()->sortBy('id_humidity');
            $labels = $speeds->pluck('created_at')->map(function ($date) {
                return $date->format('H:i');
            })->toArray();
            $data = $speeds->pluck('nilai_humidity')->toArray();

            $latestData = Humidity::latest()->first();

            return response()->json([
                'labels' => $labels,
                'data' => $data,
                'latest' => [
                    'id_humidity' => $latestData->id_humidity,
                    'nilai_humidity' => $latestData->nilai_humidity,
                    'created_at' => $latestData->created_at,
                    'updated_at' => $latestData->updated_at,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function temperature(Request $request, $id)
    {
        try {
            $speeds = Temperature::where('id_alat', $id)->latest()->take(30)->get()->sortBy('id_temp');
            $labels = $speeds->pluck('created_at')->map(function ($date) {
                return $date->format('H:i');
            })->toArray();
            $data = $speeds->pluck('nilai_temperature')->toArray();

            $latestData = Temperature::latest()->first();

            return response()->json([
                'labels' => $labels,
                'data' => $data,
                'latest' => [
                    'id_temp' => $latestData->id_temp,
                    'nilai_temperature' => $latestData->nilai_temperature,
                    'created_at' => $latestData->created_at,
                    'updated_at' => $latestData->updated_at,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getThroughputData()
    {
        $data = Alat::whereHas('alat', function ($query) {
            $query->where('protocol', 'http');
        })->get();

        $response = [
            'timestamps' => $data->pluck('created_at')->map(function ($timestamp) {
                return $timestamp->format('Y-m-d H:i:s');
            }),
            'data' => $data->pluck('throughput'),
        ];

        return response()->json($response);
    }
}
