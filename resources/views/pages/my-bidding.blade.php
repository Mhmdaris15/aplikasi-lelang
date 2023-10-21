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
            <div class="bg-light mb-4 d-flex flex-wrap justify-content-between items-center gap-x-5 gap-y-1">
                @foreach ($myBiddings as $bidding)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('storage/images/' . $bidding->lelang->barang->foto) }}" class="card-img-top"
                            alt="Lelang">
                        <div class="card-body">
                            <h5 class="card-title">Lelang {{ $bidding->lelang->barang->nama_barang }}</h5>
                            <p class="card-text">
                                Harga Penawaran :
                                @if ($bidding->penawaran_harga)
                                    {{ $bidding->penawaran_harga }}
                                @else
                                    0
                                @endif
                            </p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-form-bidding-{{ $bidding->lelang->id }}">Bidding</button>
                        </div>
                        <div class="col-md-4">
                            <div class="modal fade" id="modal-form-bidding-{{ $bidding->lelang->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="modal-form-bidding-{{ $bidding->lelang->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card card-plain">
                                                <div class="card-header pb-0 text-left">
                                                    <h3 class="font-weight-bolder text-info text-gradient">
                                                        Bidding Harga
                                                    </h3>
                                                    <p class="mb-0">
                                                        Silahkan masukkan harga yang anda inginkan
                                                    </p>
                                                </div>
                                                <div class="card-body">
                                                    <form role="form text-left" method="POST"
                                                        action="{{ route('history-lelang.update', $bidding->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="id_lelang"
                                                            value="{{ $bidding->lelang->id }}">
                                                        <input type="hidden" name="id_user"
                                                            value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="id_barang"
                                                            value="{{ $bidding->lelang->barang->id }}">
                                                        <p>Harga Tertinggi :
                                                            @if ($bidding->lelang->historyLelang->count() > 0)
                                                                {{ $bidding->lelang->historyLelang->sortByDesc('penawaran_harga')->first()->penawaran_harga }}
                                                            @else
                                                                0
                                                            @endif

                                                        </p>
                                                        <label>Tembak Harga</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control"
                                                                name="penawaran_harga" placeholder="Penawaran Harga"
                                                                aria-label="Penawaran Harga"
                                                                aria-describedby="penawaran_harga-addon"
                                                                value="{{ $bidding->penawaran_harga }}" required="required"
                                                                autofocus="autofocus"
                                                                min="@if ($bidding->lelang->historyLelang->count() > 0) {{ $bidding->lelang->historyLelang->sortByDesc('penawaran_harga')->first()->penawaran_harga }}@else{{ 0 }} @endif">
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
