// const WebSocket = require('ws');
// const express = require('express');
// const http = require('http');
// const cors = require('cors');
// const ExcelJS = require('exceljs');

// const app = express();
// app.use(cors());
// const server = http.createServer(app);
// const wss = new WebSocket.Server({ server });

// // Array untuk menyimpan data sementara
// let dataLog = [];

// // Buat workbook dan worksheet sekali di awal
// const workbook = new ExcelJS.Workbook();
// const worksheet = workbook.addWorksheet('Data Log');

// // Menambahkan header di worksheet
// worksheet.columns = [
//     { header: 'IdAlat', key: 'id_alat', width: 20 },
//     { header: 'Temperature', key: 'temperature', width: 15 },
//     { header: 'Humidity', key: 'humidity', width: 15 },
//     { header: 'KirimData', key: 'kirimdata', width: 20 },
//     { header: 'DataMasuk', key: 'datamasuk', width: 20 },
// ];

// // Fungsi untuk menulis data ke file Excel setiap 10 menit
// const writeToExcel = async () => {
//     if (dataLog.length > 0) {  // Hanya tulis jika ada data baru
//         dataLog.forEach((entry) => {
//             worksheet.addRow(entry);
//         });

//         // Simpan workbook ke file Excel
//         await workbook.xlsx.writeFile('data_log.xlsx');
//         console.log('Data saved to data_log.xlsx');

//         // Reset data log setelah menyimpan
//         dataLog = [];
//     } else {
//         console.log('No new data to save.');
//     }
// };

// // Update file Excel setiap 1 menit (60000 ms)
// setInterval(writeToExcel, 60000);  // 1 menit

// // Endpoint HTTP untuk menerima data dari ESP32
// app.post('/data', express.json(), (req, res) => {
//     const { id_alat, temperature, humidity, kirimdata } = req.body;
//     const now = new Date();
//     const datamasuk = now.toLocaleDateString('en-GB', { timeZone: 'Asia/Jakarta' }) + ', ' +
//         now.toLocaleTimeString('en-GB', { timeZone: 'Asia/Jakarta' }) + ':' +
//         String(now.getMilliseconds()).padStart(3, '0');  // Tambahkan milidetik 3 digit


//     // Menyimpan data ke dalam array log dengan waktu lengkap
//     dataLog.push({ id_alat, temperature, humidity, kirimdata, datamasuk });

//     // Kirim data ke semua klien WebSocket
//     wss.clients.forEach((client) => {
//         if (client.readyState === WebSocket.OPEN) {
//             client.send(JSON.stringify({ id_alat, temperature, humidity, kirimdata }));
//         }
//     });

//     res.json({ status: 'success' });
// });

// // Untuk mengetahui kapan klien terhubung
// wss.on('connection', (ws) => {
//     console.log('Client connected');
// });

// // Jalankan server pada port 3000
// server.listen(3000, () => {
//     console.log('WebSocket server running on port 3000');
// });

// ini code terbaru mas brians
const WebSocket = require('ws');
const express = require('express');
const http = require('http');
const cors = require('cors');
const ExcelJS = require('exceljs');

const app = express();
app.use(cors());
const server = http.createServer(app);
const wss = new WebSocket.Server({ server });

// Array untuk menyimpan data sementara
let dataLog = [];

// Array untuk menyimpan klien yang terkoneksi
let clients = [];
let currentIndex = 0; // Indeks untuk Round Robin

// Ukuran data yang dikirim (per entry dalam byte)
const dataSize = 26; // Sesuai dengan perhitungan sebelumnya

// Buat workbook dan worksheet sekali di awal
const workbook = new ExcelJS.Workbook();
const worksheet = workbook.addWorksheet('Data Log');

// Menambahkan header di worksheet
worksheet.columns = [
    { header: 'IdAlat', key: 'id_alat', width: 20 },
    { header: 'Temperature', key: 'temperature', width: 15 },
    { header: 'Humidity', key: 'humidity', width: 15 },
    { header: 'KirimData', key: 'kirimdata', width: 20 },
    { header: 'DataMasuk', key: 'datamasuk', width: 20 },
    { header: 'Latency (ms)', key: 'latency', width: 15 },
    { header: 'Throughput (bytes/s)', key: 'throughput', width: 20 },
];

// Fungsi untuk menghitung latency
const calculateLatency = (kirimdata, datamasuk) => {
    const kirimDate = new Date(kirimdata);
    const masukDate = new Date(datamasuk);
    return masukDate - kirimDate;
};

// Fungsi untuk menghitung throughput
const calculateThroughput = (entryCount, intervalMs) => {
    const totalDataSize = entryCount * dataSize; // Total ukuran data dalam byte
    return (totalDataSize / (intervalMs / 1000)).toFixed(2); // Throughput dalam bytes/s
};

// Fungsi untuk menulis data ke file Excel setiap 1 menit
const writeToExcel = async () => {
    if (dataLog.length > 0) {
        const startTime = Date.now();

        dataLog.forEach((entry) => {
            const latency = calculateLatency(entry.kirimdata, entry.datamasuk);
            const throughput = calculateThroughput(dataLog.length, Date.now() - startTime);
            worksheet.addRow({ ...entry, latency, throughput });
        });

        // Simpan workbook ke file Excel
        await workbook.xlsx.writeFile('data_log.xlsx');
        console.log('Data saved to data_log.xlsx');

        // Reset data log setelah menyimpan
        dataLog = [];
    } else {
        console.log('No new data to save.');
    }
};

// Update file Excel setiap 1 menit (60000 ms)
setInterval(writeToExcel, 60000); // 1 menit

// Endpoint HTTP untuk menerima data dari ESP32
app.post('/data', express.json(), (req, res) => {
    const { id_alat, temperature, humidity, kirimdata } = req.body;
    const now = new Date();
    const datamasuk = now.toLocaleDateString('en-GB', { timeZone: 'Asia/Jakarta' }) + ', ' +
        now.toLocaleTimeString('en-GB', { timeZone: 'Asia/Jakarta' }) + ':' +
        String(now.getMilliseconds()).padStart(3, '0'); // Tambahkan milidetik 3 digit

    // Menyimpan data ke dalam array log dengan waktu lengkap
    dataLog.push({ id_alat, temperature, humidity, kirimdata, datamasuk });

    // Kirim data ke klien menggunakan Round Robin
    if (clients.length > 0) {
        const client = clients[currentIndex];
        if (client.readyState === WebSocket.OPEN) {
            client.send(JSON.stringify({ id_alat, temperature, humidity, kirimdata }));
        }
        currentIndex = (currentIndex + 1) % clients.length; // Pindah ke klien berikutnya
    }

    res.json({ status: 'success' });
});

// WebSocket untuk mengetahui kapan klien terhubung
wss.on('connection', (ws) => {
    console.log('Client connected');
    clients.push(ws);

    // Hapus klien dari daftar jika koneksi terputus
    ws.on('close', () => {
        clients = clients.filter(client => client !== ws);
        console.log('Client disconnected');
    });
});

// Jalankan server pada port 3000
server.listen(3000, () => {
    console.log('WebSocket server running on port 3000');
});

