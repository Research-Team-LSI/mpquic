<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RoundRobinPytonController extends Controller
{
    // public function calculate(Request $request)
    // {
    //     $request->validate([
    //         'processes' => 'required|array',
    //         'burstTimes' => 'required|array',
    //         'timeQuantum' => 'required|integer|min:1'
    //     ]);

    //     $processes = $request->input('processes');
    //     $burstTimes = $request->input('burstTimes');
    //     $timeQuantum = $request->input('timeQuantum');

    //     $process = new Process([
    //         'python3',
    //         base_path('python_scripts/round_robin.py'),
    //         json_encode($processes),
    //         json_encode($burstTimes),
    //         $timeQuantum
    //     ]);

    //     $process->run();

    //     if (!$process->isSuccessful()) {
    //         throw new ProcessFailedException($process);
    //     }

    //     $output = json_decode($process->getOutput(), true);

    //     return response()->json($output);
    // }

    public function fetchData()
    {
        $response = Http::post('http://127.0.0.1:5000/round_robin', [
            'processes' => [1, 2, 3, 4],
            'burst_times' => [10, 5, 8, 6],
            'time_quantum' => 2,
        ]);

        $data = $response->json();
        return $data;
    }
}
