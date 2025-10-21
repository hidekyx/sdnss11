@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard-pembelajaran-siswa') }}">{{ $subMenu }}</a></li>
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
                            <form class="validate-form" action="{{ $detailMenu == 'Tambah' ? route('dashboard-pembelajaran-siswa-simpan') : route('dashboard-pembelajaran-siswa-perbaharui', $siswa->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if($detailMenu != 'Tambah')
                                @method('PUT')
                                @endif

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="nama">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" value="{{ $siswa->nama ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="nipd">NIPD</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="nipd" id="nipd" class="form-control" placeholder="NIPD" value="{{ $siswa->nipd ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="nisn">NISN</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="nisn" id="nisn" class="form-control" placeholder="NISN" value="{{ $siswa->nisn ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="nik">NIK</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="nik" id="nik" class="form-control" placeholder="NIK" value="{{ $siswa->nik ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <select id="jenis_kelamin" name="jenis_kelamin" data-placeholder="Pilih Jenis Kelamin" class="default-select form-control wide" required>
                                            <option value="L" {{ isset($siswa) && $siswa->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ isset($siswa) && $siswa->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="tempat_lahir">TTL</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $siswa->tempat_lahir ?? '' }}" required>
                                            </div>
                                            <div class="col-6">
                                                <input name="tanggal_lahir" class="datepicker-default form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" data-value="{{ isset($siswa) && $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('Y/MM/D') : '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="agama">Agama</label>
                                    <div class="col-sm-9">
                                        <select id="agama" name="agama" data-placeholder="Pilih Agama" class="default-select form-control wide" required>
                                            <option value="Islam" {{ isset($siswa) && $siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ isset($siswa) && $siswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katholik" {{ isset($siswa) && $siswa->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                                            <option value="Hindu" {{ isset($siswa) && $siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ isset($siswa) && $siswa->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Khonghucu" {{ isset($siswa) && $siswa->agama == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="no_hp">No HP</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="No HP" value="{{ $siswa->no_hp ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="alamat">Alamat</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6 mb-3">
                                                <input type="text" name="alamat_detail" id="alamat_detail" class="form-control" placeholder="Alamat Detail" value="{{ $siswa->alamat_detail ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <input type="number" name="alamat_rt" id="alamat_rt" class="form-control" placeholder="RT" value="{{ $siswa->alamat_rt ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <input type="number" name="alamat_rw" id="alamat_rw" class="form-control" placeholder="RW" value="{{ $siswa->alamat_rw ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <input type="text" name="alamat_dusun" id="alamat_dusun" class="form-control" placeholder="Alamat Dusun" value="{{ $siswa->alamat_dusun ?? '' }}">
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <input type="number" name="alamat_kode_pos" id="alamat_kode_pos" class="form-control" placeholder="Kode Pos" value="{{ $siswa->alamat_kode_pos ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <input type="text" name="alamat_kelurahan" id="alamat_kelurahan" class="form-control" placeholder="Kelurahan" value="{{ $siswa->alamat_kelurahan ?? '' }}" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="alamat_kecamatan" id="alamat_kecamatan" class="form-control" placeholder="Kecamatan" value="{{ $siswa->alamat_kecamatan ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="avatar">Foto Profil</label>
                                    <div class="col-sm-9">
                                        <input id="avatar" name="avatar" class="form-control mb-3" type="file" placeholder="avatar" accept=".png, .jpg, .jpeg" {{ isset($siswa) && $siswa->avatar ? '' : 'required'}}>
                                        @if(isset($siswa) && $siswa->avatar && Storage::disk('public')->exists('images/avatar/' . $siswa->avatar))
                                        <img id="foto-preview" class="rounded" alt="Foto Profil" src="{{ asset('storage/images/avatar/'.$siswa->avatar) }}" width="125">
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