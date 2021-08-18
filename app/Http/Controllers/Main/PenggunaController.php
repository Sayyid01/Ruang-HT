<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenggunaController extends Controller
{
    //get
    public function getPenggunaTable()
    {
        $pengguna = DB::table('pengguna_ht')
            ->join('alamat', 'pengguna_ht.id_alamat_kerja', '=', 'alamat.id')
            ->select('pengguna_ht.id', 'no_pegawai', 'nama', 'status_pekerja', 'alamat.alamat')
            ->orderBy('pengguna_ht.id', 'asc')
            ->get();

        $alamat = DB::table('alamat')->get();

        $dataPengguna = [
            'pengguna' => $pengguna,
            'alamat' => $alamat
        ];

        return (view('pages.pengguna-table', $dataPengguna));
    }

    //insert
    public function tambahDataPengguna(Request $request)
    {
        DB::table('pengguna_ht')
            ->insert([
                'no_pegawai' => $request->no_pegawai,
                'nama' => $request->nama_pengguna,
                'status_pekerja' => $request->status_pekerja,
                'id_alamat_kerja' => $request->alamat_kerja
            ]);
        return redirect('/pengguna-table');
    }

    //update
    public function updateDataPengguna(Request $request)
    {
        DB::table('pengguna_ht')
            ->where('id', $request->id_pengguna_update)
            ->update([
                'nama' => $request->updateNamaPengguna
            ]);
        return redirect('/pengguna-table');
    }

    //delete
    public function deleteDataPengguna($id_pengguna)
    {
        DB::table('pengguna_ht')
            ->where('id', $id_pengguna)
            ->delete();
    }
}
