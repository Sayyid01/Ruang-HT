<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
{
    public function getLokasi()
    {
        $lokasi = DB::table('lokasi')
            ->select('lokasi')
            ->get();

        $lokasi_status = DB::table('status')
            ->where('redacted', '=', 0)
            ->select('lokasi_ht')
            ->get();

        $dataLokasi = [
            'lokasi' => $lokasi,
            'lokasi_status' => $lokasi_status
        ];

        return view('admin.index', $dataLokasi);
    }

    public function insertLokasi(Request $request)
    {
        DB::table('lokasi')
            ->insert([
                'lokasi' => $request->lokasi,
                'wilayah' => $request->wilayah
            ]);

        return redirect('admin/forms-datareference');
    }

    public function getTableLokasi()
    {
        $lokasi = DB::table('lokasi')
            ->get();

            return (view('admin.pages.lokasi-table', ['lokasi' => $lokasi]));
    }
}
