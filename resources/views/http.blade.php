<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTTP</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="">
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
                <div class="gap-4">
                    <div class="bg-white shadow-lg rounded-lg mb-4">
                        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <h6 class="m-0 font-semibold text-gray-700">HTTP</h6>

                            <a href="{{ route('export.http') }}" id="export-btn" style="background-color: #001D3D"
                            class="py-1 px-3 text-body font-semibold text-white rounded-md flex items-center space-x-2">
                             <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                       d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                             </svg>
                             <span>Export</span>
                         </a>

                        </div>
                        <div class="px-8 py-8">
                            <div class="grid gap-4 grid-cols-1">
                                <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                                    <div class="flex justify-between mb-5">
                                        <div class="grid gap-4 grid-cols-2">
                                            <div>
                                                <h5
                                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2 ">
                                                    Kecepatan
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
                                                                Humidity
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
                                                $lastData = $alat->last()->data->last();
                                                $kecepatan = $lastData ? $lastData->throughput : 'N/A';
                                                ?>
                                                <p
                                                    class="text-gray-900 dark:text-white text-2xl leading-none font-bold">
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
                                        <div>
                                            <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                                data-dropdown-placement="bottom" type="button"
                                                class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Last week
                                            </button>
                                            <div id="lastDaysdropdown"
                                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownDefaultButton">
                                                    <li><a data-filter="yesterday" class="filter-option">Yesterday</a>
                                                    </li>
                                                    <li><a data-filter="today" class="filter-option">Today</a></li>
                                                    <li><adata-filter="last_7_days"
                                                    class="filter-option">Last 7 days</a></li>
                                                    <li><a data-filter="last_30_days" class="filter-option">Last 30
                                                            days</a></li>
                                                    <li><a data-filter="last_90_days" class="filter-option">Last 90
                                                            days</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="gap-4">
                    <div class="bg-white shadow-lg rounded-lg mb-4">
                        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                            <h6 class="m-0 font-semibold text-gray-700">Analisis Data</h6>
                        </div>
                        <div class="px-8 py-8">
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                                {{-- ini tabel baru --}}
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-white uppercase dark:bg-gray-700 dark:text-gray-400"
                                        style="background-color: #001D3D">
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
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $item->id_alat }}
                                                </th>
                                                <td class="px-6 py-4">{{ $item->protocol }}</td>
                                                <td class="px-6 py-4">{{ $item->microcontroller }}</td>
                                                <td class="px-6 py-4">{{ $item->mac_address }}</td>
                                                <td class="px-6 py-4">{{ $item->ip_address }}</td>
                                                <td class="px-6 py-4">
                                                    @foreach ($item->data as $data)
                                                        <div>{{ $data->throughput }}</div>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4">
                                                    @foreach ($item->data as $data)
                                                        <div>{{ $data->latency }}</div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{-- pagination baru --}}
                                <div class="mt-4 flex items-center justify-between">
                                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing
                                        <span
                                            class="font-semibold text-gray-900 dark:text-white">{{ $alat->firstItem() }}-{{ $alat->lastItem() }}</span>
                                        of
                                        <span
                                            class="font-semibold text-gray-900 dark:text-white">{{ $alat->total() }}</span>
                                    </span>

                                    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                        @if ($alat->onFirstPage())
                                            <li>
                                                <span
                                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-gray-200 border border-gray-300 rounded-s-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Previous</span>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ $alat->previousPageUrl() }}"
                                                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                            </li>
                                        @endif

                                        @foreach ($alat->getUrlRange(1, $alat->lastPage()) as $page => $url)
                                            @if ($page == $alat->currentPage())
                                                <li>
                                                    <span aria-current="page"
                                                        class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ $url }}"
                                                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        @if ($alat->hasMorePages())
                                            <li>
                                                <a href="{{ $alat->nextPageUrl() }}"
                                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                            </li>
                                        @else
                                            <li>
                                                <span
                                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-gray-200 border border-gray-300 rounded-e-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">Next</span>
                                            </li>
                                        @endif
                                    </ul>
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
            fetch('/throughput-data')
                .then(response => response.json())
                .then(apiData => {
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
                        series: [{
                            name: "Throughput",
                            data: apiData.data,
                            color: "#FCA311",
                        }],
                        legend: {
                            show: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        xaxis: {
                            categories: apiData.timestamps,
                            labels: {
                                show: true,
                                style: {
                                    fontFamily: "Inter, sans-serif",
                                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                                }
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


            // const chartElement = document.getElementById("line-chart");
            // let chart;

            // function renderChart(data, timestamps) {
            //     const options = {
            //         chart: {
            //             type: "line",
            //             height: "100%",
            //             maxWidth: "100%"
            //         },
            //         series: [{
            //             name: "Throughput",
            //             data
            //         }],
            //         xaxis: {
            //             categories: timestamps
            //         }
            //     };
            //     if (chart) {
            //         chart.updateOptions(options);
            //     } else {
            //         chart = new ApexCharts(chartElement, options);
            //         chart.render();
            //     }
            // }

            // function fetchChartData(filter) {
            //     fetch(`/throughput-data?date_filter=${filter}`)
            //         .then(response => response.json())
            //         .then(apiData => renderChart(apiData.data, apiData.timestamps));
            // }

            // document.querySelectorAll('.filter-option').forEach(option => {
            //     option.addEventListener('click', (e) => {
            //         e.preventDefault();
            //         const filter = option.getAttribute('data-filter');
            //         fetchChartData(filter);
            //     });
            // });

            // // Render initial chart data (e.g., last week)
            // fetchChartData('last_7_days');
        });
    </script>


</body>

</html>
