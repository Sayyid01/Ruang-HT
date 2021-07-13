@extends('layouts.master')

@section('title', 'RuangAdmin Dashboard')
@section('title-2', 'Dashboard')
@section('title-3', 'Dashboard')

@section('content')
<div class="row mb-3">

    @foreach($lokasi as $lok)
    <!-- Card Info HT per wilayah -->
    <div class="col-3 col-lg-5 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2 ">
                        <a href="{{ route('dataAlamat-table') }}?lokasi={{$lok->lokasi}}">
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
</div>

@endsection

@push('js')
<script src="{{ asset('dist/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('dist/js/demo/chart-area-demo.js') }}"></script>
@endpush