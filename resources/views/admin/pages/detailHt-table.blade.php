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
                        @foreach($detail_ht as $detail_ht)
                        <tr>
                            <td>Serial Number HT</td>
                            <td>{{$detail_ht->sn_ht}}</td>
                        </tr>
                        <tr>
                            <td>Serial Number Baterai</td>
                            <td>{{$detail_ht->sn_baterai}}</td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>{{$detail_ht->merk}}</td>
                        </tr>
                        <tr>
                            <td>Tipe HT</td>
                            <td>{{$detail_ht->jenis_ht}}</td>
                        </tr>
                        <tr>
                            <td>Status HT</td>
                            @php 
                                if($detail_ht -> status == 0){
                                    echo "<td><span class='badge badge-success'>Aktif</span></td>";
                                }else{
                                    echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                                }
                            @endphp
                        </tr>
                        <tr>
                            <td>Tanggal Alokasi</td>
                            <td>{{$detail_ht->tanggal_alokasi}}</td>
                        </tr>
                        <tr>
                            <td>Pemilik</td>
                            <td>{{$detail_ht->kepemilikan}}</td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>{{$detail_ht->jabatan}}</td>
                        </tr>
                        <tr>
                            <td>Kontak Penerima</td>
                            <td>{{$detail_ht->no_telpon}}</td>
                        </tr>
                        @endforeach
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
                            <th>Tanggal Periksa</th>
                            <th>Foto HT</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Jenis HT</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tanggal Periksa</th>
                            <th>Foto HT</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Jenis HT</th>
                            <th>Lokasi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($status as $histori_status)
                        <tr>
                            <td>{{$histori_status->tanggal}}</td>
                            <td>{{$histori_status->foto_alat}}</td>
                            @php 
                                if($histori_status -> status == 0){
                                    echo "<td><span class='badge badge-success'>Aktif</span></td>";
                                }else{
                                    echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                                }
                            @endphp
                            <td>{{$histori_status->kondisi}}</td>
                            <td>{{$histori_status->jenis_ht}}</td>
                            <td>{{$histori_status->lokasi_ht}}</td>
                        </tr>
                        @endforeach
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
                    @foreach($kepemilikan as $histori_kepemilikan)
                        <tr>
                            <td>{{$histori_kepemilikan->tanggal_alokasi}}</td>
                            <td>{{$histori_kepemilikan->tanggal_penarikan}}</td>
                            <td>{{$histori_kepemilikan->nama_penerima}}</td>
                            <td>{{$histori_kepemilikan->penanggung_jawab}}</td>
                            <td>{{$histori_kepemilikan->jabatan}}</td>
                            <td>{{$histori_kepemilikan->fungsi}}</td>
                            <td>{{$histori_kepemilikan->no_pegawai}}</td>
                            <td>{{$histori_kepemilikan->no_telpon}}</td>
                        </tr>
                        @endforeach
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