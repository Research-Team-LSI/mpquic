<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')

    <title>Multipath QUIC</title>
    <link href="{{ asset('images/login/logo.png') }}" rel="icon">
    <meta property="og:title" content="Gumukmas Multifarm - Kemitraan Domba dan Pakan Ternak Berkualitas">
    <meta property="og:description"
        content="Bergabunglah dengan Gumukmas Multifarm untuk kemitraan domba, pakan ternak berkualitas, dan layanan terbaik di Jember, Jawa Timur.">
    <meta name="description"
        content="Gumukmas Multifarm menyediakan kemitraan domba, domba pejantan & indukan unggul, pengadaan bahan baku pakan ternak, dan produksi pakan ternak ruminansia di Jember, Jawa Timur. Hubungi kami untuk kemitraan sukses.">
    <meta name="keywords"
        content="Gumukmas Multifarm, kemitraan domba, domba pejantan, indukan unggul, pakan ternak, ruminansia, Jember, Jawa Timur, peternakan domba, kemitraan ternak, pakan ternak berkualitas, pengadaan pakan ternak, produksi pakan ternak, domba unggul, domba berkualitas, pakan ternak ruminansia, kemitraan sukses, peternak lokal, dukungan peternak, bimbingan kemitraan, ternak produktif, domba sehat, bahan baku pakan, pakan ruminansia, domba Jember, ternak Jember, domba Jawa Timur, ternak Jawa Timur, peternak Jawa Timur, supplier pakan ternak, distributor pakan ternak, penyedia pakan ternak, pakan ternak alami, pakan ternak sehat, pakan ternak efisien, produksi pakan berkualitas, ternak sehat, ternak unggul, ternak berkualitas, peternak unggul, peternakan modern, peternakan berkelanjutan, bisnis peternakan, investasi peternakan, usaha peternakan, pakan ternak murah, pakan ternak terbaik, nutrisi ternak, kebutuhan ternak, pakan ternak alami, kemitraan domba sukses, manajemen peternakan, agribisnis, agrikultur, peternakan Indonesia, ternak Indonesia, pasar ternak, peluang peternakan, ternak ruminansia, pakan ternak komplit, komposisi pakan ternak, formulasi pakan ternak, inovasi pakan ternak, teknologi peternakan, perkembangan peternakan, kemitraan peternakan, pengembangan peternakan, jasa peternakan, layanan peternakan, komunitas peternakan, industri peternakan, jaringan peternakan, kesehatan ternak, produktivitas ternak, perawatan ternak, pengelolaan ternak, sumber daya ternak, kualitas pakan ternak, standar pakan ternak, suplai pakan ternak, solusi pakan ternak, kebutuhan pakan ternak, stok pakan ternak, bahan pakan ternak, distribusi pakan ternak, pakan ternak premium, pakan ternak grosir, peternakan modern, tren peternakan, strategi peternakan, efisiensi peternakan, peternak sukses, peluang usaha peternakan, perkembangan agribisnis, pasar agrikultur, agrikultur Jawa Timur, peluang bisnis Jember, potensi peternakan, ternak Indonesia, dukungan peternak lokal, mitra peternak, usaha ternak, pengembangan ternak, bisnis ternak, pakan ternak lokal, peternakan lokal, ternak skala kecil, ternak skala besar, peternak mandiri, mitra peternak, pengusaha ternak">
    <meta name="author" content="Gumukmas Multifarm">
</head>

