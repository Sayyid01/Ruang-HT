@extends('layouts.master')

@section('title', 'Alamat Assign HT')
@section('title-2', 'Alamat Assign HT')
@section('title-3', 'Alamat Assign HT')

@section('content')

@php
$number = 0;
$lokasi = $_GET['lokasi'];
@endphp
<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{route('assignHtLokasi')}}">
                    <h6 class="m-0 font-weight-bold text-primary">@php echo $lokasi @endphp</h6>
                </a>
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputAlamat">Tambah Alamat</button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Alamat</th>
                            <th>Total HT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alamat as $alamat)
                        <!-- Number Counter -->
                        @php
                        $number++;
                        @endphp

                        <!-- Menghitung jumlah total ht dalam suatu alamat -->
                        @php
                        $jumlahHT = 0;
                        $jml_array = count($lokasi_status);

                        for ($i = 0; $i < $jml_array; $i++){ if(strcmp($lokasi_status[$i]->alamat_ht,$alamat->alamat) == 0){
                            $jumlahHT++;
                            }
                            }
                            @endphp
                            <tr>
                                <td>{{$number}}</td>
                                <td><a href="{{route('assignHt')}}?alamat={{$alamat->alamat}}">{{$alamat -> alamat}}</a></td>
                                <td>{{$jumlahHT}}</td>
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
                            </div>
                            <input class="form-control mb-3" name="lokasi" value="@php echo $lokasi @endphp" hidden></input>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <input type="submit" class="btn btn-primary" value="Tambah Data Alamat"></input>
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