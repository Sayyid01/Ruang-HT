<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class DetailHtController extends Controller
{
    //GET Detail Assignment HT
    public function getAssignmentHtDetail()
    {
        $sn_ht = $_GET['sn_ht'];

        $infoHt = DB::table('info_ht')
            ->where('sn_ht', $sn_ht)
            ->join('merk_ht', 'info_ht.id_merk_ht', '=', 'merk_ht.id')
            ->join('jenis_ht', 'merk_ht.id_jenis_ht', '=', 'jenis_ht.id')
            ->select('sn_ht', 'sn_baterai', 'merk_ht.merk_ht', 'jenis_ht.jenis_ht')
            ->first();

        $status = DB::table('status')
            ->where('sn_ht', $sn_ht)
            ->where('redacted', '0')
            ->first();

        $pengguna = DB::table('pengguna_ht')
            ->where('id', $status->id_pengguna_ht)
            ->first();

        $historiStatus = DB::table('status')
            ->where('sn_ht', $sn_ht)
            ->orderBy('tanggal_cek', 'desc')
            ->orderBy('status.id', 'desc')
            ->join('alamat', 'status.id_alamat', '=', 'alamat.id')
            ->select('tanggal_cek', 'foto_alat', 'id_pengguna_ht', 'status', 'kondisi', 'alamat.alamat')
            ->get();

        $historiPengguna = DB::table('status')
            ->where('sn_ht', $sn_ht)
            ->join('pengguna_ht', 'status.id_pengguna_ht', '=', 'pengguna_ht.id')
            ->where('status.tanggal_penarikan', '!=', ' ')
            ->orderBy('tanggal_alokasi', 'desc')
            ->select('status.tanggal_alokasi', 'status.tanggal_penarikan', 'pengguna_ht.nama', 'pengguna_ht.no_pegawai')
            ->get();

        $detailAssignment = [
            'infoHt' => $infoHt,
            'status' => $status,
            'pengguna' => $pengguna,
            'historiStatus' => $historiStatus,
            'historiPengguna' => $historiPengguna
        ];

        return view('pages.assignmentHtDetail', $detailAssignment);
    }

    public function getGambarHtTerbaru()
    {
        $status = DB::table('status')->select('foto_alat')->first();
        $path = public_path("/gambar_kondisi_ht" . '/' . $status);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);



        return $response;
    }

    //Input Status Terbaru HT
    public function inputStatusBaru(Request $request)
    {

        $request->validate([
            'gambarht' => 'required|mimes:jpeg,png,jpg|max:5140',
        ]);

        $fileName = Str::of('GMBRHT')->basename() . '-' . time() . '.' . $request->gambarht->extension();

        $request->gambarht->move(public_path('gambar_kondisi_ht'), $fileName);

        DB::table('status')
            ->where('sn_ht', $request->snHt)
            ->where('id_alamat', $request->alamat)
            ->update([
                'redacted' => '1'
            ]);

        DB::table('status')
            ->insert([
                'sn_ht' => $request->snHt,
                'id_pengguna_ht' => $request->pengguna,
                'id_alamat' => $request->alamat,
                'foto_alat' => $fileName,
                'status' => $request->status,
                'kondisi' => $request->kondisi,
                'tanggal_alokasi' => $request->tanggalAlokasi,
                'tanggal_cek' => $request->tanggalPeriksa,
                'tanggal_penarikan' => $request->tanggalPenarikan,
                'surat_terima' => $request->surat_terima
            ]);

        return back();
    }

    function getGambarHT($filename)
    {
        $files = public_path("/gambar_kondisi_ht" . '/' . $filename);
        $headers = array(
            'Content-Type: image/jpeg', 'Content-Type: image/png',
        );
        return response()->file($files, $headers);
    }

    //Withdraw HT
    public function withdrawHt(Request $request)
    {
        DB::table('status')
            ->where('status.sn_ht', $request->snHt)
            ->join('pengguna_ht', 'status.id_pengguna_ht', '=', 'pengguna_ht.id')
            ->join('info_ht', 'status.sn_ht', '=', 'info_ht.sn_ht')
            ->where('status.redacted', '0')
            ->update([
                'status.tanggal_penarikan' => $request->tanggalPenarikan,
                'status.status' => $request->statusWithdraw,
                'status.kondisi' => $request->kondisiWithdraw,
                'status.redacted' => '1',
                'info_ht.assigned' => '0'
            ]);

        return redirect('/assignHtLokasi');
    }
}
