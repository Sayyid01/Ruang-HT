<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class LokasiController extends Controller
{
    //get
    public function getLokasi()
    {
        $lokasi = DB::table('lokasi')
            ->get();

        try {
            $status = DB::table('status')
                ->where('redacted', '=', 0)
                ->rightJoin('alamat', 'status.id_alamat', '=', 'alamat.id')
                ->select('alamat.id_lokasi', 'status.status')
                ->get();
        } catch (Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1054) {
                $status = DB::table('status')
                    ->get();
            }
        }

        $dataLokasi = [
            'lokasi' => $lokasi,
            'status' => $status
        ];

        return view('index', $dataLokasi);
    }

    public function getTableLokasi()
    {
        $lokasi = DB::table('lokasi')
            ->orderBy('lokasi')
            ->get();

        $alamat = DB::table('alamat')
            ->Join('lokasi', 'alamat.id_lokasi', '=', 'lokasi.id')
            ->select('alamat.id', 'nama_kantor', 'alamat', 'alamat.id_lokasi', 'lokasi.lokasi', 'lokasi.wilayah')
            ->orderBy('lokasi.lokasi')
            ->get();

        $getTableLokasi = [
            'alamat' => $alamat,
            'lokasi' => $lokasi
        ];

        return (view('pages.lokasi-table', $getTableLokasi));
    }

    public function getTableAlamat()
    {
        $id_lokasi = $_GET['lokasi'];
        try {
            $alamat = DB::table('alamat')
                ->where('alamat.id_lokasi', $id_lokasi)
                ->get();

            $lokasi = DB::table('lokasi')
                ->where('id', $id_lokasi)
                ->select('id', 'lokasi')
                ->first();

            $status = DB::table('status')
                ->where('redacted', '=', 0)
                ->select('id_alamat')
                ->get();
        } catch (Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1054) {
                $alamat = DB::table('alamat')
                    ->get();

                $lokasi = DB::table('lokasi')
                    ->where('id', $id_lokasi)
                    ->select('id', 'lokasi')
                    ->first();

                $status = DB::table('status')
                    ->get();
            }
        }

        $dataAlamat = [
            'alamat' => $alamat,
            'lokasi' => $lokasi,
            'status' => $status
        ];

        return (view('pages.dataAlamat-table', $dataAlamat));
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
                'nama_kantor' => $request->kantor,
                'alamat' => $request->alamat,
                'id_lokasi' => $request->lokasi
            ]);

        return back();
    }


    //Update Lokasi
    public function updateLokasi(Request $request)
    {
        DB::table('alamat')
            ->join('lokasi', 'alamat.id_lokasi', '=', 'lokasi.id')
            ->where('alamat.id', $request->id_lokasi_update)
            ->update([
                'alamat.nama_kantor' => $request->kantor_update,
                'alamat.alamat' => $request->alamat_update,
                'alamat.id_lokasi' => $request->lokasi_update
            ]);

        return back();
    }
}
