<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalkategori = Kategori::count();
        $barangDipinjam = Transaksi::where('status', 'dipinjam')->count();
        $barangTersedia = Barang::sum('jumlah');
        $transaksiTerbaru = Transaksi::with(['user', 'barang'])->latest()->take(5)->get();
        $barangStokMenipis = Barang::where('jumlah', '<', 5)->with('kategori')->take(5)->get();

        return view('dashboard', compact(
            'totalBarang',
            'totalkategori',
            'barangDipinjam',
            'barangTersedia',
            'transaksiTerbaru',
            'barangStokMenipis'
        ));
    }
}