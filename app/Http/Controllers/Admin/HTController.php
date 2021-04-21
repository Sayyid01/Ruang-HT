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
        $detailHt = DB::table('detail_ht')->get();

        return (view('admin.pages.detailHt-table', ['detail_ht' => $detailHt]));
    }

    public function getDataHtTable(){
        $dataHt = DB::table('detail_ht');
        // ->select('kepemilikan as pemilik', 'jenis_ht', 'id_status');
        return (view('admin.pages.dataHtPerLokasi-table'));
    }

    public function getStatusHtTable()
    {
        $status = DB::table('status')->get();
    }

    public function getKepemilikanHtTable()
    {
        $kepemilikan = DB::table('kepemilikan')->get();
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
