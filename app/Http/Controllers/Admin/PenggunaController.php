<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenggunaController extends Controller
{
    //get
    public function getPenggunaTable()
    {
        $pengguna = DB::table('pengguna')
            ->orderBy('penanggung_jawab', 'asc')
            ->get();
        $pegawai = DB::table('pegawai')->get();

        $dataPengguna = [
            'pengguna' => $pengguna,
            'pegawai' => $pegawai
        ];

        return (view('admin.pages.pengguna-table', $dataPengguna));
    }

    public function getPegawaiTable()
    {
        $pegawai = DB::table('pegawai')->get();
        return (view('admin.pages.pegawai-table', ['pegawai' => $pegawai]));
    }

    //insert
    public function tambahDataPengguna(Request $request)
    {
        DB::table('pengguna')
            ->insert([
                'nama_pengguna' => $request->nama_pengguna,
                'penanggung_jawab' => $request->penanggungJawab
            ]);
        return redirect('/admin/pengguna-table');
    }

    public function tambahDataPegawai(Request $request)
    {
        if ($request->no_telpon != null) {
            DB::table('pegawai')
                ->insert([
                    'nama' => $request->nama_pegawai,
                    'jabatan' => $request->jabatan,
                    'no_pegawai' => $request->no_pegawai,
                    'no_telpon' => $request->no_telpon
                ]);
        } else {
            $nomorKosong = "-";
            DB::table('pegawai')
                ->insert([
                    'nama' => $request->nama_pegawai,
                    'jabatan' => $request->jabatan,
                    'no_pegawai' => $request->no_pegawai,
                    'no_telpon' => $nomorKosong
                ]);
        }
        return redirect('/admin/pegawai-table');
    }

    //update
    public function updateDataPengguna(Request $request)
    {
        DB::table('pengguna')
            ->where('id', $request->id_pengguna_update)
            ->update([
                'nama_pengguna' => $request->updateNamaPengguna,
                'penanggung_jawab' => $request->updatePenanggungJawab
            ]);
        return redirect('/admin/pengguna-table');
    }

    public function updateDataPegawai(Request $request)
    {
        if ($request->updateNoTelpon != null) {
            DB::table('pegawai')
                ->where('id', $request->updateIdPegawai)
                ->update([
                    'nama' => $request->updateNamaPegawai,
                    'jabatan' => $request->updateJabatan,
                    'no_pegawai' => $request->updateNoPegawai,
                    'no_telpon' => $request->updateNoTelpon
                ]);
        } else {
            $nomorKosong = "-";
            DB::table('pegawai')
                ->where('id', $request->updateIdPegawai)
                ->update([
                    'nama' => $request->updateNamaPegawai,
                    'jabatan' => $request->updateJabatan,
                    'no_pegawai' => $request->updateNoPegawai,
                    'no_telpon' => $nomorKosong
                ]);
        }
        return redirect('/admin/pegawai-table');
    }

    //delete
    public function deleteDataPengguna($id_pengguna)
    {
        DB::table('pengguna')
            ->where('id', $id_pengguna)
            ->delete();
    }

    public function deleteDataPegawai($id_pegawai)
    {
        DB::table('pegawai')
            ->where('id', $id_pegawai)
            ->delete();
    }
}
