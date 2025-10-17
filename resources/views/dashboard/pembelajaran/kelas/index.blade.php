@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $subMenu }}</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="filter cm-content-box box-primary">
                    <div class="card-header">
                        <h4 class="cpa card-title">
                            <i class="fa-solid fa-file-lines me-2"></i>{{ $detailMenu }} - {{ $subMenu }}
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
                                            <th>KELAS</th>
                                            <th>WALI KELAS AKTIF</th>
                                            <th>JUMLAH SISWA AKTIF</th>
                                            <th>FITUR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kelas as $k)
                                        <tr>
                                            <td>
                                                <a href="#" class="fw-bold text-primary">{{ $k->nama }}</a>
                                            </td>
                                            <td>
                                                <div class="fw-bold"></div>
                                            </td>
                                            <td>
                                                <a href="#" class="badge badge-dark">{{ $k->kelasSiswa->count() }}</a>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('dashboard-pembelajaran-kelas-tahun-ajaran', $k->id) }}" class="btn btn-info shadow btn-xs sharp me-1"><i class="fa fa-cog"></i></a>
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