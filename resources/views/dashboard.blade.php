<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="{{ asset('images/login/logo.png') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')

    <style>
        .progress-container {
            position: relative;
            width: 100%;
            height: 20px;
            background: linear-gradient(to right, red, yellow, green);
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .progress-bar-fill {
            height: 100%;
            width: 0;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .progress-needle {
            position: absolute;
            top: -10px;
            width: 2px;
            height: 40px;
            background: black;
            transition: left 0.5s;
        }
    </style>
</head>

<body class="flex flex-col h-screen">
    <div class="flex h-screen">
        @livewire('partials.sidebar')
        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @livewire('partials.header')

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-4">
                {{-- Ini untuk alert --}}
                @if (session('success'))
                    <div id="success-alert"
                        class="mb-4 p-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                        role="alert">
                        <span class="font-medium">Success!</span> {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            var alert = document.getElementById('success-alert');
                            if (alert) {
                                alert.style.display = 'none';
                            }
                        }, 5000);
                    </script>
                @endif
                <div class="gap-4">
                    <div class="bg-white shadow-lg rounded-lg mb-4">
                        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <h6 class="m-0 font-semibold text-gray-700">Dashboard</h6>
                            <button type="button"
                                class="ms-auto text-white bg-blue-950 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                data-modal-target="crud-modal" data-modal-toggle="crud-modal">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Tambah
                            </button>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <div class="py-4">
                                    <div
                                        class="bg-blue-950 h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center">
                                        <div class="flex justify-between w-full my-6 items-center">
                                            <p class="text-white text-sm font-bold">Temperature</p>
                                            <div class="flex items-center">
                                                <div id="colorIndicatorTemperature" class="w-3 h-3 rounded-full mr-2">
                                                </div>
                                                <p class="text-white text-sm" id="percentageValueTemperature"></p>
                                            </div>
                                        </div>
                                        {{-- <div id="latestValueTemperature" class="text-white text-5xl font-bold mb-4"></div> --}}
                                        {{-- <p class="text-white text-sm">Temperature (°C)</p> --}}
                                        {{-- <p class="text-white text-sm">Saat ini</p> --}}
                                        <div id="latestValueTemperature" class="text-white text-5xl font-bold mb-4">
                                        </div>
                                        <p id="lastUpdatedTemperature" class="text-white text-xs pb-7"></p>
                                    </div>
                                </div>
                            </div>
                            <script>
                                // JavaScript untuk mengambil data terbaru
                                fetchLatestTemperature();
                            </script>
                            <div class="col-span-1">
                                <div class="py-4">
                                    <div class="h-full px-8 rounded-lg shadow-lg flex flex-col justify-center items-center"
                                        style="background-color: #FCA311">
                                        <div class="flex justify-between w-full my-6 items-center">
                                            <p class="text-white text-sm font-bold">Humidity</p>
                                            <div class="flex items-center">
                                                <div id="colorIndicatorHumidity" class="w-3 h-3 rounded-full mr-2">
                                                </div>
                                                <p class="text-white text-sm" id="percentageValueHumidity"></p>
                                            </div>
                                        </div>
                                        <div id="latestValueHumidity" class="text-white text-5xl font-bold mb-4"></div>
                                        <p id="lastUpdatedHumidity" class="text-white text-xs pb-7"></p>

                                        {{-- <p class="text-white text-sm">Humidity (%)</p>
            <p class="text-white text-sm">Saat ini</p> --}}
                                        {{-- <div id="latestValueHumidity" class="text-white text-5xl font-bold mb-4"></div> --}}

                                    </div>
                                </div>
                            </div>

                            <script>
                                // JavaScript untuk mengambil data terbaru kelembapan
                                fetchLatestHumidity();
                            </script>

                        </div>


                        <div class="px-8 py-8">
                            <div class="grid gap-4 grid-cols-1">
                                <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                                    <div class="flex justify-between mb-5">
                                        <div class="grid gap-4 grid-cols-2">
                                            <div>
                                                <h5
                                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2 ">
                                                    HTTP
                                                    <svg data-popover-target="clicks-info"
                                                        data-popover-placement="bottom"
                                                        class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                                    </svg>
                                                    <div data-popover id="clicks-info" role="tooltip"
                                                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                                        <div class="p-3 space-y-2">
                                                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                                                HTTP
                                                                growth - Incremental</h3>
                                                            <p>Report helps navigate cumulative growth of community
                                                                activities. Ideally, the chart should have a growing
                                                                trend,
                                                                as stagnating chart signifies a significant decrease of
                                                                community activity.</p>
                                                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                                                Calculation</h3>
                                                            <p>For each date bucket, the all-time volume of activities
                                                                is
                                                                calculated. This means that activities in period n
                                                                contain
                                                                all activities up to period n, plus the activities
                                                                generated
                                                                by your community in period.</p>
                                                            <a href="#"
                                                                class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                                                more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 6 10">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 9 4-4-4-4" />
                                                                </svg></a>
                                                        </div>
                                                        <div data-popper-arrow></div>
                                                    </div>
                                                </h5>
                                                <?php
                                                $lastData = $alat->where('protocol', 'http')->last()?->data->last();
                                                $kecepatan = $lastData ? $lastData->throughput : 'N/A';
                                                ?>
                                                <p
                                                    class="text-gray-900 dark:text-white text-base leading-none font-semibold">
                                                    {{ $kecepatan }} bps
                                                </p>
                                            </div>
                                            <div>
                                                <h5
                                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                                    MP QUIC
                                                    <svg data-popover-target="cpc-info" data-popover-placement="bottom"
                                                        class="w-3 h-3 text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                                    </svg>
                                                    <div data-popover id="cpc-info" role="tooltip"
                                                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                                        <div class="p-3 space-y-2">
                                                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                                                MP QUIC
                                                                growth - Incremental</h3>
                                                            <p>Report helps navigate cumulative growth of community
                                                                activities. Ideally, the chart should have a growing
                                                                trend,
                                                                as stagnating chart signifies a significant decrease of
                                                                community activity.</p>
                                                            <h3 class="font-semibold text-gray-900 dark:text-white">
                                                                Calculation</h3>
                                                            <p>For each date bucket, the all-time volume of activities
                                                                is
                                                                calculated. This means that activities in period n
                                                                contain
                                                                all activities up to period n, plus the activities
                                                                generated
                                                                by your community in period.</p>
                                                            <a href="#"
                                                                class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                                                more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180"
                                                                    aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 6 10">
                                                                    <path stroke="currentColor" stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="m1 9 4-4-4-4" />
                                                                </svg></a>
                                                        </div>
                                                        <div data-popper-arrow></div>
                                                    </div>
                                                </h5>
                                                <?php
                                                $lastData = $alat->where('protocol', 'mpquic')->last()?->data->last();
                                                $kecepatan = $lastData ? $lastData->throughput : 'N/A';
                                                ?>
                                                <p
                                                    class="text-gray-900 dark:text-white text-base leading-none font-semibold">
                                                    {{ $kecepatan }} bps
                                                </p>

                                            </div>
                                        </div>
                                        {{-- <div>
                                            <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                                data-dropdown-placement="bottom" type="button"
                                                class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Last
                                                week <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                                </svg></button>
                                            <div id="lastDaysdropdown"
                                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownDefaultButton">
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Yesterday</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Today</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                            7 days</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                            30 days</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Last
                                                            90 days</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div id="line-chart"></div>
                                </div>
                            </div>
                        </div>

                        <div class="gap-4">
                            <div class="bg-white shadow-lg rounded-lg mb-4">
                                <div class="px-8 py-8">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        {{-- tabel --}}
                                        <table
                                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-white uppercase dark:bg-gray-700 dark:text-gray-400"
                                                style="background-color: #FCA311">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">ID</th>
                                                    <th scope="col" class="px-6 py-3">Jenis Protokol</th>
                                                    <th scope="col" class="px-6 py-3">Microcontroller</th>
                                                    <th scope="col" class="px-6 py-3">MAC Address</th>
                                                    <th scope="col" class="px-6 py-3">IP Address</th>
                                                    <th scope="col" class="px-6 py-3">Throughput</th>
                                                    <th scope="col" class="px-6 py-3">Latency</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($alat as $item)
                                                    <tr
                                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                        <th scope="row"
                                                            class="px-6 py-4 align-top font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ $item->id_alat }}
                                                        </th>
                                                        <td class="px-6 py-4 align-top">{{ $item->protocol }}</td>
                                                        <td class="px-6 py-4 align-top">{{ $item->microcontroller }}
                                                        </td>
                                                        <td class="px-6 py-4 align-top">{{ $item->mac_address }}</td>
                                                        <td class="px-6 py-4 align-top">{{ $item->ip_address }}</td>

                                                        <!-- Kolom 6-7 tetap di tengah -->
                                                        <td class="px-6 py-4 text-left">
                                                            {{-- @foreach ($item->data as $data)
                                                                <div>{{ $data->throughput }}</div>
                                                            @endforeach --}}
                                                            @if ($item->data->isNotEmpty())
                                                                {{ $item->data->last()->throughput }}
                                                            @endif
                                                        </td>
                                                        <td class="px-6 py-4 text-left">
                                                            {{-- @foreach ($item->data as $data)
                                                                <div>{{ $data->latency }}</div>
                                                            @endforeach --}}
                                                            @if ($item->data->isNotEmpty())
                                                                {{ $item->data->last()->latency }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Modal --}}
                        <div id="crud-modal" tabindex="-1"
                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                            <div class="relative w-full h-full max-w-md md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                        data-modal-toggle="crud-modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="px-6 py-6 lg:px-8">
                                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Alat
                                        </h3>
                                        <form class="space-y-6" action="/dashboard" method="POST">
                                            @csrf
                                            <div>
                                                <label for="protocol"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Protocol</label>
                                                <select id="protocol" name="protocol"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option selected="protocol">Pilih Protocol
                                                    </option>
                                                    <option value="http">HTTP</option>
                                                    <option value="mpquic">MPQUIC</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="microcontroller"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Microcontroller</label>
                                                <select id="microcontroller" name="microcontroller"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                    <option selected="microcontroller">Pilih Microcontroller
                                                    </option>
                                                    <option value="esp32">ESP32</option>
                                                    <option value="esp8266">ESP8266</option>
                                                    <option value="raspberrypi">Raspberry Pi</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="mac_address"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">MAC
                                                    Address</label>
                                                <input type="text" name="mac_address" id="mac_address"
                                                    maxlength="20"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="contoh: 00-B0-D0-63-C2-26" required>
                                            </div>
                                            <div>
                                                <label for="ip_address"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">IP
                                                    Address</label>
                                                <input type="text" name="ip_address" id="ip_address"
                                                    maxlength="16"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                    placeholder="contoh: 192.164.001.001" required>
                                            </div>
                                            <button type="submit"
                                                class="w-full text-white bg-blue-950 hover:bg-blue-700 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            @livewire('partials.footer')

            <!-- Logout form (hidden by default) -->
            <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="logout" value="true">
            </form>
        </div>
    </div>
    @vite('resources/js/app.js')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Promise.all([
                fetch('/throughput-data').then((response) => response.json()),
                fetch('/throughput-data-mpquic').then((response) => response.json()),
            ]).then(([httpData, mpquicData]) => {
                // fetch('/throughput-data')
                //     .then(response => response.json())
                //     .then(apiData => {
                // const formattedTimestamps = apiData.timestamps.map(timestamp => {
                //     return new Date(timestamp).toLocaleTimeString([], {
                //         hour: '2-digit',
                //         minute: '2-digit',
                //         second: '2-digit'
                //     });
                // });
                const options1 = {
                    chart: {
                        height: "100%",
                        maxWidth: "100%",
                        type: "line",
                        fontFamily: "Inter, sans-serif",
                        dropShadow: {
                            enabled: false,
                        },
                        toolbar: {
                            show: false,
                        },
                    },
                    tooltip: {
                        enabled: true,
                        x: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        width: 6,
                    },
                    grid: {
                        show: true,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -26
                        },
                    },
                    // series: [{
                    //     name: "Throughput",
                    //     data: apiData.data,
                    //     color: "#FCA311",
                    // }],
                    series: [{
                            name: "HTTP Throughput",
                            data: httpData.data,
                            color: "#FCA311",
                        },
                        {
                            name: "MPQUIC Throughput",
                            data: mpquicData.data,
                            color: "#000000", // Warna hitam untuk MPQUIC
                        },
                    ],
                    legend: {
                        show: true
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        categories: httpData.timestamps, // Asumsi timestamps sama untuk kedua data
                        labels: {
                            show: true,
                            rotate: -45,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400',
                            },
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: false,
                    },
                };

                if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
                    const chart1 = new ApexCharts(document.getElementById("line-chart"), options1);
                    chart1.render();
                };
            });
            async function fetchLatestTemperature() {
                try {
                    const response = await fetch('/api/latest-temperature');
                    const data = await response.json();

                    // Update elemen card dengan data yang diambil
                    document.getElementById('latestValueTemperature').innerText = data.nilai_temperature +
                        " °C";
                    document.getElementById('lastUpdatedTemperature').innerText = "Last updated: " + new Date(
                        data
                        .updated_at).toLocaleString();
                } catch (error) {
                    console.error('Error fetching temperature:', error);
                }
            }

            // Panggil fungsi setiap beberapa detik untuk update otomatis
            setInterval(fetchLatestTemperature, 10000); // Update setiap 10 detik

            // Panggilan awal saat halaman dimuat
            fetchLatestTemperature();



            async function fetchLatestHumidity() {
                try {
                    const response = await fetch('/api/latest-humidity');
                    const data = await response.json();

                    // Update elemen card dengan data yang diambil
                    document.getElementById('latestValueHumidity').innerText = data.nilai_humidity + " %";
                    document.getElementById('lastUpdatedHumidity').innerText = "Last updated: " + new Date(data
                            .updated_at)
                        .toLocaleString();
                } catch (error) {
                    console.error('Error fetching humidity:', error);
                }
            }

            // Panggil fungsi setiap beberapa detik untuk update otomatis
            setInterval(fetchLatestHumidity, 10000); // Update setiap 10 detik

            // Panggilan awal saat halaman dimuat
            fetchLatestHumidity();
        });
    </script>
    <script>
        const socket = new WebSocket('ws://localhost:3000');

        socket.onmessage = function(event) {
            const data = JSON.parse(event.data);
            document.getElementById('latestValueTemperature').textContent = data.temperature + " °C";
            document.getElementById('latestValueHumidity').textContent = data.humidity + " %";
            document.getElementById('lastUpdatedHumidity').textContent = "Last updated: " + data.kirimdata;
            document.getElementById('lastUpdatedTemperature').textContent = "Last updated: " + data.kirimdata;
        };

        socket.onopen = function() {
            console.log('Connected to WebSocket server');
        };
    </script>
</body>

</html>
