<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
{
    public function getLokasi()
    {
        $lokasi = DB::table('lokasi')->get();

        return view('admin.index', ['lokasi' => $lokasi]);
    }

    public function insertLokasi(Request $request)
    {
        DB::table('lokasi')->insert([
            'lokasi'=>$request->lokasi,
            'wilayah'=>$request->wilayah
        ]);

        return redirect('admin/forms-datareference');
    }
}
