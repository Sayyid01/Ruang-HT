<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DetailHtController extends Controller
{
    //GET Detail Assignment HT
    public function getAssignmentHtDetail()
    {
        $sn_ht = $_GET['sn_ht'];

        $infoHt = DB::table('info_ht')
            ->where('sn_ht', $sn_ht)
            ->first();

        $status = DB::table('status')
            ->where('sn_ht', $sn_ht)
            ->where('redacted', '0')
            ->first();

        $pengguna = DB::table('pengguna')
            ->where('nama_pengguna', $status->pengguna)
            ->where('redacted', '0')
            ->first();

        $pegawai = DB::table('pegawai')
            ->where('nama', $pengguna->penanggung_jawab)
            ->first();

        $historiStatus = DB::table('status')
            ->where('sn_ht', $sn_ht)
            ->orderBy('tanggal_cek', 'desc')
            ->select('tanggal_cek', 'foto_alat', 'pengguna', 'status', 'kondisi', 'alamat_ht')
            ->get();

        $historiPengguna = DB::table('status')
            ->where('sn_ht', $sn_ht)
            ->join('pengguna', 'status.pengguna', '=', 'pengguna.nama_pengguna')
            ->join('pegawai', 'pengguna.penanggung_jawab', '=', 'pegawai.nama')
            ->where('pengguna.redacted', '0')
            ->where('status.tanggal_penarikan', '!=', ' ')
            ->orderBy('tanggal_alokasi', 'desc')
            ->select('status.tanggal_alokasi', 'status.tanggal_penarikan', 'status.pengguna', 'pegawai.nama', 'pegawai.jabatan', 'pegawai.no_pegawai', 'pegawai.no_telpon')
            ->get();

        $detailAssignment = [
            'infoHt' => $infoHt,
            'status' => $status,
            'pengguna' => $pengguna,
            'penanggungJawab' => $pegawai,
            'historiStatus' => $historiStatus,
            'historiPengguna' => $historiPengguna
        ];

        return view('admin.pages.assignmentHtDetail', $detailAssignment);
    }

    //Input Status Terbaru HT
    public function inputStatusBaru(Request $request)
    {
        DB::table('status')
            ->where('sn_ht', $request->snHt)
            ->where('alamat_ht', $request->alamat)
            ->update([
                'redacted' => '1'
            ]);

        DB::table('status')
            ->insert([
                'sn_ht' => $request->snHt,
                'pengguna' => $request->pengguna,
                'alamat_ht' => $request->alamat,
                'status' => $request->status,
                'kondisi' => $request->kondisi,
                'tanggal_alokasi' => $request->tanggalAlokasi,
                'tanggal_cek' => $request->tanggalPeriksa,
                'tanggal_penarikan' => $request->tanggalPenarikan
            ]);

        return back();
    }

    //Withdraw HT
    public function withdrawHt(Request $request)
    {
        DB::table('status')
            ->where('sn_ht', $request->snHt)
            ->join('pengguna', 'status.pengguna', '=', 'pengguna.nama_pengguna')
            ->join('pegawai', 'pengguna.penanggung_jawab', '=', 'pegawai.nama')
            ->where('pengguna.redacted', '0')
            ->where('status.redacted', '0')
            ->update([
                'status.tanggal_penarikan' => $request->tanggalPenarikan,
                'status.status' => '1',
                'status.redacted' => '1'
            ]);

        return redirect('admin/assignHtLokasi');
    }
}
