@extends('layouts.master')

@section('title', 'Table Lokasi')
@section('title-2', 'Table Lokasi')
@section('title-3', 'Table Lokasi')

@section('content')
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Lokasi</h6>
                <a href="#" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#exampleModalCenter">Tambah Lokasi</a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Id</th>
                            <th>Lokasi</th>
                            <th>Wilayah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lokasi as $lokasiTable)
                        <td>{{$lokasiTable->id_lokasi}}</td>
                        <td>{{$lokasiTable->lokasi}}</td>
                        <td>{{$lokasiTable->wilayah}}</td>
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