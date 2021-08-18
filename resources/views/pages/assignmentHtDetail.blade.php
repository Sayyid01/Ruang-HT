@extends('layouts.master')

@section('title', 'Detail Assignment HT')
@section('title-2', 'Detail Assignment HT')
@section('title-3', 'Detail Assignment HT')

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
                <img src="{{ route('getGambarHT',$status->foto_alat) }}" alt="" class="rounded mx-auto d-block" width="100%" height="auto">
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
                            <td>{{$infoHt->merk_ht}}</td>
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
                            <td>{{$pengguna->nama}}</td>
                        </tr>
                        <tr>
                            <td>Penanggung Jawab</td>
                            <td>{{$pengguna->nama}}, {{$pengguna->no_pegawai}}</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mb-4">
                                    <div class="card h-100">
                                        <button class="card-body btn btn-warning" data-toggle="modal" title="Inspeksi HT" data-target="#modalInspeksiHt">
                                            <div class="align-items-center">
                                                <i class="fa fa-search-plus fa-4x"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mb-4">
                                    <div class="card h-100">
                                        <button class="card-body btn btn-danger" data-toggle="modal" title="Withdraw HT" data-target="#modalWithdrawHt">
                                            <div class="align-items-center">
                                                <i class="fa fa-undo fa-4x"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Inspeksi HT -->
    <div class="modal fade" id="modalInspeksiHt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Inspeksi HT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tambahHistoriStatus') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <!-- di hidden karena ga perlu dilihat user -->
                        <div hidden>
                            <input type="text" name="snHt" class="form-control" value="{{$infoHt->sn_ht}}" readonly>
                            <input type="date" name="tanggalAlokasi" class="form-control" value="{{$status->tanggal_alokasi}}" readonly>
                            <input type="text" name="alamat" class="form-control" value="{{$status->id_alamat}}" readonly></input>
                            <input type="text" name="pengguna" class="form-control" value="{{$status->id_pengguna_ht}}" readonly></input>
                            <input type="text" name="surat_terima" class="form-control" value="{{$status->surat_terima}}" readonly></input>
                        </div>
                        <!-- dilihat pengguna -->
                        <div class="form-group">
                            <label for="tanggalPeriksa">Tanggal Periksa</label>
                            <input class="form-control" type="date" name="tanggalPeriksa" required>
                        </div>
                        <div class="form-group">
                            <label for="gambarht">Upload Gambar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="gambarht" id="gambarht">
                                <label class="custom-file-label" for="gambarht">Masukkan gambar HT</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control mb-3" name="status" required="required">
                                <option value="0" selected>Aktif</option>
                                <option value="1">Nonaktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kondisi">Kondisi</label>
                            <textarea class="form-control" name="kondisi" rows="3" placeholder="Masukkan kondisi HT sebenarnya" required="required"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-primary" value="Perbarui Status"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Withdraw HT -->
    <div class="modal fade" id="modalWithdrawHt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Withdraw HT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('withdrawHt') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <!-- di hidden karena ga perlu dilihat user -->
                        <div hidden>
                            <input type="text" name="snHt" class="form-control" value="{{$infoHt->sn_ht}}" readonly>
                        </div>
                        <!-- dilihat pengguna -->
                        <div class="form-group">
                            <label for="tanggalPenarikan">Tanggal Penarikan</label>
                            <input class="form-control" type="date" name="tanggalPenarikan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <input type="submit" class="btn btn-primary" value="Withdraw"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Datatables --}}
    <div class="col mb-3">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Histori Status HT</h6>
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
                    <tbody>
                        @foreach($historiStatus as $status)

                        @php
                        $numberStatus++;
                        @endphp

                        <tr>
                            <td>{{$numberStatus}}</td>
                            <td>{{$status->tanggal_cek}}</td>
                            <td><a href="{{route('getGambarHT', $status->foto_alat)}}" target="_blank">{{$status->foto_alat}}</a></td>
                            @php
                            if($status->status == 0){
                            echo "<td><span class='badge badge-success'>Aktif</span></td>";
                            }else{
                            echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                            }
                            @endphp
                            <td>{{$status->kondisi}}</td>
                            <td>{{$status->id_alamat}}</td>
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
                            <th>No Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historiPengguna as $pengguna)

                        @php
                        $numberPengguna++;
                        @endphp

                        <tr>
                            <td>{{$numberPengguna}}</td>
                            <td>{{$pengguna->tanggal_alokasi}}</td>
                            <td>{{$pengguna->tanggal_penarikan}}</td>
                            <td>{{$pengguna->nama}}</td>
                            <td>{{$pengguna->no_pegawai}}</td>
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