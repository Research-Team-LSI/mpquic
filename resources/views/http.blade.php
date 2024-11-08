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
                                                <p
                                                    class="text-gray-900 dark:text-white text-2xl leading-none font-bold">
                                                    43 Bps</p>
                                            </div>
                                            <div>
                                                {{-- <h5
                                                    class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                                                    Temperature
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
                                                                Temperature
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
                                                <p
                                                    class="text-gray-900 dark:text-white text-2xl leading-none font-bold">
                                                    32°C</p> --}}
                                            </div>
                                        </div>
                                        <div>
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
                                        </div>
                                    </div>
                                    <div id="line-chart"></div>
                                    {{-- <div
                                        class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                                        <div class="pt-5">
                                            <a href="#"
                                                class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="currentColor" viewBox="0 0 16 20">
                                                    <path
                                                        d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                                    <path
                                                        d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                                </svg>
                                                View full report
                                            </a>
                                        </div>
                                    </div> --}}
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
                                <table
                                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-xs text-white uppercase dark:bg-gray-700 dark:text-gray-400" style="background-color: #001D3D">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Id
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Jenis Protokol
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Microcontroller
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Mac Address
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                IP Address
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Throughput
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Latency
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                101
                                            </th>
                                            <td class="px-6 py-4">
                                                ESP32-321231
                                            </td>
                                            <td class="px-6 py-4">
                                                HTTP
                                            </td>
                                            <td class="px-6 py-4">
                                                10.00.10
                                            </td>
                                            <td class="px-6 py-4">
                                                10.01.00
                                            </td>
                                            <td class="px-6 py-4">
                                                00.00.50
                                            </td>
                                            <td class="px-6 py-4">
                                                00.00.50
                                            </td>
                                        </tr>
                                        <tr
                                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                102
                                            </th>
                                            <td class="px-6 py-4">
                                                ESP32-321231
                                            </td>
                                            <td class="px-6 py-4">
                                                HTTP
                                            </td>
                                            <td class="px-6 py-4">
                                                10.10.00
                                            </td>
                                            <td class="px-6 py-4">
                                                10.11.00
                                            </td>
                                            <td class="px-6 py-4">
                                                00.01.00
                                            </td>
                                            <td class="px-6 py-4">
                                                00.00.50
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4 pb-4 ml-8 mr-5"
                                    aria-label="Table navigation">
                                    <span
                                        class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing
                                        <span class="font-semibold text-gray-900 dark:text-white">1-10</span> of
                                        <span class="font-semibold text-gray-900 dark:text-white">1000</span></span>
                                    <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                        </li>
                                        <li>
                                            <a href="#" aria-current="page"
                                                class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                        </li>
                                    </ul>
                                </nav>
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
                    name: "Humidity",
                    data: [6500, 6418, 6456, 6526, 6356, 6456],
                    color: "#FCA311",
                },
                //{
                    //name: "Temperature",
                    //data: [6456, 6356, 6526, 6332, 6418, 6500],
                    //color: "#7E3AF2",
                //},
            ],
            legend: {
                show: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb'],
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
        }

        if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
            const chart1 = new ApexCharts(document.getElementById("line-chart"), options1);
            chart1.render();
        };
    </script>
</body>

</html>
