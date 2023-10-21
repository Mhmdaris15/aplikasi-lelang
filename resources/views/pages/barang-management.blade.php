@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Barang Management'])
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
                You can control the barang's role and permission here.
            </div>
            <div class="card mb-4">
                <div class="card-header pb-0 w-full">
                    <h6 class="">Barang</h6>
                    <button type="button" class="btn btn-success text-sm font-weight-bold mb-0" data-bs-toggle="modal"
                        data-bs-target="#modal-form-add-barang">Add Barang</button>
                    <div class="col-md-4">
                        <div class="modal fade" id="modal-form-add-barang" tabindex="-1" role="dialog"
                            aria-labelledby="modal-form-add-barang" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="card card-plain">
                                            <div class="card-header pb-0 text-left">
                                                <h3 class="font-weight-bolder text-info text-gradient">
                                                    Tambah Barang</h3>
                                                <p class="mb-0">Masukkan data barang yang akan ditambahkan</p>
                                            </div>
                                            <div class="card-body">
                                                <form role="form text-left" method="POST" action="/barang"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <label>Nama Barang</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="nama_barang"
                                                            placeholder="Nama Barang" aria-label="Nama Barang"
                                                            aria-describedby="nama_barang-addon" value="">
                                                    </div>
                                                    <label>Harga Barang</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" name="harga"
                                                            placeholder="Harga Barang" aria-label="Harga Barang"
                                                            aria-describedby="harga-addon" value="0">
                                                    </div>
                                                    <label>Tanggal</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" class="form-control" name="tanggal"
                                                            placeholder="Tanggal" aria-label="Tanggal"
                                                            aria-describedby="tanggal-addon" value="">
                                                    </div>
                                                    <label>Deskripsi</label>
                                                    <div class="input-group mb-3">
                                                        <textarea type="text" class="form-control" name="deskripsi" placeholder="deskripsi" aria-label="deskripsi"
                                                            aria-describedby="deskripsi-addon"></textarea>
                                                    </div>
                                                    <label>Foto</label>
                                                    <div class="input-group mb-3">
                                                        <input type="file" class="form-control" name="foto"
                                                            placeholder="foto" aria-label="foto"
                                                            aria-describedby="foto-addon">
                                                    </div>

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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        Barang
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Harga
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Deskripsi</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Foto</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $barang->nama_barang }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $barang->harga }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $barang->tanggal }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $barang->deskripsi }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <img src="{{ url('storage/images/' . $barang->foto) }}" class="img-thumbnail"
                                                alt="{{ $barang->nama_barang }} Photo">

                                        </td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 gap-2 justify-content-center align-items-center">
                                                <button type="button" class="btn btn-success text-sm font-weight-bold mb-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modal-form-{{ $barang->id }}">Edit</button>
                                                <form action="/barang/{{ $barang->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $barang->id }}">
                                                    <button
                                                        class="btn btn-danger text-sm font-weight-bold mb-0">Delete</button>
                                                </form>
                                            </div>
                                        </td>

                                        <div class="col-md-4">
                                            <div class="modal fade" id="modal-form-{{ $barang->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="modal-form-{{ $barang->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                            <div class="card card-plain">
                                                                <div class="card-header pb-0 text-left">
                                                                    <h3 class="font-weight-bolder text-info text-gradient">
                                                                        Edit Barang</h3>
                                                                    <p class="mb-0">Edit data barang yang akan diubah</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form role="form text-left" method="POST"
                                                                        action="/barang/{{ $barang->id }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $barang->id }}">
                                                                        <label>Nama Barang</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="nama_barang"
                                                                                placeholder="Nama Barang"
                                                                                aria-label="Nama Barang"
                                                                                aria-describedby="nama_barang-addon"
                                                                                value="{{ $barang->nama_barang }}">
                                                                        </div>
                                                                        <label>Harga Barang</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="number" class="form-control"
                                                                                name="harga" placeholder="Harga Barang"
                                                                                aria-label="Harga Barang"
                                                                                aria-describedby="harga-addon"
                                                                                value="{{ $barang->harga }}">
                                                                        </div>
                                                                        <label>Tanggal</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal" placeholder="Tanggal"
                                                                                aria-label="Tanggal"
                                                                                aria-describedby="tanggal-addon"
                                                                                value="{{ $barang->tanggal }}">
                                                                        </div>
                                                                        <label>Deskripsi</label>
                                                                        <div class="input-group mb-3">
                                                                            <textarea type="text" class="form-control" name="deskripsi" placeholder="deskripsi" aria-label="deskripsi"
                                                                                aria-describedby="deskripsi-addon">{{ $barang->deskripsi }}</textarea>
                                                                        </div>
                                                                        <label>Foto</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="file" class="form-control"
                                                                                name="foto" placeholder="foto"
                                                                                aria-label="foto"
                                                                                aria-describedby="foto-addon"
                                                                                value="{{ $barang->foto }}">
                                                                        </div>

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
