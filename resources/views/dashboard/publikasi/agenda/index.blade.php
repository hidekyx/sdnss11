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
                            <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
                        </h4>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt">
                        <form method="get" action="#" autocomplete="off">
                            <div class="card-body pb-2">
                                <div class="row">
                                    <div class="col-xl-3 col-xxl-6 col-sm-6 mb-3">
                                        <input class="form-control" type="text" name="search" placeholder="Cari Agenda">
                                    </div>
                                    <div class="col-xl-3 col-xxl-6 col-sm-6 mb-3">
                                        <select class="form-control default-select dashboard-select-2 h-auto wide" name="status">
                                            <option value="Semua">Semua Status</option>
                                            <option value="{{ App\Enums\PublikasiStatus::Published }}">{{ App\Enums\PublikasiStatus::Published->text() }}</option>
                                            <option value="{{ App\Enums\PublikasiStatus::Unpublished }}">{{ App\Enums\PublikasiStatus::Unpublished->text() }}</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-xxl-6 col-sm-6 mb-3">
                                        <button class="btn btn-md btn-primary" type="submit"><i class="fa-sharp fa-solid fa-filter me-1"></i>Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="filter cm-content-box box-primary">
                    <div class="card-header">
                        <h4 class="cpa card-title">
                            <i class="fa-solid fa-file-lines me-2"></i> {{ $detailMenu }} - {{ $subMenu }}
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

                            <a href="{{ route('dashboard-publikasi-agenda-tambah') }}"><button type="button" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus me-1"></i>Tambah</button></a>
                            <div class="table-responsive">
                                <table class="table table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>WAKTU</th>
                                            <th>AGENDA</th>
                                            <th>PENANGGUNG JAWAB</th>
                                            <th>LOKASI</th>
                                            <th>STATUS</th>
                                            <th>FITUR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($agenda as $a)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $a->date ? \Carbon\Carbon::parse($a->date)->isoFormat('D MMMM Y') : '-' }}</div>
                                                <div class="text-sm">{{ $a->time }}</div>
                                            </td>
                                            <td>
                                                <span lass="fw-bold text-primary">{{ $a->title }}</span>
                                            </td>
                                            <td>
                                                <span class="badge light badge-info">{{ $a->penanggungJawab->name ?? '-' }}</span>
                                            </td>
                                            <td>
                                                <div class="text-sm">{{ $a->location }}</div>
                                            </td>
                                            <td>
                                                <span class="badge light badge-{{ $a->is_published->color() }}">{{ $a->is_published->text() }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('dashboard-publikasi-agenda-edit', $a->id) }}" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-name="{{ $a->title }}" data-url="{{ route('dashboard-publikasi-agenda-hapus', $a->id) }}"><i class="fa fa-trash"></i></a>
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

<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
        <form id="delete-form" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus {{ $subMenu }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">Data <span id="delete-item" class="fw-bold"></span> akan dihapus.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger light">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.delete-btn', function() {
        let name = $(this).data('name');
        let url = $(this).data('url');
        $('#delete-item').text(name);
        $('#delete-form').attr('action', url);
    });
</script>
@endpush