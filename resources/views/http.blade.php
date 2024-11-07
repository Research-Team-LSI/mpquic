<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @vite('resources/css/app.css')
</head>

<body class="flex flex-col h-screen" style="background-color: #f3f4f6;">
    <div class="flex h-screen">
        <aside class="text-white w-52 flex-shrink-0 hidden lg:block "
            style="background-color: #001D3D; background-image: url('{{ asset('images/login/pattern.png') }}');">
            <div class="flex items-center justify-between pt-8 pb-4">
                <a class="flex items-center justify-center w-full" href="#">
                    <div class="flex-1 flex justify-center items-center">
                        <div>
                            <img src="{{ asset('images/login/logo.png') }}"
                                class="inline h-5 w-8 transition-all duration-200 ease-nav-brand" alt="main_logo" />
                        </div>
                        <div class="ml-2">
                            <span class="block font-semibold text-lwhite transition-all text-body duration-200 mr-4">MP
                                QUIC</span>
                            {{-- <span
                                class="block font-semibold text-lwhite transition-all text-body duration-200 mr-4">MULTIFARM</span> --}}
                        </div>
                    </div>
                </a>
            </div>
            <nav class="px-2 py-2">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center block py-2 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0z" />
                                <path
                                    d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                <path
                                    d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                            </svg>
                            Monitoring
                        </a>
                    </li>
                    <li>
                        <a type="button"
                            class="flex items-center block py-2 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200"
                            aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1" />
                            </svg>
                            Rekam Data<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <ul id="dropdown-example" class="hidden">
                            <li>
                                <a href="{{ route('riwayat.temperature') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    Temperature
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('riwayat.humidity') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    Humidity
                                </a>
                            </li>

                            {{-- <li>
                                <a href="{{ route('riwayat.amonia') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-green-600 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    Amonia
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a href="{{ route('riwayat.metana') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-green-600 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    Metana
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a href="{{ route('riwayat.dioksida') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-green-600 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    Karbon Dioksida
                                </a>
                            </li> --}}
                        </ul>
                    </li>

                    {{-- Analisis --}}
                    <li>
                        <a type="button"
                            class="flex items-center block py-2 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200"
                            aria-controls="dropdown-analisis" data-collapse-toggle="dropdown-analisis">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5M5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1m0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1" />
                            </svg>
                            Analisis Data<svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </a>
                        <ul id="dropdown-analisis" class="hidden">
                            <li>
                                <a href="{{ route('http') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    Http
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mpquic') }}"
                                    class="flex items-center block mx-2 py-1 text-white text-body hover:text-blue-950 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                    MP QUIC
                                </a>
                            </li>

                        </ul>
                    </li>
                    @if (Auth::user()->role == 'admin')
                        {{-- <li>
                            <a href="{{ route('karyawan') }}"
                                class="flex items-center block py-2 text-white text-body hover:text-green-600 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path
                                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                                </svg>
                                Data Karyawan
                            </a>
                        </li> --}}
                    @else
                    @endif
                    {{-- <li>
                        <a href="{{ route('blog') }}"
                            class="flex items-center block py-2 text-white text-body hover:text-green-600 hover:bg-gray-100 rounded-lg px-3 mb-3 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5" />
                                <path
                                    d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                                <path
                                    d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                            </svg>
                            Blog
                        </a>
                    </li> --}}
                </ul>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 p-4 shadow-lg">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="text-lg font-semibold text-gray-800 mr-2"></div>
                    </div>
                    <div class="flex-grow border-l border-gray-200 mx-4"></div>
                    <div class="relative flex items-center">
                        <div class="border-l border-gray-300 h-6 mr-6"></div>
                        <div>
                            <span class="block text-xs text-gray-600">{{ Auth::user()->name }}</span>
                        </div>
                        <button onclick="toggleDropdown(event)" class="flex items-center focus:outline-none ml-2">
                            <img src="https://via.placeholder.com/40" alt="Profile" class="w-8 h-8 rounded-full">
                        </button>
                        <div id="profileDropdown"
                            class="origin-top-right absolute right-0 mt-40 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 hidden">
                            <a href="{{ route('profile') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            {{-- <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a> --}}
                            @livewire('components.logout-button')
                        </div>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-y-auto p-4">
                <div class="bg-white shadow-lg rounded-lg mb-4">
                    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                        <h6 class="m-0 font-semibold text-gray-700">Http</h6>
                        {{-- <a href="#" id="export-btn"
                            class="py-1 px-3 text-body font-semibold text-lwhite rounded-md flex items-center space-x-2" style="background-color: #001D3D">

                            <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                            </svg>
                            <span>Export</span>
                        </a> --}}
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
                                                <svg data-popover-target="clicks-info" data-popover-placement="bottom"
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
                                                            Kecepatan
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
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 6 10">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 9 4-4-4-4" />
                                                            </svg></a>
                                                    </div>
                                                    <div data-popper-arrow></div>
                                                </div>
                                            </h5>
                                            <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">
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
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 6 10">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 9 4-4-4-4" />
                                                            </svg></a>
                                                    </div>
                                                    <div data-popper-arrow></div>
                                                </div>
                                            </h5> --}}
                                            {{-- <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">
                                                32°C</p> --}}
                                        </div>
                                    </div>
                                    <div>
                                        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown"
                                            data-dropdown-placement="bottom" type="button"
                                            class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Last
                                            week <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
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
                                <div
                                    class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
                                    <div class="pt-5">
                                        <a href="#"
                                            class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 16 20">
                                                <path
                                                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z" />
                                                <path
                                                    d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                            </svg>
                                            View full report
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="gap-4">
                            <div class="bg-white shadow-lg rounded-lg mb-4">
                                <div
                                    class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                                    <h6 class="m-0 font-semibold text-gray-700">Analisis Data</h6>

                                </div>
                                <div class="px-8 py-8">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table
                                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-white uppercase bg-yellow-300 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Id
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Microcontroller
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Protocol Type
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Delivery Time
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Receiving Time
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Delay Time
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
                                                        MP QUIC
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
                                                </tr>
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
                                                        10.10.00
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        10.11.00
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        00.01.00
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

            </main>
            <footer class="bg-white border-t border-gray-200 p-4 shadow-md mt-auto">
                <div class="flex items-center justify-center">
                    <p class="text-sm text-gray-500">&copy; 2024 MP QUIC</p>
                </div>
            </footer>
            <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="logout" value="true">
            </form>
        </div>
    </div>
    @vite('resources/js/app.js')
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#export-btn').click(function() {
                var start = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                var end = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');

                window.location.href = '{{ route('export.temperature') }}?createFrom=' + start + '&createTo=' +
                    end;
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            var start_date = moment().subtract(6, 'days');
            var end_date = moment();

            // Variabel untuk menyimpan referensi chart
            var myChart = null;

            $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

            // Fungsi untuk memperbarui chart
            function updateChart(labels, data) {
                var ctx = document.getElementById('myChart').getContext('2d');

                // Hancurkan chart lama jika ada
                if (myChart !== null) {
                    myChart.destroy();
                }

                // Buat chart baru
                myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Temperature Levels',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Fungsi untuk mendapatkan data berdasarkan rentang tanggal
            function fetchData(start, end) {
                $.ajax({
                    url: '{{ route('data.riwayattemperature') }}',
                    method: 'POST',
                    data: {
                        createFrom: start.format('YYYY-MM-DD'),
                        createTo: end.format('YYYY-MM-DD'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        updateChart(response.labels, response.data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Panggil fetchData saat halaman pertama kali dimuat
            fetchData(start_date, end_date);

            $('#daterange').daterangepicker({
                startDate: start_date,
                endDate: end_date,
                locale: {
                    format: 'MMMM D, YYYY'
                }
            }, function(start, end) {
                $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));
                fetchData(start, end);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var dropdown = document.getElementById('profileDropdown');

        function toggleDropdown(event) {
            event.stopPropagation();
            dropdown.classList.toggle('hidden');
        }
        document.body.addEventListener('click', function(event) {
            if (!event.target.closest('#profileDropdown') && !event.target.closest(
                    'button[onclick="toggleDropdown(event)"]')) {
                dropdown.classList.add('hidden');
            }
        });
    </script> --}}

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
                    name: "Kecepatan",
                    data: [6500, 6418, 6456, 6526, 6356, 6456],
                    color: "#1A56DB",
                },
                // {
                //     name: "Temperature",
                //     data: [6456, 6356, 6526, 6332, 6418, 6500],
                //     color: "#7E3AF2",
                // },
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
