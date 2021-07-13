<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HTController extends Controller
{
    //get
    public function getDetailAssign()
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

        return (view('admin.pages.detailHt-table', $detailAssignment));
    }

    public function getDataHtPerLokasi()
    {
        $dataHt = DB::table('status')
            ->where('alamat_ht', '=', $_GET['alamat'])
            ->where('redacted', '=', 0)
            ->get();

        return (view('admin.pages.dataHtPerLokasi-table', ['status' => $dataHt]));
    }

    public function getTableHT()
    {
        $infoHt = DB::table('info_ht')->get();
        $alat = DB::table('alat')->get();

        $informasiHt = [
            'infoHt' => $infoHt,
            'alat' => $alat
        ];

        return (view('admin.pages.listHt-table', $informasiHt));
    }

    //GET Table Alat
    public function getTableAlat()
    {
        $alat = DB::table('alat')->get();

        return (view('admin.pages.listAlat-table', ['alat' => $alat]));
    }

    //GET Assign HT
    public function getAssignHt()
    {
        $status = DB::table('status')
            ->where('alamat_ht', '=', $_GET['alamat'])
            ->where('redacted', '=', 0)
            ->orderBy('pengguna', 'asc')
            ->get();

        $infoHt = DB::table('info_ht')
            ->where('assigned', '0')
            ->select('sn_ht', 'sn_baterai', 'merk')
            ->get();

        $pengguna = DB::table('pengguna')
            ->select('nama_pengguna', 'penanggung_jawab')
            ->get();

        $dataAssign = [
            'status' => $status,
            'infoHt' => $infoHt,
            'pengguna' => $pengguna
        ];

        return view('admin.pages.assignHt', $dataAssign);
    }

    //GET Lokasi Assign HT
    public function getLokasiAssign()
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

        return view('admin.pages.assignHtLokasi', $dataLokasi);
    }

    //GET Alamat Assign HT
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

        return view('admin.pages.assignHtAlamat', $dataAlamat);
    }

    //Insert Assign HT
    public function assignHt(Request $request)
    {
        $status1 = DB::table('status')->where('redacted', '1')->exists();
        $status2 = DB::table('status')->where('sn_ht', $request->snHt)->exists();

        if ($status1) {
            DB::table('status')
                ->insert([
                    'sn_ht' => $request->snHt,
                    'pengguna' => $request->pengguna,
                    'alamat_ht' => $request->alamat,
                    'status' => $request->status,
                    'tanggal_alokasi' => $request->tanggalAlokasi,
                    'tanggal_cek' => $request->tanggalAlokasi,
                    'tanggal_penarikan' => $request->tanggalPenarikan
                ]);

            DB::table('info_ht')
                ->where('sn_ht', $request->snHt)
                ->update([
                    'assigned' => '1'
                ]);

            return back();
        } else {
            if ($status2) {
                return back()->with('error', 'HT sudah digunakan');
            } else {
                DB::table('status')
                    ->insert([
                        'sn_ht' => $request->snHt,
                        'pengguna' => $request->pengguna,
                        'alamat_ht' => $request->alamat,
                        'status' => $request->status,
                        'tanggal_alokasi' => $request->tanggalAlokasi,
                        'tanggal_cek' => $request->tanggalAlokasi,
                        'tanggal_penarikan' => $request->tanggalPenarikan
                    ]);

                DB::table('info_ht')
                    ->where('sn_ht', $request->snHt)
                    ->update([
                        'assigned' => '1'
                    ]);

                return back();
            }
        }
    }

    //Insert HT Baru
    public function tambahHt(Request $request)
    {
        DB::table('info_ht')->insert([
            'sn_ht' => $request->snHt,
            'sn_baterai' => $request->snBaterai,
            'merk' => $request->merk,
            'jenis_ht' => $request->jenisHt
        ]);

        return back();
    }

    //Insert Alat Baru
    public function tambahAlatBaru(Request $request)
    {
        DB::table('alat')
            ->insert([
                'merk' => $request->merk,
                'jenis' => $request->jenis,
                'fungsi_alat' => $request->fungsi
            ]);

        return back();
    }

    //Update Assign Data
    public function updateAssignData(Request $request)
    {
        DB::table('status')
            ->where('id_status', $request->idStatus)
            ->update([
                'tanggal_penarikan' => $request->tanggalPenarikan,
                'pengguna' => $request->updatePengguna,
                'status' => $request->updateStatus
            ]);

        return back();
    }

    //Update Alat
    public function updateAlat(Request $request)
    {
        DB::table('alat')
            ->where('id', $request->id_alat)
            ->update([
                'merk' => $request->updateMerk,
                'jenis' => $request->updateJenis,
                'fungsi_alat' => $request->updateFungsi
            ]);

        return back();
    }

    //Update HT
    public function updateHt(Request $request)
    {
        DB::table('info_ht')
            ->where('id', $request->id_ht)
            ->update([
                'sn_ht' => $request->updateSnHt,
                'sn_baterai' => $request->updateSnBaterai,
                'merk' => $request->updateMerk,
                'jenis_ht' => $request->updateJenisHt
            ]);

        return back();
    }

    //delete
    public function deleteHt($id_infoHt)
    {
        DB::table('info_ht')
            ->where('id', $id_infoHt)
            ->delete();
    }

    public function deleteAlat($id_alat)
    {
        DB::table('alat')
            ->where('id', $id_alat)
            ->delete();
    }
}
