@extends('layouts.master')

@section('title', 'Forms Data Reference')
@section('title-2', 'Forms Data Reference')
@section('title-3', 'Forms Data Reference')

@section('content')
<div class="row mb-3">
    <div class="col-lg-6">
        {{-- Tambah Lokasi --}}
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Lokasi</h6>
            </div>
            <div class="card-body">
                <form action="forms-datareference/submitLokasi" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputWilayah">Wilayah</label>
                        <input type="text" name="wilayah" class="form-control" id="inputWIlayah" placeholder="Masukkan wilayah" required>
                    </div>
                    <div class="form-group">
                        <label for="inputLokasi">Alamat Lokasi</label>
                        <textarea type="text" name="lokasi" class="form-control" id="inputLokasi" maxlength="500" placeholder="Masukkan alamat lokasi" required></textarea>
                        <div id="countLokasi">
                            <span id="current_countLokasi">0</span>
                            <span id="maximum_countLokasi">/ 500</span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        {{-- Tambah Janis HT --}}
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Jenis HT</h6>
            </div>
            <div class="card-body">
                <form action="forms-datareference/submitJenisHT" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputJenisHT">Jenis HT</label>
                        <input type="text" name="jenisHt" class="form-control" id="inputJenisHT" placeholder="Masukkan jenis ht" required>
                    </div>
                    <div class="form-group">
                        <label for="inputFungsiAlat">Fungsi Alat</label>
                        <textarea type="text" name="fungsiAlat" class="form-control" id="inputFungsiAlat" maxlength="500" placeholder="Masukkan fungsi alat" required></textarea>
                        <div id="countJenisHT">
                            <span id="current_countJenisHT">0</span>
                            <span id="maximum_countJenisHT">/ 500</span>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection