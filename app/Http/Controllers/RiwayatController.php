<?php

namespace App\Http\Controllers;

use App\Exports\ExportRiwayat;
use App\Models\Amonia;
use App\Models\Dioksida;
use App\Models\Humidity;
use App\Models\Metana;
use App\Models\Temperature;
use Excel;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayatTemperature()
    {
        return view('riwayat/temperature');
    }

    public function riwayatHumidity()
    {
        return view('riwayat/humidity');
    }

    public function riwayatAmonia(Request $request)
    {
        return view('riwayat/amonia');
    }

    public function riwayatDioksida()
    {
        return view('riwayat/dioksida');
    }

    public function riwayatMetana()
    {
        return view('riwayat/metana');
    }


    public function getAmoniaData(Request $request)
    {
        $start_date = $request->input('createFrom') ?? now()->subDays(7)->format('Y-m-d');
        $end_date = $request->input('createTo') ?? now()->format('Y-m-d');

        // Query untuk mendapatkan data suhu rata-rata antara dua tanggal
        $data = Amonia::selectRaw('DATE(created_at) as date, round(AVG(nilai_amonia), 0) as avg_amonia')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format data untuk Chart.js
        $labels = $data->pluck('date');
        $values = $data->pluck('avg_amonia');

        return response()->json([
            'labels' => $labels,
            'data' => $values,
        ]);
    }

    public function getTemperatureData(Request $request)
    {
        // Tetapkan rentang tanggal default jika parameter tidak ada
        $start_date = $request->input('createFrom') ?? now()->subDays(7)->format('Y-m-d');
        $end_date = $request->input('createTo') ?? now()->format('Y-m-d');

        // Query untuk mendapatkan data tanpa agregasi
        $data = Temperature::whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('created_at', 'asc') // Urutkan berdasarkan waktu
            ->get(['created_at', 'nilai_temperature']); // Ambil data mentah

        // Format data untuk Chart.js
        $labels = $data->pluck('created_at')->map(function ($timestamp) {
            return \Carbon\Carbon::parse($timestamp)->format('Y-m-d H:i:s'); // Format waktu sesuai kebutuhan
        });

        $values = $data->pluck('nilai_temperature'); // Data suhu langsung

        return response()->json([
            'labels' => $labels,
            'data' => $values,
        ]);
    }


    public function getMetanaData(Request $request)
    {
        $start_date = $request->input('createFrom') ?? now()->subDays(7)->format('Y-m-d');
        $end_date = $request->input('createTo') ?? now()->format('Y-m-d');

        // Query untuk mendapatkan data suhu rata-rata antara dua tanggal
        $data = Metana::selectRaw('DATE(created_at) as date, round(AVG(nilai_metana), 0) as avg_metana')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format data untuk Chartb.js
        $labels = $data->pluck('date');
        $values = $data->pluck('avg_metana');

        return response()->json([
            'labels' => $labels,
            'data' => $values,
        ]);
    }

    public function getDioksidaData(Request $request)
    {
        $start_date = $request->input('createFrom') ?? now()->subDays(7)->format('Y-m-d');
        $end_date = $request->input('createTo') ?? now()->format('Y-m-d');

        // Query untuk mendapatkan data suhu rata-rata antara dua tanggal
        $data = Dioksida::selectRaw('DATE(created_at) as date, round(AVG(nilai_dioksida), 0) as avg_dioksida')
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format data untuk Chart.js
        $labels = $data->pluck('date');
        $values = $data->pluck('avg_dioksida');

        return response()->json([
            'labels' => $labels,
            'data' => $values,
        ]);
    }

    public function getHumidityData(Request $request)
    {
        $start_date = $request->input('createFrom') ?? now()->subDays(7)->format('Y-m-d');
        $end_date = $request->input('createTo') ?? now()->format('Y-m-d');

        // Query untuk mendapatkan data kelembapan tanpa rata-rata
        $data = Humidity::whereBetween('created_at', [$start_date, $end_date])
            ->orderBy('created_at')
            ->get(['created_at', 'nilai_humidity']);

        // Format data untuk Chart.js
        $labels = $data->pluck('created_at')->map(function ($date) {
            return $date->format('Y-m-d H:i:s'); // Format waktu untuk chart
        });

        $values = $data->pluck('nilai_humidity');

        return response()->json([
            'labels' => $labels,
            'data' => $values,
        ]);
    }
}
