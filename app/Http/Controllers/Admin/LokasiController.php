<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
{
    //get
    public function getLokasi()
    {
        $lokasi = DB::table('lokasi')
            ->get();

        $status = DB::table('status')
            ->where('redacted', '=', 0)
            ->rightJoin('alamat', 'alamat_ht', '=', 'alamat.alamat')
            ->select('alamat.lokasi')
            ->get();

        $dataLokasi = [
            'lokasi' => $lokasi,
            'status' => $status
        ];

        return view('admin.index', $dataLokasi);
    }

    public function getTableLokasi()
    {
        $lokasi = DB::table('lokasi')
            ->orderBy('lokasi')
            ->get();

        $alamat = DB::table('alamat')
            ->Join('lokasi', 'alamat.lokasi', '=', 'lokasi.lokasi')
            ->select('alamat.id', 'alamat', 'alamat.lokasi', 'lokasi.wilayah')
            ->orderBy('lokasi.lokasi')
            ->get();

        $getTableLokasi = [
            'alamat' => $alamat,
            'lokasi' => $lokasi
        ];

        return (view('admin.pages.lokasi-table', $getTableLokasi));
    }

    public function getTableAlamat()
    {
        $alamat = DB::table('alamat')
            ->where('lokasi', $_GET['lokasi'])
            ->get();

        $lokasi_status = DB::table('status')
            ->where('redacted', '=', 0)
            ->select('alamat_ht')
            ->get();

        $dataAlamat = [
            'alamat' => $alamat,
            'lokasi_status' => $lokasi_status
        ];

        return (view('admin.pages.dataAlamat-table', $dataAlamat));
    }

    //Insert Tambah Lokasi
    public function tambahLokasi(Request $request)
    {
        DB::table('lokasi')
            ->insert([
                'lokasi' => $request->lokasi,
                'wilayah' => $request->wilayah
            ]);

        return back();
    }

    //Insert Tambah Alamat
    public function tambahAlamat(Request $request)
    {
        DB::table('alamat')
            ->insert([
                'alamat' => $request->alamat,
                'lokasi' => $request->lokasi
            ]);

        return back();
    }


    //Update Lokasi
    public function updateLokasi(Request $request)
    {
        DB::table('alamat')
            ->rightJoin('lokasi', 'alamat.lokasi', '=', 'lokasi.lokasi')
            ->where('alamat.id', $request->id_lokasi_update)
            ->update([
                'alamat.alamat' => $request->alamat_update,
                'alamat.lokasi' => $request->lokasi_update
            ]);

        return back();
    }
}