<body class="bg-lwhite">
    <!-- Start Hero Section -->
    <section id="hero" class="flex flex-col min-h-screen text-white bg-center bg-cover bg-blend-overlay "
        style="background-image: url('{{ asset('images/landingpage/background.png') }}')">
        <div class="container">
            @livewire('components.header')
        </div>
        <div class="container">
            <div class="mx-auto p-4 md:py-8">
                <div class="flex-1 flex items-center">
                    <div class="text-center mx-auto">
                        <h1 class="text-h3 font-bold text-white md:text-h2 lg:text-h1">Peningkatan Kualitas Layanan Transmisi Data IoT Menggunakan Optimasi Protokol MP-QUIC </h1>
                        {{-- <h1 class="text-h3 font-bold text-white md:text-h2 lg:text-h1">Multipath QUIC (MP-QUIC)</h1> --}}
                        <p class="text-title2 text-text mb-7">
                            Jember,
                            Jawa
                            Timur, Indonesia</p>
                        <a href="{{ route('login') }}"
                            class="py-3 px-9 text-title2 text-lwhite rounded-xl hover:bg-blue-700"
                            style="background-color: #FCA311">Mulai Aplikasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Section -->

    <!-- Start About Section -->
    <section id="about" class="pt-24 pb-16">
        <div class="container mx-auto">
            <div class="flex flex-col md:flex-row items-center sm:pt-4 md:px-0">
                <div class="order-2 md:order-1 w-full md:w-2/5 flex justify-center md:justify-start md:mb-0">
                    <img src="{{ asset('images/landingpage/tentang.png') }}" alt="About Image"
                        class="max-w-full h-auto object-cover">
                </div>
                <div class="order-1 mb-16 md:order-2 w-full md:w-3/5 md:pl-4">
                    <h2 class="text-h3 font-bold mb-4 xl:text-h2" style="color: #001D3D">Tentang Multipath QUIC</h2>
                    <p class="text-body text-tblack leading-relaxed mb-12 xl:text-title2">
                        Multipath QUIC (MPQUIC) adalah ekstensi dari protokol Quick UDP Internet Connections (QUIC) yang
                        memperkenalkan kemampuan multipath dalam transmisi data.
                        MPQUIC meningkatkan kemampuan QUIC dengan memungkinkan penggunaan beberapa jalur jaringan secara
                        bersamaan, memungkinkan paket data ditransmisikan melalui berbagai antarmuka jaringan secara
                        paralel.
                    </p>
                    <a href="{{ route('login') }}"
                        class="py-3 px-9 mb-8 bg-orange text-title2 text-lwhite rounded-xl hover:bg-orange/80">Mulai
                        Aplikasi</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

    {{-- Start Service section --}}
    <section id="service" class="py-4 md:py-16 relative">
        <div class="container mx-auto relative z-10">
            <div class="flex flex-col md:flex-row items-center sm:px-4">
                <div class="w-full md:w-1/2 order-1 mt-4">
                    <h2 class="text-h3 font-bold mr-4 mb-4 xl:text-h2" style="color: #001D3D">Tahapan Penelitian MP QUIC
                    </h2>
                    <p class="text-body font-bold text-orange mb-6 leading-relaxed xl:text-title2">Apa saja tahapan yang
                        kami lakukan?
                    </p>
                </div>
                <div class="w-full md:w-1/2 order-2">
                    <p class="text-body text-tblack leading-relaxed md:text-lwhite md:pl-8 xl:text-title2">
                        Kami melakukan tahapan untuk implementasi Multipath QUIC (MPQUIC) melalui tahapan terstruktur.
                        Dimulai dengan analisis kebutuhan jaringan, diikuti oleh perancangan protokol sesuai kondisi
                        operasional. Implementasi dilakukan secara bertahap, dengan integrasi AI untuk optimasi
                        performa, dan diakhiri dengan pengujian untuk memastikan protokol memenuhi standar kecepatan,
                        latensi, dan packet loss. Kami berkomitmen memberikan solusi terbaik untuk optimalisasi jaringan
                        Anda. </p>
                </div>
            </div>
        </div>

        <div class="hidden md:flex absolute top-0 right-0 w-1/2 mt-9 h-80 items-center justify-center z-0"
            style="background-image: url('{{ asset('images/footer/footer.png') }}'); background-color: #001D3D">
        </div>

        <div class="container flex items-center mt-8 justify-center mx-auto relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Service 1 --}}
                <a class="service-card rounded-xl shadow-lg px-6 py-8 bg-white block">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full overflow-hidden p-4 shadow-md flex items-center justify-center">
                            <img class="h-auto" src="{{ asset('images/landingpage/tahap1.png') }}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <p class="text-title2 text-center  mt-6 font-bold" style="color: #001D3D">Tahap Perencanaan
                            </p>
                            <p class="text-body text-tblack mt-4 leading-relaxed">
                                Penelitian dimulai dengan survei lapangan untuk mengidentifikasi kebutuhan jaringan
                                mitra, berfokus pada kecepatan, delay, latensi, dan packet loss, serta FGD untuk
                                memastikan protokol MPQUIC sesuai kebutuhan industri. </p>
                        </div>
                    </div>
                </a>
                {{-- Service 2 --}}
                <a href="https://www.youtube.com/watch?v=rjs8j9z7uIE"
                    class="service-card rounded-xl shadow-lg px-6 py-8 bg-white block">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full overflow-hidden p-4 shadow-md flex items-center justify-center">
                            <img class="h-auto" src="{{ asset('images/landingpage/tahap2.png') }}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <p class="text-title2 text-center  mt-6 font-bold" style="color: #001D3D">Tahap Perancangan
                            </p>
                            <p class="text-body text-tblack mt-4 leading-relaxed">
                                Setelah data terkumpul, perancangan protokol MPQUIC untuk aplikasi Brotani dimulai,
                                meliputi perangkat keras dan lunak, dengan integrasi AI untuk optimasi data ke cloud
                                serta dukungan jaringan regional. </p>
                        </div>
                    </div>
                </a>
                {{-- Service 3 --}}
                <a class="service-card rounded-xl shadow-lg px-6 py-8 bg-white block">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full overflow-hidden p-4 shadow-md flex items-center justify-center">
                            <img class="h-auto" src="{{ asset('images/landingpage/tahap3.png') }}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <p class="text-title2 text-center mt-6 font-bold" style="color: #001D3D">Tahap Implementasi
                            </p>
                            <p class="text-body text-tblack mt-4 leading-relaxed">
                                Setelah perancangan selesai, implementasi bertahap protokol MPQUIC dimulai di greenhouse
                                mitra dan laboratorium untuk uji fungsionalitas. Selanjutnya, AI ditambahkan untuk
                                optimasi performa, dan implementasi diperluas ke skala regional di Jawa Timur.
                            </p>
                        </div>
                    </div>
                </a>
                {{-- Service 4 --}}
                <a class="service-card rounded-xl shadow-lg px-6 py-8 bg-white block">
                    <div class="flex flex-col items-center">
                        <div class="rounded-full overflow-hidden p-4 shadow-md flex items-center justify-center">
                            <img class="h-auto" src="{{ asset('images/landingpage/tahap4.png') }}" alt="">
                        </div>
                        <div class="flex flex-col">
                            <p class="text-title2 text-center  mt-6 font-bold" style="color: #001D3D">Tahap Pengujian
                            </p>
                            <p class="text-body text-tblack mt-4 leading-relaxed">
                                Pengujian protokol MPQUIC mencakup UAT, White Box, dan Black Box Testing di fasilitas
                                mitra dan laboratorium, dengan fokus pada performa AI serta kecepatan, latensi, dan
                                packet loss sesuai standar internasional.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    {{-- End Service section --}}

    {{-- Start Section Testimonial --}}

    {{-- End Section Testimonial --}}

    <section id="blog" class="py-16 relative">
        <div class="container mx-auto relative z-10">
            <div class="flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-h2 font-bold xl:text-h1" style="color: #001D3D">Blog</h1>
                    <h1 class="text-h2 font-bold xl:text-h1" style="color: #001D3D">Multipath QUIC</h1>
                </div>
            </div>
        </div>
        <!-- New Layout Section -->
        <div class="container mx-auto mt-12">
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1 mb-8 md:mb-0">
                    <a href="#">
                        <div
                            class="rounded-xl mb-6 shadow-lg bg-transparent flex-shrink-0 w-full hover:bg-white transition ease-in-out duration-300 transform hover:scale-105">

                            <div class="rounded-xl shadow-sm overflow-hidden">
                                <img src="{{ asset('images/blog/blog1.png') }}" alt="" class="w-full">
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-6">
                                    <img src="{{ asset('images/blog/clock.png') }}" class="w-4 h-4">
                                    <p class="text-body flex px-2">11 November 2024</p>
                                </div>
                                <p class="text-title2 font-bold mb-6">Keunggulan Multipath QUIC dalam Mengoptimalkan
                                    Performa Jaringan</p>
                                <p class="text-body mb-8">Teknologi Multipath QUIC menghadirkan performa jaringan yang
                                    lebih andal dan cepat. Artikel ini mengeksplorasi keunggulan utama dari Multipath
                                    QUIC,</p>
                                <div class="flex items-center">
                                    <a href="" class="text-title2 font-bold underline">Baca Selengkapnya</a>
                                    <img src="{{ asset('images/blog/arrow.png') }}" class="w-5 h-4 ml-2"
                                        alt="">
                                </div>
                            </div>
                        </div>

                    </a>
                </div>
                <div class="flex-1 mb-8 md:mb-0">
                    <a href="#">
                        <div
                            class="rounded-xl mb-6 shadow-lg bg-transparent flex-shrink-0 w-full hover:bg-white transition ease-in-out duration-300 transform hover:scale-105">
                            <div class="rounded-xl shadow-sm overflow-hidden">
                                <img src="{{ asset('images/blog/blog2.png') }}" alt="" class="w-full">
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-6">
                                    <img src="{{ asset('images/blog/clock.png') }}" class="w-4 h-4">
                                    <p class="text-body flex px-2">11 November 2024</p>
                                </div>
                                <p class="text-title2 font-bold mb-6">Pengenalan Multipath QUIC: Teknologi Baru untuk
                                    Konektivitas Lebih Cepat</p>
                                <p class="text-body mb-8">Multipath QUIC adalah pengembangan terbaru dari protokol QUIC
                                    yang memungkinkan penggunaan beberapa jalur koneksi dalam satu sesi. </p>
                                <div class="flex items-center">
                                    <a href="" class="text-title2 font-bold underline">Baca Selengkapnya</a>
                                    <img src="{{ asset('images/blog/arrow.png') }}" class="w-5 h-4 ml-2"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex-1 mb-8 md:mb-0">
                    <!-- Artikel Pertama -->
                    <a href="http://">
                        <div
                            class="rounded-xl mb-6 shadow-lg bg-transparent flex-shrink-0 w-full hover:bg-white transition ease-in-out duration-300 transform hover:scale-105">
                            <div class="flex flex-row items-center">
                                <img src="{{ asset('images/blog/blog3.png') }}" class="rounded-xl w-32 h-28"
                                    alt="">
                                <div class="mx-3">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/blog/clock.png') }}" class="w-4 h-4">
                                        <p class="text-body flex px-2">11 November 2024</p>
                                    </div>
                                    <p class="text-body font-bold mt-2">Bagaimana Multipath QUIC Membantu Mengatasi
                                        Gangguan Jaringan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Artikel Kedua -->
                    <a href="http://" class="">
                        <div
                            class="rounded-xl mb-6 shadow-lg bg-transparent flex-shrink-0 w-full hover:bg-white transition ease-in-out duration-300 transform hover:scale-105">
                            <div class="flex flex-row items-center">
                                <img src="{{ asset('images/blog/blog4.png') }}" class="rounded-xl w-32 h-28"
                                    alt="">
                                <div class="mx-3">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/blog/clock.png') }}" class="w-4 h-4">
                                        <p class="text-body flex px-2">11 November 2024</p>
                                    </div>
                                    <p class="text-body font-bold mt-2">Studi Kasus Implementasi Multipath QUIC pada
                                        Aplikasi Mobile</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Artikel Ketiga -->
                    <a href="">
                        <div
                            class="rounded-xl mb-6 shadow-lg bg-transparent flex-shrink-0 w-full hover:bg-white transition ease-in-out duration-300 transform hover:scale-105">
                            <div class="flex flex-row items-center">
                                <img src="{{ asset('images/blog/blog5.png') }}" class="rounded-xl w-32 h-28"
                                    alt="">
                                <div class="mx-3">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/blog/clock.png') }}" class="w-4 h-4">
                                        <p class="text-body flex px-2">11 November 2024</p>
                                    </div>
                                    <p class="text-body font-bold mt-2">Masa Depan Multipath QUIC dan Pengaruhnya
                                        terhadap Teknologi Jaringan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <script>
        document.getElementById('prev-btn').addEventListener('click', function() {});

        document.getElementById('next-btn').addEventListener('click', function() {});
    </script>
    @livewire('components.footer')
    @vite('resources/js/app.js')
    <script src="{{ asset('assets/script.js') }}"></script>
</body>

</html>
