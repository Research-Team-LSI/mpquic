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
    public function httpfilter($id)
    {
        $alat = Alat::where('protocol', 'http')->paginate(5);
        $filter = $id;
        return view('httpfilter', compact('alat', 'filter'));
    }
    public function mpquicfilter($id)
    {
        $alat = Alat::where('protocol', 'mpquic')->paginate(5);
        $filter = $id;
        return view('mpquicfilter', compact('alat', 'filter'));
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
        $query = Alat::with('data')->where('alat.protocol', 'http');
        // $query->whereHas('data', function ($q) {
        //     $q->whereDate('created_at', now()->toDateString())->where('id_alat' , 1)->groupBy('id_alat');
        // });

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
            'timestamps' => $timestamps->map(fn($timestamp) => $timestamp->format('H i s')),
        ]);
    }

    public function getThroughputDatampquic(Request $request)
    {
        $query = Alat::with('data')->where('alat.protocol', 'mpquic');
        // $query->whereHas('data', function ($q) {
        //     $q->whereDate('created_at', now()->toDateString())->where('id_alat' , 1)->groupBy('id_alat');
        // });

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
            'timestamps' => $timestamps->map(fn($timestamp) => $timestamp->format('H i s')),
        ]);
    }

    public function getThroughputDatafilter(Request $request, $id)
    {
        if ($id == 'today') {
            $start = now()->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == 'yesterday') {
            $start = now()->subDays(1)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->subDays(1)->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == 'week') {
            $start = now()->subDays(7)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == 'month') {
            $start = now()->subDays(30)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == '3_months') {
            $start = now()->subDays(90)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } else {
            return response()->json(['error' => 'Invalid filter'], 400);
        }

        $query = Alat::with(['data' => function ($query) use ($start, $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }])->where('protocol', 'http');

        $data = $query->get()->pluck('data.*.throughput')->flatten();
        $timestamps = $query->get()->pluck('data.*.created_at')->flatten();

        return response()->json([
            'data' => $data,
            'timestamps' => $timestamps->map(fn($timestamp) => $timestamp->format('H:i:s')),
            'start' => $start,
            'end' => $end,
        ]);
    }



    public function getThroughputDatampquicfilter(Request $request, $id)
    {
        if ($id == 'today') {
            $start = now()->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == 'yesterday') {
            $start = now()->subDays(1)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->subDays(1)->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == 'week') {
            $start = now()->subDays(7)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == 'month') {
            $start = now()->subDays(30)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } elseif ($id == '3_months') {
            $start = now()->subDays(90)->startOfDay()->format('Y-m-d H:i:s');
            $end = now()->endOfDay()->format('Y-m-d H:i:s');
        } else {
            return response()->json(['error' => 'Invalid filter'], 400);
        }

        $query = Alat::with(['data' => function ($query) use ($start, $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }])->where('protocol', 'mpquic');

        $data = $query->get()->pluck('data.*.throughput')->flatten();
        $timestamps = $query->get()->pluck('data.*.created_at')->flatten();

        return response()->json([
            'data' => $data,
            'timestamps' => $timestamps->map(fn($timestamp) => $timestamp->format('H:i:s')),
            'start' => $start,
            'end' => $end,
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
