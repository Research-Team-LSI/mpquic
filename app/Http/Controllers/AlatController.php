<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('data')->get();
        return view('dashboard', compact('alat'));
    }
    public function http()
    {
        $alat = Alat::where('protocol', 'http')->paginate(5);
        return view('http', compact('alat'));
    }
    public function mpquic()
    {
        $alat = Alat::where('protocol', 'mpquic')->paginate(5);
        return view('mpquic', compact('alat'));
    }
    // public function getThroughputData()
    // {
    //     $data = Alat::with('data')->get()->pluck('data.*.throughput')->flatten();
    //     $timestamps = Alat::with('data')->get()->pluck('data.*.created_at')->flatten();

    //     return response()->json([
    //         'data' => $data,
    //         'timestamps' => $timestamps->map(fn($timestamp) => $timestamp->format('d M')),
    //     ]);
    // }

    public function getThroughputData(Request $request)
    {
        $query = Alat::with('data');

        if ($request->has('date_filter')) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereHas('data', function ($q) {
                        $q->whereDate('created_at', now()->toDateString());
                    });
                    break;
                case 'last_7_days':
                    $query->whereHas('data', function ($q) {
                        $q->whereDate('created_at', '>=', now()->subDays(7)->toDateString());
                    });
                    break;
            }
        }

        $data = $query->get()->pluck('data.*.throughput')->flatten();
        $timestamps = $query->get()->pluck('data.*.created_at')->flatten();

        return response()->json([
            'data' => $data,
            'timestamps' => $timestamps->map(fn($timestamp) => $timestamp->format('d M')),
        ]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'protocol' => 'required|in:http,mpquic',
            'microcontroller' => 'required|in:esp32,esp8266,raspberrypi',
            'mac_address' => 'required|string|max:20',
            'ip_address' => 'required|string|max:16',
        ]);

        Alat::create([
            'protocol' => $request->protocol,
            'microcontroller' => $request->microcontroller,
            'mac_address' => $request->mac_address,
            'ip_address' => $request->ip_address,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data alat berhasil ditambahkan.');
    }
}
