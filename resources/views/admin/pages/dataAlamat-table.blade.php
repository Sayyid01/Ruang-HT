@extends('layouts.master')

@section('title', 'Data Alamat')
@section('title-2', 'Data Alamat')
@section('title-3', 'Data Alamat')

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
                <a href="{{route('index')}}"><h6 class="m-0 font-weight-bold text-primary">@php echo $lokasi @endphp</h6></a>
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
                        
                        for ($i = 0; $i < $jml_array; $i++){
                            if(strcmp($lokasi_status[$i]->alamat_ht,$alamat->alamat) == 0){
                                $jumlahHT++;
                            }
                        }
                        @endphp
                        <tr>
                            <td>{{$number}}</td>
                            <td><a href="{{route('dataHtPerLokasi-table')}}?alamat={{$alamat->alamat}}">{{$alamat -> alamat}}</a></td>
                            <td>{{$jumlahHT}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection