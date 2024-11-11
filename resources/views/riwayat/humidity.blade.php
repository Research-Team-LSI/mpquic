<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Humidity</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="flex flex-col h-screen" style="background-color: #f3f4f6;">
    <div class="flex h-screen">
        @livewire('partials.sidebar')
        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @livewire('partials.header')
            <main class="flex-1 overflow-y-auto p-4">
                <div class="bg-white shadow-lg rounded-lg mb-4">
                    <div class="flex justify-between items-center px-4 py-3 border-b border-gray-200 bg-gray-50">
                        <h6 class="m-0 font-semibold text-gray-700">Riwayat Humidity</h6>
                        <a href="#" id="export-btn" style="background-color: #001D3D"
                            class="py-1 px-3 text-body font-semibold text-lwhite rounded-md flex items-center space-x-2">
                            <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                            </svg>
                            <span>Export</span>
                        </a>
                    </div>
                    <div class="px-4 pb-4">
                        <div class="overflow-x-auto mt-4">
                            <div class="flex items-end justify-end">
                                <div id="daterange" style="background-color: #001D3D"
                                    class="py-2 px-3 text-body font-semibold text-lwhite rounded-md flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm14-7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm-5-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1ZM20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4Z" />
                                    </svg>
                                    <span></span>
                                </div>
                            </div>
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Card --}}
                <div class="flex items-start justify-start min-h-screen">
                    <div class="shadow-lg rounded-lg w-96 p-6" style="background-color: #001D3D">
                        <h3 class="text-center text-lg font-normal text-white">Kelembapan Optimal</h3>
                        <p class="text-center text-white pt-2">45% - 55%</p>
                        <p class="text-center text-white font-thin pt-2">%</p>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#export-btn').click(function() {
                var start = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                var end = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');

                window.location.href = '{{ route('export.humidity') }}?createFrom=' + start + '&createTo=' +
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
                            label: 'Humidity Levels',
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
                    url: '{{ route('data.riwayathumidity') }}',
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
    </script>
</body>

</html>
