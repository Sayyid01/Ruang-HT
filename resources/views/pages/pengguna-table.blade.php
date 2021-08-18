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
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>No Pegawai</th>
                            <th>Nama Pengguna</th>
                            <th>Status Pekerja</th>
                            <th>Alamat Kerja</th>
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
                            <td data-target="no_pegawai">{{$pengguna->no_pegawai}}</td>
                            <td data-target="nama">{{$pengguna->nama}}</td>
                            @php
                            if($pengguna->status_pekerja == 1){
                            echo "<td data-target='status_pekerja'>Pekerja</td>";
                            }else{
                            echo "<td data-target='status_pekerja'>Mitra</td>";
                            }
                            @endphp
                            <td data-target="alamat_kerja">{{$pengguna->alamat}}</td>
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
                                    <label for="no_pegawai">No Pegawai</label>
                                    <input type="text" class="form-control" name="no_pegawai" placeholder="No Pegawai" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama_pengguna">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="nama_pengguna" placeholder="Nama Pengguna" required>
                                </div>
                                <div class="form-group">
                                    <label for="status_pekerja">Status Pekerja</label>
                                    <select class="form-control mb-3" name="status_pekerja" required>
                                        <option value="" disabled selected>Pilih Status Pekerja</option>
                                        <option value="1">Pekerja</option>
                                        <option value="0">Mitra</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_kerja">Alamat Kerja</label>
                                    <select class="form-control mb-3" name="alamat_kerja" required>
                                        <option value="" disabled selected>Pilih Alamat</option>
                                        @foreach($alamat as $alamatKerja)
                                        <option value="{{$alamatKerja->id}}">{{$alamatKerja->alamat}}</option>
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