@extends('layouts.master')

@section('title', 'Table Pengguna')
@section('title-2', 'Table Pengguna')
@section('title-3', 'Table Pengguna')

@section('content')
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
                <a href="#" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#exampleModalCenter">Tambah Pengguna</a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal Alokasi</th>
                            <th>Tanggal Penarikan</th>
                            <th>Nama Pengguna</th>
                            <th>Penanggung Jawab</th>
                            <th>Jabatan</th>
                            <th>Fungsi</th>
                            <th>No Pegawai</th>
                            <th>No Telpon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kepemilikan as $pengguna)
                        <td>{{$pengguna->tanggal_alokasi}}</td>
                        <td>{{$pengguna->tanggal_penarikan}}</td>
                        <td>{{$pengguna->nama_penerima}}</td>
                        <td>{{$pengguna->penanggung_jawab}}</td>
                        <td>{{$pengguna->jabatan}}</td>
                        <td>{{$pengguna->fungsi}}</td>
                        <td>{{$pengguna->no_pegawai}}</td>
                        <td>{{$pengguna->no_telpon}}</td>
                        <td><a href="#" class="btn btn-sm btn-primary">Edit</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Lokasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="inputLokasi">Lokasi</label>
                                    <textarea class="form-control" id="inputLokasi" rows="3" placeholder="Masukkan Lokasi Baru"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">WIlayah</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Wilayah">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection