<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class HTController extends Controller
{
    //get
    public function getDetailAssign()
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
            ->orderBy('id', 'desc')
            ->select('tanggal_cek', 'foto_alat', 'id_pengguna_ht', 'status', 'kondisi', 'id_alamat')
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

        return (view('pages.detailHt-table', $detailAssignment));
    }

    public function getDataHtPerLokasi()
    {
        $id_alamat = $_GET['alamat'];

        $alamat = DB::table('alamat')
            ->where('id', '=', $id_alamat)
            ->select('id', 'alamat')
            ->first();

        $status = DB::table('status')
            ->where('id_alamat', '=', $id_alamat)
            ->where('redacted', '=', 0)
            ->join('pengguna_ht', 'status.id_pengguna_ht', '=', 'pengguna_ht.id')
            ->select('status.id', 'tanggal_alokasi', 'sn_ht', 'pengguna_ht.nama', 'surat_terima', 'status', 'redacted')
            ->orderBy('id_pengguna_ht', 'asc')
            ->get();

        $dataAssign = [
            'status' => $status,
            'alamat' => $alamat
        ];

        return (view('pages.dataHtPerLokasi-table', $dataAssign));
    }

    public function getTableHT()
    {
        $infoHt = DB::table('info_ht')
            ->join('merk_ht', 'info_ht.id_merk_ht', '=', 'merk_ht.id')
            ->join('jenis_ht', 'merk_ht.id_jenis_ht', '=', 'jenis_ht.id')
            ->select('info_ht.id', 'sn_ht', 'sn_baterai', 'merk_ht', 'jenis_ht', 'id_merk_ht', 'id_jenis_ht', 'assigned')
            ->get();

        $merkHt = DB::table('merk_ht')->get();

        $informasiHt = [
            'infoHt' => $infoHt,
            'merkHt' => $merkHt
        ];

        return (view('pages.listHt-table', $informasiHt));
    }

    //GET Table Alat
    public function getTableAlat()
    {
        $merk = DB::table('merk_ht')
            ->join('jenis_ht', 'merk_ht.id_jenis_ht', '=', 'jenis_ht.id')
            ->select('merk_ht.id', 'merk_ht', 'merk_ht.id_jenis_ht', 'jenis_ht.jenis_ht')
            ->get();

        $jenis = DB::table('jenis_ht')
            ->get();

        $alat = [
            'merk_ht' => $merk,
            'jenis_ht' => $jenis
        ];

        return (view('pages.listAlat-table', $alat));
    }

    //GET Assign HT
    public function getAssignHt()
    {
        $id_alamat = $_GET['alamat'];
        try {
            $alamat = DB::table('alamat')
                ->where('id', '=', $id_alamat)
                ->select('id', 'alamat')
                ->first();

            $status = DB::table('status')
                ->where('id_alamat', '=', $id_alamat)
                ->where('redacted', '=', 0)
                ->join('pengguna_ht', 'status.id_pengguna_ht', '=', 'pengguna_ht.id')
                ->select('status.id', 'tanggal_alokasi', 'sn_ht', 'status.id_pengguna_ht', 'pengguna_ht.nama', 'surat_terima', 'status', 'redacted')
                ->orderBy('id_pengguna_ht', 'asc')
                ->get();

            $pengguna = DB::table('pengguna_ht')
                ->where('id_alamat_kerja', '=', $id_alamat)
                ->select('id', 'nama')
                ->get();

            $penggunaUpdate = DB::table('pengguna_ht')
                ->where('id_alamat_kerja', '=', $id_alamat)
                ->select('id', 'nama')
                ->get();

            $infoHt = DB::table('info_ht')
                ->where('assigned', '0')
                ->select('sn_ht', 'sn_baterai', 'id_merk_ht')
                ->get();
        } catch (Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1054) {
                $status = DB::table('status')
                    ->get();

                $alamat = DB::table('alamat')
                    ->where('id', '=', $id_alamat)
                    ->select('alamat')
                    ->first();

                $pengguna = DB::table('pengguna_ht')
                    ->where('id_alamat_kerja', '=', $id_alamat)
                    ->select('id', 'nama')
                    ->get();

                $infoHt = DB::table('info_ht')
                    ->select('sn_ht', 'sn_baterai', 'id_merk_ht')
                    ->get();
            }
        }


        $dataAssign = [
            'status' => $status,
            'alamat' => $alamat,
            'pengguna' => $pengguna,
            'penggunaUpdate' => $penggunaUpdate,
            'infoHt' => $infoHt
        ];

        return view('pages.assignHt', $dataAssign);
    }

    function getFile($filename)
    {
        $files = public_path("/surat_terima_ht" . '/' . $filename);
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->file($files, $headers);
    }

    //GET Lokasi Assign HT
    public function getLokasiAssign()
    {
        $lokasi = DB::table('lokasi')
            ->get();

        try {
            $status = DB::table('status')
                ->where('redacted', '=', 0)
                ->rightJoin('alamat', 'status.id_alamat', '=', 'alamat.id')
                ->select('alamat.id_lokasi')
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

        return view('pages.assignHtLokasi', $dataLokasi);
    }

    //GET Alamat Assign HT
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

        return view('pages.assignHtAlamat', $dataAlamat);
    }

    //Insert Assign HT
    public function assignHt(Request $request)
    {
        $status1 = DB::table('status')->where('redacted', '1')->exists();
        $status2 = DB::table('status')->where('sn_ht', $request->snHt)->exists();

        try {
            if ($status1) {
                $request->validate([
                    'file' => 'required|mimes:pdf,xlx,csv|max:5140',
                ]);

                $fileName = Str::of('STHT')->basename() . '-' . time() . '.' . $request->file->extension();

                $request->file->move(public_path('surat_terima_ht'), $fileName);

                DB::table('status')
                    ->insert([
                        'sn_ht' => $request->snHt,
                        'id_pengguna_ht' => $request->pengguna,
                        'id_alamat' => $request->alamat,
                        'surat_terima' => $fileName,
                        'tanggal_alokasi' => $request->tanggalAlokasi,
                        'tanggal_cek' => $request->tanggalAlokasi,
                        'status' => $request->status,
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
                    $request->validate([
                        'file' => 'required|mimes:pdf,xlx,csv|max:5140',
                    ]);

                    $fileName = Str::of('STHT')->basename() . '-' . time() . '.' . $request->file->extension();

                    $request->file->move(public_path('surat_terima_ht'), $fileName);

                    DB::table('status')
                        ->insert([
                            'sn_ht' => $request->snHt,
                            'id_pengguna_ht' => $request->pengguna,
                            'id_alamat' => $request->alamat,
                            'surat_terima' => $fileName,
                            'tanggal_alokasi' => $request->tanggalAlokasi,
                            'tanggal_cek' => $request->tanggalAlokasi,
                            'status' => $request->status,
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
        } catch (Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                $message = "Gagal Input, Pengguna sudah terdaftar!";
                $back = "/assignHtLokasi";
                echo "<script type='text/javascript'>
                alert('$message');
                window.location.href='$back';
                </script>";
            }
        }
    }

    //Insert HT Baru
    public function tambahHt(Request $request)
    {
        try {
            DB::table('info_ht')->insert([
                'sn_ht' => $request->snHt,
                'sn_baterai' => $request->snBaterai,
                'id_merk_ht' => $request->merk
            ]);

            return back();
        } catch (Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                $message = "Gagal Input, serial number HT atau baterai sudah terdaftar!";
                $back = "/listHt-table";
                echo "<script type='text/javascript'>
                alert('$message');
                window.location.href='$back';
                </script>";
            }
        }
    }

    //Insert Merk Baru
    public function tambahMerkAlatBaru(Request $request)
    {
        DB::table('merk_ht')
            ->insert([
                'merk_ht' => $request->merk,
                'id_jenis_ht' => $request->jenis
            ]);
        return back();
    }

    //Insert Jenis Baru
    public function tambahJenisAlatBaru(Request $request)
    {
        DB::table('jenis_ht')
            ->insert([
                'jenis_ht' => $request->jenis,
                'fungsi_ht' => $request->fungsi
            ]);

        return back();
    }

    //Update Assign Data
    public function updateAssignData(Request $request)
    {
        DB::table('status')
            ->where('id', $request->idStatus)
            ->update([
                'id_pengguna_ht' => $request->updatePengguna,
                'status' => $request->updateStatus
            ]);

        return back();
    }

    //Update Merk
    public function updateMerk(Request $request)
    {
        DB::table('merk_ht')
            ->where('id', $request->id_merk)
            ->update([
                'merk_ht' => $request->updateMerk,
                'id_jenis_ht' => $request->updateJenis,
            ]);

        return back();
    }

    //Update Jenis
    public function updateJenis(Request $request)
    {
        DB::table('jenis_ht')
            ->where('id', $request->id_jenis)
            ->update([
                'jenis_ht' => $request->updateJenisAlat,
                'fungsi_ht' => $request->updateFungsiAlat,
            ]);

        return back();
    }

    //Update HT
    public function updateHt(Request $request)
    {
        try {
            DB::table('info_ht')
                ->where('id', $request->id_ht)
                ->update([
                    'sn_ht' => $request->updateSnHt,
                    'sn_baterai' => $request->updateSnBaterai,
                    'id_merk_ht' => $request->updateMerk,
                ]);

            return back();
        } catch (Exception $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                $message = "Gagal Update, serial number HT atau baterai sudah terdaftar!";
                $back = "/listHt-table";
                echo "<script type='text/javascript'>
                alert('$message');
                window.location.href='$back';
                </script>";
            }
        }
    }

    //delete
    public function deleteHt($id_infoHt)
    {
        DB::table('info_ht')
            ->where('id', $id_infoHt)
            ->delete();
    }

    public function deleteMerkHt($id_merk)
    {
        DB::table('merk_ht')
            ->where('id', $id_merk)
            ->delete();
    }

    public function deleteJenis($id_jenis)
    {
        DB::table('jenis_ht')
            ->where('id', $id_jenis)
            ->delete();
    }
}
