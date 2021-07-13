@extends('layouts.master')

@section('title', 'Assign HT')
@section('title-2', 'Assign HT')
@section('title-3', 'Assign HT')

@section('content')
@php
$number = 0;
$lokasi = $_GET['alamat'];

@endphp
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@php echo $lokasi @endphp</h6>
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalAssignHt">Assign HT</button>
            </div>

            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Alokasi</th>
                            <th>Tanggal Penarikan</th>
                            <th>SN HT</th>
                            <th>Pengguna</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($status as $status)
                        @php
                        $number++;
                        @endphp
                        <tr id="{{$status->id_status}}">
                            <td>{{$number}}</td>
                            <td>{{$status->tanggal_alokasi}}</td>
                            <td data-target="tanggalPenarikan">{{$status->tanggal_penarikan}}</td>
                            <td>{{$status -> sn_ht}}</td>
                            <td data-target="pengguna">{{$status -> pengguna}}</td>
                            @php
                            if($status -> status == 0){
                            echo "<td><span class='badge badge-success'>Aktif</span></td>";
                            }else{
                            echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                            }
                            @endphp
                            <td>
                                <button data-id="{{$status->id_status}}" class="btn btn-sm btn-warning" data-role="updateAssignData" data-toggle="modal">Edit</button>
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
                        <form action="{{route ('tambahAssignedHt')}}" method="POST">
                            @csrf
                            <!-- tidak dilihat pengguna -->
                            <input type="text" name="alamat" value="@php echo $lokasi @endphp" hidden></input>

                            <!-- dilihat pengguna -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="tanggalAlokasi">Tanggal Alokasi</label>
                                    <input class="form-control" type="date" name="tanggalAlokasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalPenarikan">Tanggal Penarikan</label>
                                    <input class="form-control" type="date" name="tanggalPenarikan">
                                </div>
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
                                        <option value="" disabled selected>Pilih Pengguna</option>
                                        @foreach($pengguna as $updatePengguna)
                                        <option>{{$updatePengguna->nama_pengguna}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control mb-3" name="status" required="required">
                                        <option value="0" selected>Aktif</option>
                                        <option value="1">Nonaktif</option>
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
                                    <label for="tanggalPenarikan">Tanggal Penarikan</label>
                                    <input class="form-control" type="date" id="updateTanggalPenarikan" name="updateTanggalPenarikan">
                                </div>
                                <div class="form-group">
                                    <label for="pengguna">Pengguna</label>
                                    <select class="form-control mb-3" id="updatePengguna" name="updatePengguna" required="required">
                                        <option value="" disabled selected>Pilih Pengguna</option>
                                        @foreach($pengguna as $updatePengguna)
                                        <option>{{$updatePengguna->nama_pengguna}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control mb-3" id="updateStatus" name="updateStatus" required="required">
                                        <option value="0" selected>Aktif</option>
                                        <option value="1">Nonaktif</option>
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