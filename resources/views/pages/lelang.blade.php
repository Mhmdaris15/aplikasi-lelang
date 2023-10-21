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
                @foreach ($lelangs as $lelang)
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url('storage/images/' . $lelang->barang->foto) }}" class="card-img-top" alt="Lelang">
                        <div class="card-body">
                            <h5 class="card-title">Lelang {{ $lelang->barang->nama_barang }}</h5>
                            <p class="card-text">{{ $lelang->barang->deskripsi }}</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-form-bidding-{{ $lelang->id }}">Bidding</button>
                        </div>
                        <div class="col-md-4">
                            <div class="modal fade" id="modal-form-bidding-{{ $lelang->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="modal-form-bidding-{{ $lelang->id }}" aria-hidden="true">
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
                                                    <form role="form text-left" method="POST" action="/history-lelang">
                                                        @csrf
                                                        <input type="hidden" name="id_lelang" value="{{ $lelang->id }}">
                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="id_barang"
                                                            value="{{ $lelang->barang->id }}">
                                                        <p>Harga Tertinggi :
                                                            @if ($lelang->historyLelang->count() > 0)
                                                                {{ $lelang->historyLelang->sortByDesc('penawaran_harga')->first()->penawaran_harga }}
                                                            @else
                                                                0
                                                            @endif

                                                        </p>
                                                        <label>Tembak Harga</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control"
                                                                name="penawaran_harga" placeholder="Penawaran Harga"
                                                                aria-label="Penawaran Harga"
                                                                aria-describedby="penawaran_harga-addon" value=""
                                                                min="@if ($lelang->historyLelang->count() > 0) {{ $lelang->historyLelang->sortByDesc('penawaran_harga')->first()->penawaran_harga }}@else{{ 0 }} @endif"
                                                                required>

                                                        </div>
                                                        <div class="text-center">
                                                            @if ($lelang->historyLelang->where('id_user', Auth::user()->id)->count() > 0)
                                                                <p class="text-danger">
                                                                    Anda sudah pernah bidding lelang ini
                                                                </p>
                                                            @endif
                                                            <button type="submit"
                                                                class="btn btn-round 
                                                                @if ($lelang->historyLelang->where('id_user', Auth::user()->id)->count() > 0) btn-secondary @else bg-gradient-info @endif
                                                                btn-lg w-100 mt-4 mb-0"
                                                                {{-- Disable it if user already bidding this lelang --}}
                                                                @if ($lelang->historyLelang->where('id_user', Auth::user()->id)->count() > 0) disabled @endif>
                                                                Update
                                                            </button>
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
