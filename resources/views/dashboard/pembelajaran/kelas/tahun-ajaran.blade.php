@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $subMenu }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $kelas->nama }}</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="filter cm-content-box box-primary">
                    <div class="card-header">
                        <h4 class="cpa card-title">
                            <i class="fa-solid fa-file-lines me-2"></i>{{ $detailMenu }} - {{ $subMenu }} {{ $kelas->nama }}
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

                            <div class="table-responsive">
                                <table class="table table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>TAHUN AJARAN</th>
                                            <th>TANGGAL MULAI</th>
                                            <th>TANGGAL SELESAI</th>
                                            <th>FITUR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tahunAjaran as $ta)
                                        <tr>
                                            <td>
                                                <a href="#" class="fw-bold text-primary">{{ $ta->nama }}</a>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ \Carbon\Carbon::parse($ta->tanggal_mulai)->isoFormat('D MMMM Y') }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ \Carbon\Carbon::parse($ta->tanggal_selesai)->isoFormat('D MMMM Y') }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('dashboard-pembelajaran-kelas-tahun-ajaran-pengaturan', [$kelas->id, $ta->id]) }}" class="btn btn-info shadow btn-xs sharp me-1"><i class="fa fa-cog"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@endpush