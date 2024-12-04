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

// ini kode terbaru mas brians
const WebSocket = require('ws');
const express = require('express');
const http = require('http');
const cors = require('cors');
const ExcelJS = require('exceljs');

const app = express();
app.use(cors());
const server = http.createServer(app);
const wss = new WebSocket.Server({ server });

let dataLog = [];
let clients = [];
let currentClientIndex = 0;
let totalDataSent = 0;
let totalDataReceived = 0;
let dataReceived = 0;

// Membuat workbook Excel
const workbook = new ExcelJS.Workbook();
const worksheet = workbook.addWorksheet('Data Log');

// Menambahkan header ke worksheet
worksheet.columns = [
    { header: 'IdAlat', key: 'id_alat', width: 20 },
    { header: 'Temperature', key: 'temperature', width: 15 },
    { header: 'Humidity', key: 'humidity', width: 15 },
    { header: 'KirimData', key: 'kirimdata', width: 20 },
    { header: 'DataMasuk', key: 'datamasuk', width: 20 },
    { header: 'Latency (ms)', key: 'latency', width: 15 },
    { header: 'Throughput (bytes/s)', key: 'throughput', width: 20 },
];

// Fungsi untuk menulis data ke file Excel
const writeToExcel = async () => {
    if (dataLog.length > 0) {
        dataLog.forEach((entry) => {
            worksheet.addRow(entry);
        });

        try {
            await workbook.xlsx.writeFile('data_log.xlsx');
            console.log('Data saved to data_log.xlsx');
        } catch (err) {
            console.error('Error writing to Excel:', err.message);
        }

        // Reset log untuk sesi berikutnya
        dataLog = [];
    }
};

// Update file Excel setiap menit
setInterval(writeToExcel, 60000);

// Endpoint POST untuk menerima data
app.post('/data', express.json(), (req, res) => {
    const { id_alat, temperature, humidity, kirimdata } = req.body;
    const now = new Date();
    // const datamasuk = now.toLocaleString('en-GB', { timeZone: 'Asia/Jakarta' });
    const datamasuk = now.toLocaleDateString('en-GB', { timeZone: 'Asia/Jakarta' }) + ', ' +
        now.toLocaleTimeString('en-GB', { timeZone: 'Asia/Jakarta' }) + ':' +
        String(now.getMilliseconds()).padStart(3, '0');  // Tambahkan milidetik 3 digit

    dataLog.push({
        id_alat,
        temperature,
        humidity,
        kirimdata,
        datamasuk,
        latency: 'Pending', // Diisi ketika latency dihitung
        throughput: 'Pending', // Diisi setiap 10 detik
    });

    if (clients.length > 0) {
        const client = clients[currentClientIndex];
        if (client.readyState === WebSocket.OPEN) {
            const timestamp = Date.now();
            client.send(JSON.stringify({ id_alat, temperature, humidity, kirimdata, timestamp }));

            currentClientIndex = (currentClientIndex + 1) % clients.length;
            totalDataSent += 26; // Menambahkan jumlah data yang dikirim
        }
    }

    res.json({ status: 'success' });
});

// WebSocket connection handling
wss.on('connection', (ws) => {
    console.log('Client connected');
    clients.push(ws);

    ws.on('close', () => {
        clients = clients.filter(client => client !== ws);
        console.log('Client disconnected');
    });

    ws.on('message', (message) => {
        try {
            const receivedData = JSON.parse(message);
            if (receivedData.timestamp) {
                const timestampReceived = Date.now();
                const latency = timestampReceived - receivedData.timestamp;

                console.log(`Latency: ${latency} ms`);

                // Update latency di data log terbaru
                if (dataLog.length > 0) {
                    dataLog[dataLog.length - 1].latency = latency;
                }

                totalDataReceived += 26;
                dataReceived += 26;
            } else {
                console.error('Timestamp not received in data.');
            }
        } catch (err) {
            console.error('Invalid message received:', err.message);
        }
    });
});

// Hitung throughput setiap 10 detik
setInterval(() => {
    if (dataReceived > 0) {
        const throughput = dataReceived / 10; // Hitung throughput selama 10 detik
        console.log(`Throughput (10s): ${throughput} bytes/s`);

        // Update throughput di data log terbaru
        if (dataLog.length > 0) {
            dataLog[dataLog.length - 1].throughput = throughput;
        }

        dataReceived = 0; // Reset data untuk interval berikutnya
    }
}, 10000);

// Menjalankan server
server.listen(3000, () => {
    console.log('WebSocket server running on port 3000');
});
