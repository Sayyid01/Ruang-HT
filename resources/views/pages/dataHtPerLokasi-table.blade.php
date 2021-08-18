@extends('layouts.master')

@section('title', 'Data HT')
@section('title-2', 'Data HT')
@section('title-3', 'Data HT')

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
                            <td data-target="pengguna">{{$status -> nama}}</td>
                            <td data-target="tanggal_alokasi">{{$status->tanggal_alokasi}}</td>
                            <td data-target="surat_terima"><a href="{{route('getFile', $status->surat_terima)}}" target="_blank">{{$status->surat_terima}}</a></td>
                            @php
                            if($status -> status == 0){
                            echo "<td><span class='badge badge-success'>Aktif</span></td>";
                            }else{
                            echo "<td><span class='badge badge-danger'>Nonaktif</span></td>";
                            }
                            @endphp
                            <td>
                                <a href="{{ route('detailHt-table') }}?sn_ht={{$status -> sn_ht}}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
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