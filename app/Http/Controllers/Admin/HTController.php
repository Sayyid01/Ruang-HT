<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HTController extends Controller
{
    //get
    public function getDetailHtTable()
    {
        //Detail HT
        if ($_GET['pemilik'] != " ") {
            $detail_ht = DB::table('detail_ht')
                ->where('kepemilikan', '=', $_GET['pemilik'])
                ->where('status.redacted', '=', 0)
                ->where('kepemilikan.redacted', '=', 0)
                ->rightJoin('status', 'kepemilikan', '=', 'status.pemilik')
                ->rightJoin('kepemilikan', 'kepemilikan', '=', 'kepemilikan.nama_penerima')
                ->select('detail_ht.sn_ht', 'sn_baterai', 'merk', 'detail_ht.jenis_ht', 'kepemilikan', 'status', 'foto_alat', 'tanggal_alokasi', 'jabatan', 'no_telpon')
                ->get();

            //Histori Status
            $status = DB::table('status')
                ->where('pemilik', '=', $_GET['pemilik'])
                ->where('redacted', '=', 1)
                ->get();

            // Histori Kepemilikan
            $kepemilikan = DB::table('kepemilikan')
                ->where('nama_penerima', '=', $_GET['pemilik'])
                ->where('redacted', '=', 1)
                ->get();

            $data = [
                'detail_ht' => $detail_ht,
                'status' => $status,
                'kepemilikan' => $kepemilikan
            ];
        } else {
            $detail_ht = DB::table('detail_ht')
                ->where('detail_ht.sn_ht', '=', $_GET['sn_ht'])
                ->where('status.redacted', '=', 0)
                ->rightJoin('status', 'kepemilikan', '=', 'status.pemilik')
                ->rightJoin('kepemilikan', 'kepemilikan', '=', 'kepemilikan.nama_penerima')
                ->select('detail_ht.sn_ht', 'sn_baterai', 'merk', 'detail_ht.jenis_ht', 'kepemilikan', 'status', 'foto_alat', 'tanggal_alokasi', 'jabatan', 'no_telpon')
                ->get();


            //Histori Status
            $status = DB::table('status')
                ->where('pemilik', '=', $_GET['pemilik'])
                ->where('redacted', '=', 1)
                ->get();

            // Histori Kepemilikan
            $kepemilikan = DB::table('kepemilikan')
                ->where('nama_penerima', '=', $_GET['pemilik'])
                ->where('redacted', '=', 1)
                ->get();

            $data = [
                'detail_ht' => $detail_ht,
                'status' => $status,
                'kepemilikan' => $kepemilikan
            ];
        }

        return (view('admin.pages.detailHt-table', $data));
    }

    public function getDataHtTable()
    {
        //Get data HT based on location

        $dataHt = DB::table('status')
            ->where('lokasi_ht', '=', $_GET['subject'])
            ->where('redacted', '=', 0)
            ->get();

        return (view('admin.pages.dataHtPerLokasi-table', ['dataHt' => $dataHt]));
    }

    public function getStatusHtTable()
    {
        $status = DB::table('status')->get();

        // return (view('admin.pages.'))
    }

    public function getKepemilikanHtTable()
    {
        $kepemilikan = DB::table('kepemilikan')->get();

        return (view('admin.pages.pengguna-table', ['kepemilikan' => $kepemilikan]));

    }

    //insert
    public function insertJenisHT(Request $request)
    {
        DB::table('jenis_ht')->insert([
            'jenis_ht' => $request->jenisHt,
            'fungsi_alat' => $request->fungsiAlat
        ]);

        return redirect('admin/forms-datareference');
    }
}
