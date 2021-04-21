@extends('layouts.master')

@section('title', 'Detail HT')
@section('title-2', 'Detail HT')
@section('title-3', 'Detail HT')

@push('css')
<link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row mb-3">

    {{-- Datatables --}}
    <div class="col-5 mb-3">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Gambar HT</h6>
            </div>
            <div class="p-5">
                <img src="{{asset('dist/img/ht-image/gambarHT1.jpg')}}" alt="" class="rounded mx-auto d-block" width="100%" height="auto">
            </div>
        </div>
    </div>

    {{-- Datatables --}}
    <div class="col mb-3">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data HT</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <tbody>
                        <tr>
                            <td>Serial Number HT</td>
                            <td>Aji Sutarno</td>
                        </tr>
                        <tr>
                            <td>Serial Number Baterai</td>
                            <td>Aji Sutarno</td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>Aji Sutarno</td>
                        </tr>
                        <tr>
                            <td>Tipe HT</td>
                            <td>Aji Sutarno</td>
                        </tr>
                        <tr>
                            <td>Pemilik</td>
                            <td>Aji Sutarno</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>Aji Sutarno</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w-100"></div>

    {{-- Datatables --}}
    <div class="col mb-3">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Histori status HT</h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Foto HT</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Jenis HT</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tanggal</th>
                            <th>Foto HT</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Jenis HT</th>
                            <th>Lokasi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- Datatables --}}
    <div class="col mb-3">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Histori kepemilikan HT</h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable2">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal Alokasi</th>
                            <th>Tanggal Penarikan</th>
                            <th>Penerima</th>
                            <th>Penanggung Jawab</th>
                            <th>Jabatan</th>
                            <th>Fungsi</th>
                            <th>No Pegawai</th>
                            <th>No Telpon</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tanggal Alokasi</th>
                            <th>Tanggal Penarikan</th>
                            <th>Penerima</th>
                            <th>Penanggung Jawab</th>
                            <th>Jabatan</th>
                            <th>Fungsi</th>
                            <th>No Pegawai</th>
                            <th>No Telpon</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$170,750</td>
                        </tr>
                        <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$86,000</td>
                        </tr>
                        <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                        </tr>
                        <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>$162,700</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</div>

<div class="row mb-3">


</div>
@endsection

@push('js')
{{-- Page level plugins --}}
<script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

{{-- Page level custom scripts --}}
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable(); // ID From dataTable 
        $('#dataTable2').DataTable(); // ID From dataTable 
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
@endpush