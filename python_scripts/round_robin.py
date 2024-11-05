from flask import Flask, request, jsonify
import json

app = Flask(__name__)

def round_robin(processes, burst_times, time_quantum):
    n = len(processes)
    remaining_times = burst_times[:]
    waiting_times = [0] * n
    turn_around_times = [0] * n
    time = 0

    while True:
        done = True

        for i in range(n):
            if remaining_times[i] > 0:
                done = False

                if remaining_times[i] > time_quantum:
                    time += time_quantum
                    remaining_times[i] -= time_quantum
                else:
                    time += remaining_times[i]
                    waiting_times[i] = time - burst_times[i]
                    remaining_times[i] = 0

        if done:
            break

    turn_around_times = [burst_times[i] + waiting_times[i] for i in range(n)]

    result = {
        "processes": processes,
        "burst_times": burst_times,
        "waiting_times": waiting_times,
        "turn_around_times": turn_around_times,
        "average_waiting_time": sum(waiting_times) / n,
        "average_turn_around_time": sum(turn_around_times) / n
    }

    return result

@app.route('/round_robin', methods=['POST'])
def api_round_robin():
    data = request.get_json()
    processes = data.get('processes')
    burst_times = data.get('burst_times')
    time_quantum = data.get('time_quantum')

    if not processes or not burst_times or time_quantum is None:
        return jsonify({"error": "Invalid input"}), 400

    result = round_robin(processes, burst_times, time_quantum)
    return jsonify(result)

if __name__ == '__main__':
    app.run(port=5000)
