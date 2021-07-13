@extends('layouts.master')

@section('title', 'Lokasi Assign HT')
@section('title-2', 'Lokasi Assign HT')
@section('title-3', 'Lokasi Assign HT')

@section('content')
<div class="row mb-3">

    @foreach($lokasi as $lok)
    <!-- Card Info HT per wilayah -->
    <div class="col-3 col-lg-5 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2 ">
                        <a href="{{ route('assignHtAlamat') }}?lokasi={{$lok->lokasi}}">
                            <div class="text-s font-weight-bold text-uppercase mb-1">{{$lok->lokasi}}, {{$lok->wilayah}}</div>
                        </a>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <span>Total HT</span>
                        </div>

                        <!-- Menghitung jumlah total ht dalam suatu lokasi -->
                        @php
                        $jumlahHT = 0;
                        $jml_array = count($status);

                        for ($i = 0; $i < $jml_array; $i++){ if(strcmp($status[$i]->lokasi,$lok->lokasi) == 0){
                            $jumlahHT++;
                            }
                            }
                            @endphp

                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jumlahHT}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-3 col-lg-5 mb-4">
        <div class="card h-100">
            <button class="card-body btn btn-success" data-toggle="modal" title="Tambah Lokasi Baru" data-target="#modalInputLokasi">
                <div class="align-items-center">
                    <i class="fas fa-plus fa-4x"></i>
            </button>
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


@endsection

@push('js')
<script src="{{ asset('dist/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script>
@endpush