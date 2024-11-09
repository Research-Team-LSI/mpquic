<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    // Menampilkan daftar alat
    public function index()
    {
        $alat = Alat::all();
        return view('dashboard', compact('alat'));
    }

    // Menampilkan form tambah alat
    // public function create()
    // {
    //     return view('alat.create');
    // }

    // Menyimpan data alat baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'protocol' => 'required|in:http,mpquic',
            'microcontroller' => 'required|in:esp32,esp8266,raspberrypi',
            'mac_address' => 'required|string|max:20',
            'ip_address' => 'required|string|max:16',
        ]);

        // Simpan data ke tabel alat
        Alat::create([
            'protocol' => $request->protocol,
            'microcontroller' => $request->microcontroller,
            'mac_address' => $request->mac_address,
            'ip_address' => $request->ip_address,
        ]);

        return redirect()->route('dashboard')->with('success', 'Data alat berhasil ditambahkan.');
    }
}
