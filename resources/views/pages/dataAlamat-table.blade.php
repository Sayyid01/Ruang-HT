@extends('layouts.master')

@section('title', 'Data Alamat')
@section('title-2', 'Data Alamat')
@section('title-3', 'Data Alamat')

@section('content')

@php
$number = 0;
$title = $lokasi->lokasi;
@endphp
<div class="row mb-3">
    <div class="col-lg-12 mb-4">

        {{-- DataTable with Hover --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="{{route('assignHtLokasi')}}">
                    <h6 class="m-0 font-weight-bold text-primary">@php echo $title @endphp</h6>
                </a>
            </div>

            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="alamatTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kantor</th>
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
                        $jml_array = count($status);

                        for ($i = 0; $i < $jml_array; $i++){ if(strcmp($status[$i]->id_alamat,$alamat->id) == 0){
                            $jumlahHT++;
                            }
                            }
                            @endphp
                            <tr class='clickable-row' style="cursor:pointer;" data-href="{{route('dataHtPerLokasi-table')}}?alamat={{$alamat->id}}">
                                <td>{{$number}}</td>
                                <td>{{$alamat -> nama_kantor}}</td>
                                <td>{{$alamat -> alamat}}</td>
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