@extends('layouts.master')

@section('title', 'RuangAdmin Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')

@section('content')
<div class="row mb-3">

    @foreach($lokasi as $lokasi)
    <!-- Card Info HT per wilayah -->
    <div class="col-3 col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2 ">

                        <div class="container ml-n4">
                            <a href="{{ route('dataAlamat-table') }}?lokasi={{$lokasi->id}}">
                                <div class="h4 font-weight-bold text-uppercase mb-2">{{$lokasi->lokasi}}, {{$lokasi->wilayah}}</div>
                            </a>

                            <div class="row ">
                                <p class="col-md-4 h5 font-weight-bold  text-gray-800">Jumlah HT :</p>
                                <!-- Menghitung jumlah total ht aktif dalam suatu lokasi -->
                                @php
                                $jumlahHT = 0;
                                $jml_array = count($status);

                                for ($i = 0; $i < $jml_array; $i++)
                                    { 
                                        if(strcmp($status[$i]->id_lokasi,$lokasi->id) == 0)
                                        {
                                            $jumlahHT++;
                                        }
                                    }
                                @endphp
                                    <p class="h5 mb-0 ml-n4 font-weight-bold text-gray-800">{{$jumlahHT}}</p>
                            </div>

                            <p class="h6 font-weight-bold  text-gray-800 mb-0">Status HT</p>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class='badge badge-success d-flex justify-content-center'>Normal</span>
                                    </div>
                                    <!-- Menghitung jumlah total ht aktif dalam suatu lokasi -->
                                    @php
                                    $jumlahHT = 0;
                                    $jml_array = count($status);

                                    for ($i = 0; $i < $jml_array; $i++)
                                    { 
                                        if(strcmp($status[$i]->id_lokasi,$lokasi->id) == 0  && $status[$i]->status == 0)
                                        {
                                            $jumlahHT++;
                                        }
                                    }
                                    @endphp
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 d-flex justify-content-center">{{$jumlahHT}}</div>
                                </div>
                                <div class="col-md-2 col-md-offset-2">
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class='badge badge-warning d-flex justify-content-center'>Rusak</span>
                                    </div>
                                    <!-- Menghitung jumlah total ht aktif dalam suatu lokasi -->
                                    @php
                                    $jumlahHT = 0;
                                    $jml_array = count($status);

                                    for ($i = 0; $i < $jml_array; $i++)
                                    { 
                                        if(strcmp($status[$i]->id_lokasi,$lokasi->id) == 0  && $status[$i]->status == 1)
                                        {
                                            $jumlahHT++;
                                        }
                                    }
                                    @endphp
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 d-flex justify-content-center">{{$jumlahHT}}</div>
                                </div>
                                <div class="col-md-2 col-md-offset-2">
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class='badge badge-primary d-flex justify-content-center'>Diperbaiki</span>
                                    </div>
                                    <!-- Menghitung jumlah total ht aktif dalam suatu lokasi -->
                                    @php
                                    $jumlahHT = 0;
                                    $jml_array = count($status);

                                    for ($i = 0; $i < $jml_array; $i++)
                                    { 
                                        if(strcmp($status[$i]->id_lokasi,$lokasi->id) == 0  && $status[$i]->status == 2)
                                        {
                                            $jumlahHT++;
                                        }
                                    }
                                    @endphp
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 d-flex justify-content-center">{{$jumlahHT}}</div>
                                </div>
                                <div class="col-md-2 col-md-offset-2">
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class='badge badge-danger d-flex justify-content-center'>Hilang</span>
                                    </div>
                                    <!-- Menghitung jumlah total ht aktif dalam suatu lokasi -->
                                    @php
                                    $jumlahHT = 0;
                                    $jml_array = count($status);

                                    for ($i = 0; $i < $jml_array; $i++)
                                    { 
                                        if(strcmp($status[$i]->id_lokasi,$lokasi->id) == 0  && $status[$i]->status == 3)
                                        {
                                            $jumlahHT++;
                                        }
                                    }
                                    @endphp
                                        <div class="h5 mb-0 font-weight-bold text-gray-800 d-flex justify-content-center">{{$jumlahHT}}</div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@push('js')
<script src="{{ asset('dist/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script>
@endpush