@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard-publikasi-agenda') }}">{{ $subMenu }}</a></li>
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
                            <form class="validate-form" action="{{ $detailMenu == 'Tambah' ? route('dashboard-publikasi-agenda-simpan') : route('dashboard-publikasi-agenda-perbaharui', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if($detailMenu != 'Tambah')
                                @method('PUT')
                                @endif

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="penanggung_jawab_id">Penanggung Jawab</label>
                                    <div class="col-sm-9">
                                        <select id="penanggung_jawab_id" name="penanggung_jawab_id" data-placeholder="Pilih Penanggung Jawab" class="default-select form-control wide" required>
                                            @foreach ($penanggungJawab as $pj)
                                            <option value="{{ $pj->id }}" {{ isset($agenda) && $agenda->penanggung_jawab_id == $pj->id ? 'selected' : '' }}>{{ $pj->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="title">Judul Agenda</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Judul Agenda" value="{{ $agenda->title ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="location">Lokasi</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="location" id="location" class="form-control" placeholder="Lokasi" value="{{ $agenda->location ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="date">Waktu Pelaksanaan</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <input name="date" class="datepicker-default form-control" id="date" placeholder="Tanggal Pelaksanaan" data-value="{{ isset($agenda) && $agenda->date ? \Carbon\Carbon::parse($agenda->date)->isoFormat('Y/MM/D') : '' }}" required>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <input name="time_1" class="timepicker form-control" id="time_1" placeholder="Jam Mulai" value="{{ $agenda->time[0] ?? '' }}" required>
                                            </div>
                                            <div class="col-lg-3 col-6">
                                                <input name="time_2" class="timepicker form-control" id="time_2" placeholder="Jam Selesai" value="{{ $agenda->time[1] ?? '' }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->role->id == App\Enums\Role::Admin->value || Auth::user()->role->id == App\Enums\Role::KepalaSekolah->value || Auth::user()->role->id == App\Enums\Role::TataUsaha->value)
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Status Publikasi</label>
                                    <div class="col-sm-9">
                                        <div class="form-check custom-checkbox">
                                            <input name="is_published" id="is_published" type="checkbox" class="form-check-input" {{ isset($agenda) && $agenda->is_published->value == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_published">Publikasikan</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
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
    jQuery(document).ready(function() {
        $('.datepicker-default').pickadate({
            formatSubmit: 'yyyy-mm-dd',
        });

        $('.timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
            time: true,
            date: false
        });
    });
</script>
@endpush