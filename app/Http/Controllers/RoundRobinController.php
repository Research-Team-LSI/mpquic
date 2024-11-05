<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoundRobinController extends Controller
{
    public function roundRobin(Request $request)
    {
        $request->validate([
            'processes' => 'required|array',
            'burstTimes' => 'required|array',
            'timeQuantum' => 'required|integer|min:1'
        ]);

        $processes = $request->input('processes'); // array of process names
        $burstTimes = $request->input('burstTimes'); // array of burst times
        $timeQuantum = $request->input('timeQuantum'); // intege

        $n = count($processes);
        $remainingTimes = $burstTimes;
        $waitingTimes = array_fill(0, $n, 0);
        $turnAroundTimes = array_fill(0, $n, 0);
        $time = 0;

        while (true) {
            $done = true;

            for ($i = 0; $i < $n; $i++) {
                if ($remainingTimes[$i] > 0) {
                    $done = false;

                    if ($remainingTimes[$i] > $timeQuantum) {
                        $time += $timeQuantum;
                        $remainingTimes[$i] -= $timeQuantum;
                    } else {
                        $time += $remainingTimes[$i];
                        $waitingTimes[$i] = $time - $burstTimes[$i];
                        $remainingTimes[$i] = 0;
                    }
                }
            }

            if ($done) break;
        }

        for ($i = 0; $i < $n; $i++) {
            $turnAroundTimes[$i] = $burstTimes[$i] + $waitingTimes[$i];
        }

        $avgWaitingTime = array_sum($waitingTimes) / $n;
        $avgTurnAroundTime = array_sum($turnAroundTimes) / $n;

        $response = [
            'processes' => $processes,
            'burstTimes' => $burstTimes,
            'waitingTimes' => $waitingTimes,
            'turnAroundTimes' => $turnAroundTimes,
            'avgWaitingTime' => $avgWaitingTime,
            'avgTurnAroundTime' => $avgTurnAroundTime,
        ];

        return response()->json($response);
    }
}
