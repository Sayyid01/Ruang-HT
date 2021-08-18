@extends('layouts.master')

@section('title', 'Data User')
@section('title-2', 'Data User')
@section('title-3', 'Data User')

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
                <button class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#modalInputUser">Tambah User</button>
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
                        @foreach($users as $user)

                        @php
                        $number++;
                        @endphp

                        <tr id="{{$user->id}}">
                            <td>{{$number}}</td>
                            <td data-target="nama">{{$user->name}}</td>
                            <td data-target="email">{{$user->email}}</td>
                            <td data-target="created_at">{{$user->created_at}}</td>
                            <td data-target="updated_at">{{$user->updated_at}}</td>
                            <td><button data-id="{{$user->id}}" data-role="modalUpdateUser" class="btn btn-sm btn-primary">Edit</button>
                                <button data-id="{{$user->id}}" data-role="deleteUser" class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Insert Data User-->
            <div class="modal fade" id="modalInputUser" tabindex="-1" role="dialog" aria-labelledby="modalInputUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalInputUserTitle">Tambah Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('addUserData')}}" method="POST">
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
                                    <input type="submit" class="btn btn-primary" value="Tambah User"></input>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Update Data User-->
            <div class="modal fade" id="modalUpdateUser" tabindex="-1" role="dialog" aria-labelledby="modalUpdateUserTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUpdateUserTitle">Update Data User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('updateUserData')}}" method="POST">
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
                                    <input type="submit" class="btn btn-primary" value="Update Data User"></input>
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