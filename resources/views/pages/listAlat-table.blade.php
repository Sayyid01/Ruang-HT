@extends('layouts.master')

@section('title', 'List Alat')
@section('title-2', 'List Alat')
@section('title-3', 'List Alat')

@section('content')

<!-- Table List Merk -->
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Merk HT</h6>
                <button" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalTambahAlat">Tambah Merk Baru</button>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merk_ht as $listMerk)
                        <tr id="{{$listMerk->id}}">
                            <td data-target="merk">{{$listMerk->merk_ht}}</td>
                            <td data-target="jenis" data-value="{{$listMerk->id_jenis_ht}}">{{$listMerk->jenis_ht}}</td>
                            <td><button data-id="{{$listMerk->id}}" data-role="modalUpdateMerkAlat" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$listMerk->id}}" data-role="deleteMerkHt" class="btn btn-sm btn-danger">Delete</button>
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
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Jenis Alat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('tambahMerkAlatBaru')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" name="merk" placeholder="Merk Alat" required>
                                </div>

                                <div class="form-group">
                                    <label for="alamat_kerja">Jenis</label>
                                    <select class="form-control mb-3" name="jenis" required>
                                        <option value="" disabled selected>Pilih Jenis Alat</option>
                                        @foreach($jenis_ht as $jenis)
                                        <option value="{{$jenis->id}}">{{$jenis->jenis_ht}}</option>
                                        @endforeach
                                    </select>
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
            <div class="modal fade" id="modalUpdateMerkAlat" tabindex="-1" role="dialog" aria-labelledby="modalEditUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdatePenggunaTitle">Update Data Alat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateMerk')}}" method="POST">
                                @csrf
                                <!-- di hidden karena ga perlu user lihat -->
                                <div class="form-group" hidden>
                                    <label for="id_merk">Id Merk</label>
                                    <input type="text" id="id_merk" name="id_merk" class="form-control" readonly>
                                </div>

                                <!-- yang dilihat user -->
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input type="text" class="form-control" id="updateMerk" name="updateMerk" placeholder="Merk Alat" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat_kerja">Jenis</label>
                                    <select class="form-control mb-3" name="updateJenis" id="updateJenis" required>
                                        <option value="" disabled selected>Pilih Jenis Alat</option>
                                        @foreach($jenis_ht as $jenis)
                                        <option value="{{$jenis->id}}">{{$jenis->jenis_ht}}</option>
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

<!-- Table List Jenis Alat -->
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Jenis HT</h6>
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalTambahJenisAlat">Tambah Jenis HT Baru</button>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Jenis</th>
                            <th>Fungsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenis_ht as $listJenis)
                        <tr id="{{$listJenis->id}}">
                            <td data-target="jenisAlat">{{$listJenis->jenis_ht}}</td>
                            <td data-target="fungsiAlat">{{$listJenis->fungsi_ht}}</td>
                            <td><button data-key-update="{{$listJenis->id}}" data-role="modalUpdateJenisHt" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$listJenis->id}}" data-role="deleteJenisHt" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Jenis HT-->
            <div class="modal fade" id="modalTambahJenisHt" tabindex="-1" role="dialog" aria-labelledby="modalInputUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Data Alat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('tambahJenisAlatBaru')}}" method="POST">
                                @csrf
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
                                    <input type="submit" class="btn btn-primary" value="Tambah Jenis HT Baru"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Jenis HT-->
            <div class="modal fade" id="modalUpdateJenisHt" tabindex="-1" role="dialog" aria-labelledby="modalEditUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdatePenggunaTitle">Update Data Alat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateJenis')}}" method="POST">
                                @csrf
                                <!-- di hidden karena ga perlu user lihat -->
                                <div class="form-group" hidden>
                                    <label for="id_jenis">Id Alat</label>
                                    <input type="text" id="id_jenis" name="id_jenis" class="form-control" readonly>
                                </div>

                                <!-- yang dilihat user -->
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <input type="text" class="form-control" name="updateJenisAlat" id="updateJenisAlat" placeholder="Jenis Alat">
                                </div>
                                <div class="form-group">
                                    <label for="fungsi">Fungsi</label>
                                    <textarea type="text" class="form-control" name="updateFungsiAlat" id="updateFungsiAlat" placeholder="Fungsi Alat"></textarea>
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