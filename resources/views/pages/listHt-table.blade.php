@extends('layouts.master')

@section('title', 'List HT')
@section('title-2', 'List HT')
@section('title-3', 'List HT')

@section('content')
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Handy Talkie</h6>
                <a href="#" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputUser">Tambah HT</a>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>SN HT</th>
                            <th>SN Baterai</th>
                            <th>Merk</th>
                            <th>Jenis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($infoHt as $listHt)
                        <tr id="{{$listHt->id}}">
                            <td data-target="snHt">{{$listHt->sn_ht}}</td>
                            <td data-target="snBaterai">{{$listHt->sn_baterai}}</td>
                            <td data-target="merk" data-id="{{$listHt->id_merk_ht}}">{{$listHt->merk_ht}}</td>
                            <td data-target="jenis">{{$listHt->jenis_ht}}</td>
                            <td><button data-id="{{$listHt->id}}" data-role="modalUpdateListHT" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$listHt->id}}" data-role="deleteHt" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Data HT-->
            <div class="modal fade" id="modalInputUser" tabindex="-1" role="dialog" aria-labelledby="modalInputUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Data HT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('tambahHt')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="snHt">SN HT</label>
                                    <input type="text" class="form-control" name="snHt" placeholder="SerialNumber HT" required>
                                </div>
                                <div class="form-group">
                                    <label for="snBaterai">SN Baterai</label>
                                    <input type="text" class="form-control" name="snBaterai" placeholder="SerialNumber Baterai" required>
                                </div>
                                <div class="form-group">
                                    <label for="merk">Merk HT</label>
                                    <select class="form-control mb-3" name="merk" required>
                                        <option value="" disabled selected>Pilih Merk HT</option>
                                        @foreach($merkHt as $merk)
                                        <option value="{{$merk->id}}">{{$merk->merk_ht}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Tambah Data HT"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data HT-->
            <div class="modal fade" id="modalUpdateListHT" tabindex="-1" role="dialog" aria-labelledby="modalEditUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdatePenggunaTitle">Update Data HT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateHt')}}" method="POST">
                                @csrf
                                <!-- di hidden karena ga perlu dilihat user -->
                                <div class="form-group" hidden>
                                    <label for="id_ht">Id HT</label>
                                    <input type="text" id="id_ht" name="id_ht" class="form-control" readonly>
                                </div>

                                <!-- yang ditampilin -->
                                <div class="form-group">
                                    <label for="updateSnHt">SN HT</label>
                                    <input type="text" class="form-control" id="updateSnHt" name="updateSnHt" placeholder="SerialNumber HT" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateSnBaterai">SN Baterai</label>
                                    <input type="text" class="form-control" id="updateSnBaterai" name="updateSnBaterai" placeholder="SerialNumber Baterai" required>
                                </div>
                                <div class="form-group">
                                    <label for="updateMerk">Merk HT</label>
                                    <select class="form-control mb-3" id="updateMerk" name="updateMerk" required>
                                        <option value="" disabled selected>Pilih Merk HT</option>
                                        @foreach($merkHt as $merk)
                                        <option value="{{$merk->id}}">{{$merk->merk_ht}}</option>
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