@extends('layouts.master')

@section('title', 'Detail HT')
@section('title-2', 'Detail HT')
@section('title-3', 'Detail HT')

@push('css')
<link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')

@php
$numberStatus = 0;
$numberPengguna = 0;
@endphp

<div class="row mb-3">
    {{-- Datatables --}}
    <div class="col-5 mb-3">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Gambar HT</h6>
            </div>
            <div class="p-5">
                <img src="{{asset('dist/img/ht-image/gambarNoImage.png')}}" alt="" class="rounded mx-auto d-block" width="100%" height="auto">
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
                            <td>{{$infoHt->sn_ht}}</td>
                        </tr>
                        <tr>
                            <td>Serial Number Baterai</td>
                            <td>{{$infoHt->sn_baterai}}</td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>{{$infoHt->merk}}</td>
                        </tr>
                        <tr>
                            <td>Tipe HT</td>
                            <td>{{$infoHt->jenis_ht}}</td>
                        </tr>
                        <tr>
                            <td>Status HT</td>
                            @php
                            if($status->status == 0){
                            echo "<td><span class='badge badge-success'>Aktif</span></td>";
                            }else{
                            echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                            }
                            @endphp
                        </tr>
                        <tr>
                            <td>Tanggal Alokasi</td>
                            <td>{{$status->tanggal_alokasi}}</td>
                        </tr>
                        <tr>
                            <td>Pengguna</td>
                            <td>{{$pengguna->nama_pengguna}}</td>
                        </tr>
                        <tr>
                            <td>Penanggung Jawab</td>
                            <td>{{$penanggungJawab->nama}}, {{$penanggungJawab->no_pegawai}}</td>
                        </tr>
                        <tr>
                            <td>Kontak Penanggung Jawab</td>
                            <td>{{$penanggungJawab->no_telpon}}</td>
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
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Foto HT</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Periksa</th>
                            <th>Foto HT</th>
                            <th>Status</th>
                            <th>Kondisi</th>
                            <th>Lokasi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($historiStatus as $status)

                        @php
                        $numberStatus++;
                        @endphp

                        <tr>
                            <td>{{$numberStatus}}</td>
                            <td>{{$status->tanggal_cek}}</td>
                            <td>{{$status->foto_alat}}</td>
                            @php
                            if($status->status == 0){
                            echo "<td><span class='badge badge-success'>Aktif</span></td>";
                            }else{
                            echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                            }
                            @endphp
                            <td>{{$status->kondisi}}</td>
                            <td>{{$status->alamat_ht}}</td>
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
                <h6 class="m-0 font-weight-bold text-primary">Histori Pengguna HT</h6>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable2">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Alokasi</th>
                            <th>Tanggal Penarikan</th>
                            <th>Pengguna</th>
                            <th>Penanggung Jawab</th>
                            <th>Jabatan</th>
                            <th>No Pegawai</th>
                            <th>No Telpon</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Alokasi</th>
                            <th>Tanggal Penarikan</th>
                            <th>Pengguna</th>
                            <th>Penanggung Jawab</th>
                            <th>Jabatan</th>
                            <th>No Pegawai</th>
                            <th>No Telpon</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($historiPengguna as $pengguna)

                        @php
                        $numberPengguna++;
                        @endphp

                        <tr>
                            <td>{{$numberPengguna}}</td>
                            <td>{{$pengguna->tanggal_alokasi}}</td>
                            <td>{{$pengguna->tanggal_penarikan}}</td>
                            <td>{{$pengguna->pengguna}}</td>
                            <td>{{$pengguna->nama}}</td>
                            <td>{{$pengguna->jabatan}}</td>
                            <td>{{$pengguna->no_pegawai}}</td>
                            <td>{{$pengguna->no_telpon}}</td>
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