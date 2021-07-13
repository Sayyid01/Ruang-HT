@extends('layouts.master')

@section('title', 'Table Pegawai')
@section('title-2', 'Table Pegawai')
@section('title-3', 'Table Pegawai')

@section('content')

@php
$number = 0;
@endphp

<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pegawai</h6>
                <a href="#" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputPegawai">Tambah Pegawai</a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No Pegawai</th>
                            <th>No Telpon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawai as $pegawai)

                        @php
                        $number++;
                        @endphp

                        <tr id="{{$pegawai->id}}">
                            <td>{{$number}}</td>
                            <td data-target="namaPegawai">{{$pegawai->nama}}</td>
                            <td data-target="jabatan">{{$pegawai->jabatan}}</td>
                            <td data-target="no_pegawai">{{$pegawai->no_pegawai}}</td>
                            <td data-target="no_telpon">{{$pegawai->no_telpon}}</td>
                            <td><button data-id="{{$pegawai->id}}" data-role="modalUpdatePegawai" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$pegawai->id}}" data-role="deletePegawai" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Data Pegawai-->
            <div class="modal fade" id="modalInputPegawai" tabindex="-1" role="dialog" aria-labelledby="modalInputUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Data Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('tambahPegawai')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="inputNamaPegawai">Nama</label>
                                    <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" placeholder="Masukkan nama pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="inputJabatan">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Masukkan jabatan pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="inputNoPegawai">No Pegawai</label>
                                    <input type="text" class="form-control" name="no_pegawai" id="no_pegawai" pattern="[0-9]+" placeholder="Tolong hanya masukkan angka">
                                </div>
                                <div class="form-group">
                                    <label for="inputNoTelpon">No Telpon</label>
                                    <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="Tolong masukkan nomor telpon aktif pegawai">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Tambah Data Pegawai"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data Pegawai-->
            <div class="modal fade" id="modalUpdatePegawai" tabindex="-1" role="dialog" aria-labelledby="modalEditUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdatePenggunaTitle">Update Data Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updatePegawai')}}" method="POST">
                                @csrf
                                <!-- di hidden karena ga perlu user lihat -->
                                <div class="form-group" hidden>
                                    <label for="updateIdPegawai">Id Pengguna</label>
                                    <input type="text" id="updateIdPegawai" name="updateIdPegawai" class="form-control" readonly>
                                </div>

                                <!-- Yang dilihat user -->
                                <div class="form-group">
                                    <label for="updateNamaPegawai">Nama</label>
                                    <input type="text" class="form-control" id="updateNamaPegawai" name="updateNamaPegawai" placeholder="Masukkan nama pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="updateJabatan">Jabatan</label>
                                    <input type="text" class="form-control" id="updateJabatan" name="updateJabatan" placeholder="Masukkan jabatan pegawai">
                                </div>
                                <div class="form-group">
                                    <label for="updateNoPegawai">No Pegawai</label>
                                    <input type="text" class="form-control" id="updateNoPegawai" name="updateNoPegawai" pattern="[0-9]+" placeholder="Tolong hanya masukkan angka">
                                </div>
                                <div class="form-group">
                                    <label for="updateNoTelpon">No Telpon</label>
                                    <input type="text" class="form-control" id="updateNoTelpon" name="updateNoTelpon" placeholder="Tolong masukkan nomor telpon aktif pegawai">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Simpan Perubahan"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection