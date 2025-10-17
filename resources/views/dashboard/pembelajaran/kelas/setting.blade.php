@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $subMenu }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $kelas->nama }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $tahunAjaran->nama }}</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="filter cm-content-box box-primary">
                    <div class="card-header">
                        <h4 class="cpa card-title">
                            <i class="fa-solid fa-file-lines me-2"></i>{{ $detailMenu }} - {{ $subMenu }} {{ $kelas->nama }} - {{ $tahunAjaran->nama }}
                        </h4>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body">
                        <div class="card-body">
                            @if(session('alert_type'))
                            <x-alert
                                :title="session('alert_title')"
                                :type="session('alert_type')"
                                :icon="session('alert_icon')"
                                :messages="session('alert_messages')"
                                :display="'block'" />
                            @endif

                            <div class="basic-form">
                                <form class="validate-form" action="{{ route('dashboard-pembelajaran-kelas-tahun-ajaran-pengaturan', [$kelas->id, $tahunAjaran->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if($detailMenu != 'Tambah')
                                    @method('PUT')
                                    @endif

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Kelas</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Nama Lengkap" value="{{ $kelas->nama }}" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">Tahun Ajaran</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" placeholder="Nama Lengkap" value="{{ $tahunAjaran->nama }}" disabled>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="guru_id">Wali Kelas</label>
                                        <div class="col-sm-9">
                                            <select id="guru_id" name="guru_id" data-placeholder="Pilih Wali Kelas" class="default-select form-control wide" required>
                                                @foreach($waliKelas as $wk)
                                                <option value="{{ $wk->id }}">{{ $wk->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label" for="guru_olahraga_id">Guru Pelajaran</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6 mb-1">
                                                    <select id="guru_olahraga_id" name="guru_olahraga_id" data-placeholder="Pilih Guru Olahraga" class="default-select form-control wide" required>
                                                        @foreach($guruPelajaran as $gp)
                                                        <option value="{{ $gp->id }}">{{ $gp->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 mb-1">
                                                    <select id="guru_agama_id" name="guru_agama_id" data-placeholder="Pilih Guru Agama" class="default-select form-control wide" required>
                                                        @foreach($guruPelajaran as $gp)
                                                        <option value="{{ $gp->id }}">{{ $gp->name }}</option>
                                                        @endforeach
                                                    </select>
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
                                        <label class="col-sm-3 col-form-label" id="siswa_id">Siswa</label>
                                        <div class="col-sm-9">
                                            <select id="siswa_id" name="siswa_id[]" class="select2 multi-select" multiple="multiple" style="width: 100%;">
                                                @foreach($siswa as $s)
                                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                                @endforeach
                                            </select>
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
</div>
@endsection

@push('scripts')
<script>
    (function($) {
        "use strict"
        $(".multi-select").select2();
    })(jQuery);
</script>
@endpush