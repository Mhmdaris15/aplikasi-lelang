@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="alert alert-light" role="alert">
                You can control the user's role and permission here.
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0 w-full">
                    <h6 class="">Users</h6>
                    <button type="button" class="btn btn-success text-sm font-weight-bold mb-0" data-bs-toggle="modal"
                        data-bs-target="#modal-form-add-user">Add User</button>
                    <div class="col-md-4">
                        <div class="modal fade" id="modal-form-add-user" tabindex="-1" role="dialog"
                            aria-labelledby="modal-form-add-user" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">
                                                    Tambah User</h3>
                                                <p class="mb-0">
                                                    Tambah User Data yang ingin ditambahkan
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form role="form text-left" method="POST" action="/user">
                                                    @csrf
                                                    <label>Firstname</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="firstname"
                                                            placeholder="Firstname" aria-label="Firstname"
                                                            aria-describedby="firstname-addon" value="">
                                                    </div>
                                                    <label>Lastname</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="lastname"
                                                            placeholder="Lastname" aria-label="Lastname"
                                                            aria-describedby="lastname-addon" value="">
                                                    </div>
                                                    <label>Username</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="username"
                                                            placeholder="Username" aria-label="Username"
                                                            aria-describedby="username-addon" value="">
                                                    </div>
                                                    <label>Email</label>
                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="Email" aria-label="Email"
                                                            aria-describedby="email-addon" value="">
                                                    </div>
                                                    <label>Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="Password" aria-label="Password"
                                                            aria-describedby="password-addon" value="">
                                                    </div>
                                                    <label>Nomor Telepon</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="phone"
                                                            placeholder="Nomor Telepon" aria-label="Nomor Telepon"
                                                            aria-describedby="phone-addon" value="">
                                                    </div>
                                                    <label>Address</label>
                                                    <div class="input-group mb-3">
                                                        <textarea type="text" class="form-control" name="address" placeholder="address" aria-label="address"
                                                            aria-describedby="address-addon"></textarea>
                                                    </div>
                                                    <label for="role">Role</label>
                                                    <select class="form-control" id="role" name="role">
                                                        <option value="admin">
                                                            Admin</option>
                                                        <option value="petugas">
                                                            Petugas</option>
                                                        <option value="user">
                                                            Masyarakat</option>
                                                    </select>
                                                    <div class="text-center">
                                                        <button type="submit"
                                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                                            Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Role
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Address</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->firstname }} {{ $user->lastname }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->username }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->role }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->phone }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->address }}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 gap-2 justify-content-center align-items-center">
                                                <button type="button"
                                                    class="btn btn-success text-sm font-weight-bold mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-form-{{ $user->id }}">Edit</button>
                                                <form action="/user/{{ $user->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <button
                                                        class="btn btn-danger text-sm font-weight-bold mb-0">Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                        <div class="col-md-4">
                                            <div class="modal fade" id="modal-form-{{ $user->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modal-form-{{ $user->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header pb-0 text-left">
                                                                    <h3 class="font-weight-bolder text-info text-gradient">
                                                                        Edit User</h3>
                                                                    <p class="mb-0">
                                                                        Edit User Data yang ingin diubah
                                                                    </p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form role="form text-left" method="POST"
                                                                        action="/user/{{ $user->id }}">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $user->id }}">
                                                                        <label>Firstname</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="firstname" placeholder="Firstname"
                                                                                aria-label="Firstname"
                                                                                aria-describedby="firstname-addon"
                                                                                value="{{ $user->firstname }}">
                                                                        </div>
                                                                        <label>Lastname</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="lastname" placeholder="Lastname"
                                                                                aria-label="Lastname"
                                                                                aria-describedby="lastname-addon"
                                                                                value="{{ $user->lastname }}">
                                                                        </div>
                                                                        <label>Username</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="username" placeholder="Username"
                                                                                aria-label="Username"
                                                                                aria-describedby="username-addon"
                                                                                value="{{ $user->username }}">
                                                                        </div>
                                                                        <label>Email</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="email" class="form-control"
                                                                                name="email" placeholder="Email"
                                                                                aria-label="Email"
                                                                                aria-describedby="email-addon"
                                                                                value="{{ $user->email }}">
                                                                        </div>
                                                                        <label>Nomor Telepon</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="phone" placeholder="Nomor Telepon"
                                                                                aria-label="Nomor Telepon"
                                                                                aria-describedby="phone-addon"
                                                                                value="{{ $user->phone }}">
                                                                        </div>
                                                                        <label>Address</label>
                                                                        <div class="input-group mb-3">
                                                                            <textarea type="text" class="form-control" name="address" placeholder="address" aria-label="address"
                                                                                aria-describedby="address-addon">{{ $user->address }}</textarea>
                                                                        </div>
                                                                        <label for="role">Role</label>
                                                                        <select class="form-control" id="role"
                                                                            name="role">
                                                                            <option value="admin"
                                                                                @if ($user->role == 'admin') selected @endif>
                                                                                Admin</option>
                                                                            <option value="petugas"
                                                                                @if ($user->role == 'petugas') selected @endif>
                                                                                Petugas</option>
                                                                            <option value="user"
                                                                                @if ($user->role == 'user') selected @endif>
                                                                                Masyarakat</option>
                                                                        </select>
                                                                        <div class="text-center">
                                                                            <button type="submit"
                                                                                class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                                                                Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                                                    <p class="mb-4 text-sm mx-auto">
                                                                        Don't have an account?
                                                                        <a href="javascript:;"
                                                                            class="text-info text-gradient font-weight-bold">Sign
                                                                            up</a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    </div>

                    </tr>
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
