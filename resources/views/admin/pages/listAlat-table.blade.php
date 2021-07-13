@extends('layouts.master')

@section('title', 'List Alat')
@section('title-2', 'List Alat')
@section('title-3', 'List Alat')

@section('content')
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Alat</h6>
                <a href="#" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalTambahAlat">Tambah Alat Baru</a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Fungsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alat as $listAlat)
                        <tr id="{{$listAlat->id}}">
                            <td data-target="merk">{{$listAlat->merk}}</td>
                            <td data-target="jenis">{{$listAlat->jenis}}</td>
                            <td data-target="fungsi">{{$listAlat->fungsi_alat}}</td>
                            <td><button data-id="{{$listAlat->id}}" data-role="modalUpdateListAlat" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$listAlat->id}}" data-role="deleteAlat" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Data HT-->
            <div class="modal fade" id="modalTambahAlat" tabindex="-1" role="dialog" aria-labelledby="modalInputUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Data Alat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('tambahAlatBaru')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" name="merk" placeholder="Merk Alat" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <input type="text" class="form-control" name="jenis" placeholder="Jenis Alat" required>
                                </div>
                                <div class="form-group">
                                    <label for="fungsi">Fungsi</label>
                                    <textarea type="text" class="form-control" name="fungsi" placeholder="Fungsi Alat" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Tambah Alat Baru"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data HT-->
            <div class="modal fade" id="modalUpdateListAlat" tabindex="-1" role="dialog" aria-labelledby="modalEditUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdatePenggunaTitle">Update Data Alat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateAlat')}}" method="POST">
                                @csrf
                                <!-- di hidden karena ga perlu user lihat -->
                                <div class="form-group" hidden>
                                    <label for="id_alat">Id Alat</label>
                                    <input type="text" id="id_alat" name="id_alat" class="form-control" readonly>
                                </div>

                                <!-- yang dilihat user -->
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" id="updateMerk" name="updateMerk" placeholder="Merk Alat" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <input type="text" class="form-control" id="updateJenis" name="updateJenis" placeholder="Jenis Alat" required>
                                </div>
                                <div class="form-group">
                                    <label for="fungsi">Fungsi</label>
                                    <textarea type="text" class="form-control" id="updateFungsi" name="updateFungsi" placeholder="Fungsi Alat" required></textarea>
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