@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard-pembelajaran-guru-dan-tendik') }}">{{ $subMenu }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $detailMenu }}</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $detailMenu }} - {{ $subMenu }}</h4>
                    </div>
                    <div class="card-body">
                        @if(session('alert_type'))
                        <x-alert
                            :title="session('alert_title')"
                            :type="session('alert_type')"
                            :icon="session('alert_icon')"
                            :messages="session('alert_messages')"
                            :display="'block'" />
                        @endif

                        @if(session('errors'))
                        <x-alert :title="'Validasi Gagal!'" :type="'danger'" :icon="'mdi-alert'" :messages="[]" :display="'block'" />
                        @endif

                        <div class="basic-form">
                            <form class="validate-form" action="{{ $detailMenu == 'Tambah' ? route('dashboard-pembelajaran-guru-dan-tendik-simpan') : route('dashboard-pembelajaran-guru-dan-tendik-perbaharui', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if($detailMenu != 'Tambah')
                                @method('PUT')
                                @endif

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="role_id">Role</label>
                                    <div class="col-sm-9">
                                        <select id="role_id" name="role_id" data-placeholder="Pilih Role" class="default-select form-control wide" required>
                                            @foreach($kategoriRole as $kr)
                                            <option value="{{ $kr->id }}" {{ isset($user) && $user->role->id == $kr->id ? 'selected' : '' }}>{{ $kr->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $user->email ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                                    <div class="col-sm-9 position-relative">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" minlength="8" {{ isset($user) && $user->password ? 'value=".$user->password." disabled' : 'required' }}>
                                                <span class="show-pass eye style-2">
                                                    <i class="fa fa-eye-slash"></i>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                            <div class="col-6">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password" minlength="8" {{ isset($user) && $user->password ? 'value=".$user->password." disabled' : 'required' }}>
                                                <span class="show-pass eye style-2">
                                                    <i class="fa fa-eye-slash"></i>
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <hr>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="name">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap" value="{{ $user->name ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="nip">NIP</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="nip" id="nip" class="form-control" placeholder="NIP" value="{{ $user->nip ?? '' }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="nrk">NRK</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="nrk" id="nrk" class="form-control" placeholder="NRK" value="{{ $user->nrk ?? '' }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="no_hp">No HP</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" value="{{ $user->no_hp ?? '' }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="tempat_lahir">TTL</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $user->tempat_lahir ?? '' }}">
                                            </div>
                                            <div class="col-6">
                                                <input name="tanggal_lahir" class="datepicker-default form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" data-value="{{ isset($user) && $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->isoFormat('Y/MM/D') : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
                                    <div class="col-sm-9">
                                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" rows="4">{{ $user->alamat ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="avatar">Foto Profil</label>
                                    <div class="col-sm-9">
                                        <input id="avatar" name="avatar" class="form-control mb-3" type="file" placeholder="avatar" accept=".png, .jpg, .jpeg" {{ isset($user) && $user->avatar ? '' : 'required'}}>
                                        @if(isset($user) && $user->avatar && Storage::disk('public')->exists('images/avatar/' . $user->avatar))
                                        <img id="foto-preview" class="rounded" alt="Foto Profil" src="{{ asset('storage/images/avatar/'.$user->avatar) }}" width="125">
                                        @else
                                        <img id="foto-preview" class="rounded d-none" alt="Foto Profil" width="125">
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#avatar").on("change", function(event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#foto-preview").attr("src", e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    (function($) {
        "use strict"
        $('.datepicker-default').pickadate({
            formatSubmit: 'yyyy-mm-dd',
        });
    })(jQuery);
</script>
@endpush