@extends('layouts.master')

@section('title', 'Data Admin')
@section('title-2', 'Data Admin')
@section('title-3', 'Data Admin')

@section('content')

@php
$number = 0;
@endphp

<div class="row mb-3">
    <div class="col-lg-12 mb-4">
        {{-- Simple Tables --}}
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">User</h6>
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputAdmin">Tambah Admin</button>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)

                        @php
                        $number++;
                        @endphp

                        <tr id="{{$admin->id}}">
                            <td>{{$number}}</td>
                            <td data-target="nama">{{$admin->name}}</td>
                            <td data-target="email">{{$admin->email}}</td>
                            <td data-target="created_at">{{$admin->created_at}}</td>
                            <td data-target="updated_at">{{$admin->updated_at}}</td>
                            <td><button data-id="{{$admin->id}}" data-role="modalUpdateAdmin" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$admin->id}}" data-role="deleteAdmin" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Data User-->
            <div class="modal fade" id="modalInputAdmin" tabindex="-1" role="dialog" aria-labelledby="modalInputAdminTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputAdminTitle">Tambah Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('addAdminData')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email kantor" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Harus teridiri dari kombinasi huruf angka dan simbol" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Masukkan kembali password sebelumnya" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Tambah Admin"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Update Data User-->
            <div class="modal fade" id="modalUpdateAdmin" tabindex="-1" role="dialog" aria-labelledby="modalUpdateAdminTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdateAdminTitle">Update Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateAdminData')}}" method="POST">
                                @csrf
                                <!-- hidden -->
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" id="id_user" name="id_user" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="updatenama" name="updatenama" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="updateemail" name="updateemail" placeholder="Email kantor" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Update Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Harus teridiri dari kombinasi huruf angka dan simbol">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmPassword" placeholder="Masukkan kembali password sebelumnya">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <input type="submit" class="btn btn-primary" value="Update Data Admin"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
</div>
@endsection