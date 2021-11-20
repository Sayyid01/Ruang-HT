@extends('layouts.master')

@section('title', 'Assign HT')
@section('title-2', 'Assign HT')
@section('title-3', 'Assign HT')

@section('content')
@php
$number = 0;
$title = $alamat->alamat;
@endphp
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@php echo $title @endphp</h6>
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalAssignHt">Assign HT</button>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>SN HT</th>
                            <th>Pengguna</th>
                            <th>Tanggal Alokasi</th>
                            <th>Bukti Serah Terima</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($status as $status)
                        @php
                        $number++;
                        @endphp
                        <tr id="{{$status->id}}">
                            <td>{{$number}}</td>
                            <td>{{$status -> sn_ht}}</td>
                            <td data-target="pengguna" data-value="{{$status->id_pengguna_ht}}">{{$status -> nama}}</td>
                            <td>{{$status->tanggal_alokasi}}</td>
                            <td data-target="surat_terima"><a href="{{route('getFile', $status->surat_terima)}}" target="_blank">{{$status->surat_terima}}</a></td>
                            @php
                            switch($status->status){
                            case 0:
                            echo "<td><span class='badge badge-success'>Normal</span></td>";
                            break;
                            case 1:
                            echo "<td><span class='badge badge-warning'>Rusak</span></td>";
                            break;
                            case 2:
                            echo "<td><span class='badge badge-primary'>Diperbaiki</span></td>";
                            break;
                            case 3:
                            echo "<td><span class='badge badge-danger'>Hilang</span></td>";
                            break;
                            default:
                            echo "<td><span class='badge badge-success'>Normal</span></td>";
                            }
                            @endphp
                            <td>
                                <button data-id="{{$status->id}}" class="btn btn-sm btn-warning" data-role="updateAssignData" data-toggle="modal">Edit</button>
                                <a href="{{ route('assignmentHtDetail') }}?sn_ht={{$status -> sn_ht}}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Assign HT -->
            <div class="modal fade" id="modalAssignHt" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Assign HT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route ('tambahAssignedHt')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- tidak dilihat pengguna -->
                            <input type="text" name="alamat" value="{{$alamat->id}}" hidden></input>

                            <!-- dilihat pengguna -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="snHt">SN HT</label>
                                    <select class="form-control mb-3" name="snHt" required="required">
                                        <option value="" disabled selected>Pilih HT</option>
                                        @foreach($infoHt as $updateInfoHt)
                                        <option>{{$updateInfoHt->sn_ht}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pengguna">Pengguna</label>
                                    <select class="form-control mb-3" name="pengguna" required="required">
                                        <option disabled selected>Pilih Pengguna</option>
                                        @foreach($pengguna as $pengguna)
                                        <option value="{{$pengguna->id}}">{{$pengguna->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalAlokasi">Tanggal Alokasi</label>
                                    <input class="form-control" type="date" name="tanggalAlokasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="file">Upload Berkas</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="file" id="file">
                                        <label class="custom-file-label" for="file">Masukkan bukti serah terima</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control mb-3" name="status" required="required">
                                        <option value="0" selected>Normal</option>
                                        <option value="1">Rusak</option>
                                        <option value="2">Diperbaiki</option>
                                        <option value="3">Hilang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" class="btn btn-primary" value="Alokasikan HT"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal update data assign -->
            <div class="modal fade" id="modalUpdateAssignData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Assign Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('updateAssignedHt')}}" method="POST">
                            @csrf
                            <!-- tidak dilihat pengguna -->
                            <input type="text" id="idStatus" name="idStatus" hidden></input>

                            <!-- dilihat pengguna -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="pengguna">Pengguna</label>
                                    <select class="form-control mb-3" id="updatePengguna" name="updatePengguna" required="required">
                                        <option value="" disabled selected>Pilih Pengguna</option>
                                        @foreach($penggunaUpdate as $updatePengguna)
                                        <option value="{{$updatePengguna->id}}">{{$updatePengguna->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control mb-3" id="updateStatus" name="updateStatus" required="required">
                                        <option value="0" selected>Normal</option>
                                        <option value="1">Rusak</option>
                                        <option value="2">Diperbaiki</option>
                                        <option value="3">Hilang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" class="btn btn-primary" value="Simpan Perubahan"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>

@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
@endsection