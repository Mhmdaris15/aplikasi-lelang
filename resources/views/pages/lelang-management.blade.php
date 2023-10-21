@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Lelang Management'])
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
            <div class="alert alert-light" status="alert">
                You can control the lelang's status and permission here.
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0 w-full">
                    <h6 class="">Lelang</h6>
                    <button type="button" class="btn btn-success text-sm font-weight-bold mb-0" data-bs-toggle="modal"
                        data-bs-target="#modal-form-add-lelang">Add Lelang</button>
                    <div class="col-md-4">
                        <div class="modal fade" id="modal-form-add-lelang" tabindex="-1" status="dialog"
                            aria-labelledby="modal-form-add-lelang" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" status="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">
                                                    Tambah Lelang</h3>
                                                <p class="mb-0">
                                                    Silahkan isi form berikut untuk menambahkan lelang baru
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <form status="form text-left" method="POST"
                                                    action="{{ route('lelang.store') }}">
                                                    @csrf
                                                    <label>Barang</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="id_barang" id="id_barang">
                                                            @foreach ($barangs as $barang)
                                                                <option value="{{ $barang->id }}">
                                                                    {{ $barang->nama_barang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label>Petugas</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="id_petugas" id="id_petugas">
                                                            @foreach ($petugas as $petugass)
                                                                <option value="{{ $petugass->id }}">
                                                                    {{ $petugass->firstname }}
                                                                    {{ $petugass->lastname }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <label>Masyarakat</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="id_user" id="id_user">
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->firstname }}
                                                                    {{ $user->lastname }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <label>Tanggal</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" class="form-control" name="tanggal"
                                                            placeholder="Tanggal" aria-label="Tanggal"
                                                            aria-describedby="tanggal-addon">
                                                    </div>
                                                    <label>Harga Akhir</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" name="harga_akhir"
                                                            placeholder="Harga Akhir" aria-label="Harga Akhir"
                                                            aria-describedby="harga_akhir-addon">
                                                    </div>

                                                    <label for="status">Role</label>
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="dibuka">
                                                            Dibuka</option>
                                                        <option value="ditutup">
                                                            Ditutup</option>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        User
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Petugas
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Harga Akhir
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lelangs as $lelang)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">

                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $lelang->barang->nama_barang }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $lelang->user->firstname }}
                                                {{ $lelang->user->lastname }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $lelang->petugas->firstname }}
                                                {{ $lelang->petugas->lastname }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $lelang->tanggal }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $lelang->harga_akhir }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $lelang->status }}</p>
                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 gap-2 justify-content-center align-items-center">
                                                <button type="button" class="btn btn-success text-sm font-weight-bold mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-form-{{ $lelang->id }}">Edit</button>
                                                <form action="/lelang/{{ $lelang->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $lelang->id }}">
                                                    <button
                                                        class="btn btn-danger text-sm font-weight-bold mb-0">Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                        <div class="col-md-4">
                                            <div class="modal fade" id="modal-form-{{ $lelang->id }}" tabindex="-1"
                                                status="dialog" aria-labelledby="modal-form-{{ $lelang->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md"
                                                    status="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header pb-0 text-left">
                                                                    <h3 class="font-weight-bolder text-info text-gradient">
                                                                        Edit Lelang</h3>
                                                                    <p class="mb-0">
                                                                        Silahkan isi form berikut untuk mengedit lelang baru
                                                                    </p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form status="form text-left" method="POST"
                                                                        action="{{ route('lelang.update', $lelang->id) }}">
                                                                        @csrf @method('PATCH') <input type="hidden"
                                                                            name="id" value="{{ $lelang->id }}">
                                                                        <label>Barang</label>
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control" name="id_barang"
                                                                                id="id_barang">
                                                                                @foreach ($barangs as $barang)
                                                                                    <option value="{{ $barang->id }}"
                                                                                        @if ($barang->id == $lelang->id_barang) selected @endif>
                                                                                        {{ $barang->nama_barang }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <label>Petugas</label>
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control" name="id_petugas"
                                                                                id="id_petugas">
                                                                                @foreach ($petugas as $petugass)
                                                                                    <option value="{{ $petugass->id }}"
                                                                                        @if ($petugass->id == $lelang->id_petugas) selected @endif>
                                                                                        {{ $petugass->firstname }}
                                                                                        {{ $petugass->lastname }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <label>Masyarakat</label>
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control" name="id_user"
                                                                                id="id_user">
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id }}"
                                                                                        @if ($user->id == $lelang->id_user) selected @endif>
                                                                                        {{ $user->firstname }}
                                                                                        {{ $user->lastname }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <label>Tanggal</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal" placeholder="Tanggal"
                                                                                value="{{ $lelang->tanggal }}"
                                                                                aria-label="Tanggal"
                                                                                aria-describedby="tanggal-addon">
                                                                        </div>
                                                                        <label>Harga Akhir</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="number" class="form-control"
                                                                                name="harga_akhir"
                                                                                value="{{ $lelang->harga_akhir }}"
                                                                                placeholder="Harga Akhir"
                                                                                aria-label="Harga Akhir"
                                                                                aria-describedby="harga_akhir-addon">
                                                                        </div>

                                                                        <label for="status">Role</label>
                                                                        <select class="form-control" id="status"
                                                                            name="status">
                                                                            <option value="dibuka"
                                                                                @if ($lelang->status == 'dibuka') selected @endif>
                                                                                Dibuka</option>
                                                                            <option value="ditutup"
                                                                                @if ($lelang->status == 'ditutup') selected @endif>
                                                                                Ditutup</option>
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
