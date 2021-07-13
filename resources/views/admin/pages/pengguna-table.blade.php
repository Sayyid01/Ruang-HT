@extends('layouts.master')

@section('title', 'Table Pengguna')
@section('title-2', 'Table Pengguna')
@section('title-3', 'Table Pengguna')

@section('content')

@php
$number = 0;
@endphp

<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
                <a href="#" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputUser">Tambah Pengguna</a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pengguna</th>
                            <th>Penanggung Jawab</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengguna as $pengguna)

                        @php
                        $number++;
                        @endphp

                        <tr id="{{$pengguna->id}}">
                            <td>{{$number}}</td>
                            <td data-target="nama_pengguna">{{$pengguna->nama_pengguna}}</td>
                            <td data-target="penanggung_jawab">{{$pengguna->penanggung_jawab}}</td>
                            <td><button data-id="{{$pengguna->id}}" data-role="modalUpdatePengguna" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$pengguna->id}}" data-role="deletePengguna" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Data Pengguna-->
            <div class="modal fade" id="modalInputUser" tabindex="-1" role="dialog" aria-labelledby="modalInputUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Data Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('tambahPengguna')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="namaPengguna">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" required>
                                </div>
                                <div class="form-group">
                                    <label for="penanggungJawab">Penanggung Jawab</label>
                                    <select class="form-control mb-3" name="penanggungJawab" required>
                                        <option value="" disabled selected>Pilih PJ</option>
                                        @foreach($pegawai as $pegawaiInput)
                                        <option>{{$pegawaiInput->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Tambah Data Pengguna"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data Pengguna-->
            <div class="modal fade" id="modalUpdatePengguna" tabindex="-1" role="dialog" aria-labelledby="modalEditUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdatePenggunaTitle">Update Data Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updatePengguna')}}" method="POST">
                                @csrf
                                <!-- di hidden karena ga perlu -->
                                <div class="form-group" hidden>
                                    <label for="id_penguna">Id Pengguna</label>
                                    <input type="text" id="id_pengguna_update" name="id_pengguna_update" class="form-control" readonly>
                                </div>

                                <!-- yang tampil -->
                                <div class="form-group">
                                    <label for="updateNamaPengguna">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="updateNamaPengguna" name="updateNamaPengguna" required>
                                </div>
                                <div class="form-group">
                                    <label for="updatePenanggungJawab">Penanggung Jawab</label>
                                    <select class="form-control mb-3" id="updatePenanggungJawab" name="updatePenanggungJawab">
                                        <option value="" disabled selected>Pilih PJ</option>
                                        @foreach($pegawai as $pegawaiUpdate)
                                        <option>{{$pegawaiUpdate->nama}}</option>
                                        @endforeach
                                    </select>
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