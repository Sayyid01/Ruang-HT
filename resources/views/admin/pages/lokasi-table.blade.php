@extends('layouts.master')

@section('title', 'Table Alamat')
@section('title-2', 'Table Alamat')
@section('title-3', 'Table Alamat')

@section('content')

@php
$number = 0;
@endphp

<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Alamat</h6>
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputAlamat">Tambah Alamat</button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Alamat</th>
                            <th>Lokasi</th>
                            <th>Wilayah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alamat as $alamatTable)

                        @php
                        $number++;
                        @endphp

                        <tr id="{{$alamatTable->id}}">
                            <td>{{$number}}</td>
                            <td data-target="alamat">{{$alamatTable->alamat}}</td>
                            <td data-target="lokasi">{{$alamatTable->lokasi}}</td>
                            <td data-target="wilayah">{{$alamatTable->wilayah}}</td>
                            <td><button data-id="{{$alamatTable->id}}" class="btn btn-sm btn-primary" data-role="updateModalLokasi">Edit</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Tambah Alamat Baru -->
            <div class="modal fade" id="modalInputAlamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Alamat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route ('tambahAlamat')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="3" placeholder="Masukkan Alamat Baru" required="required"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <select class="form-control mb-3" name="lokasi" required="required">
                                        <option value="" disabled selected>Pilih Lokasi</option>
                                        @foreach($lokasi as $lokasiSingle)
                                        <option>{{$lokasiSingle->lokasi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target="#modalInputLokasi">Tambah Lokasi</Button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" class="btn btn-primary" value="Tambah Data Alamat"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Lokasi Baru -->
            <div class="modal fade " id="modalInputLokasi" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Lokasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route ('tambahLokasi')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" placeholder="Masukkan Lokasi Baru" required="required"></input>
                                </div>
                                <div class="form-group">
                                    <label for="wilayah">Wilayah</label>
                                    <input type="text" class="form-control" name="wilayah" placeholder="Masukkan Wilayah Baru" required="required"></input>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#modalInputAlamat">Tutup</button>
                                <input type="submit" class="btn btn-primary" value="Tambah Data Lokasi"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Update -->
            <div class="modal fade" id="modalUpdateLokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Alamat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route ('updateLokasi')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group" hidden>
                                    <label for="id_lokasi">Id Alamat</label>
                                    <input type="text" id="id_lokasi_update" name="id_lokasi_update" class="form-control" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat_update" id="alamat_update" rows="3" required="required"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <select class="form-control mb-3" name="lokasi_update" id="lokasi_update" required="required">
                                        <option value="" disabled selected>Pilih Lokasi</option>
                                        @foreach($lokasi as $lokasiSingle)
                                        <option>{{$lokasiSingle->lokasi}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" class="btn btn-primary" value="Simpan perubahan"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection