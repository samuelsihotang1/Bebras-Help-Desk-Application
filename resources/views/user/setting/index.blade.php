@extends('layouts.app')

@section('title')
Pengaturan Akun
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        Pengaturan
                    </div>
                </div>
                <hr>
                <div class="row">
                    <a href="javascript:void(0)" class="text-danger font-weight-bold" style="background-color: rgba(255, 0, 0, 0.1); padding: 5px 10px; border-radius: 5px; display: inline-block; width: 100%;" onclick="makeRedBox(event)">
                        <small style="font-size: 13px; font-weight: bold;">Akun</small>
                    </a>                    
                </div>
            </div>
        </div>
        <div class="col-7 ml-1">
            @include('layouts.success')
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        Pengaturan Akun
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                Email
                            </div>
                            <div class="col-6">
                                {{ auth()->user()->email }}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                Kata Sandi
                            </div>
                            <div class="col-6">
                                @if (auth()->user()->provider_id)
                                    <a href="javascript:void(0)" class="text-dark">Ubah Kata Sandi</a>
                                @else
                                    <a href="" data-toggle="modal" data-target="#passwordModal">Ubah Kata Sandi</a>
                                @endif
                            </div>
                            <!-- Modal -->
                            <form action="{{ route('settings.password',auth()->id()) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal fade" id="passwordModal" aria-labelledby="passwordModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="passwordModalLabel">Ubah Kata Sandi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="">Kata Sandi</label>
                                                    <input type="password" name="password" class="form-control">
                                                    @include('layouts.error', ['name' => 'password'])
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light rounded-pill" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary rounded-pill">Simpan</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                Negara
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0)">{{ auth()->user()->country ? auth()->user()->country : 'Pilih Negara   ' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
</div>
@endsection
