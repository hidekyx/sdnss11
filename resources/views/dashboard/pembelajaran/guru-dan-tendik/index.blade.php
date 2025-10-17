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
                                        <input class="form-control" type="text" name="search" placeholder="Cari Nama">
                                    </div>
                                    <div class="col-xl-3 col-xxl-6 col-sm-6 mb-3">
                                        <select class="form-control default-select dashboard-select-2 h-auto wide" name="role">
                                            <option value="Semua">Semua Role</option>
                                            @foreach($kategoriRole as $kr)
                                            <option value="{{ $kr->id }}">{{ $kr->name }}</option>
                                            @endforeach
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

                            <a href="{{ route('dashboard-pembelajaran-guru-dan-tendik-tambah') }}"><button type="button" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus me-1"></i>Tambah</button></a>
                            <div class="table-responsive">
                                <table class="table table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>NAMA/NIP/NRK</th>
                                            <th>ROLE</th>
                                            <th>TTL/ALAMAT</th>
                                            <th>HP/EMAIL</th>
                                            <th>FITUR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user as $u)
                                        <tr>
                                            <td>
                                                @if($u->avatar && Storage::disk('public')->exists('images/avatar/' . $u->avatar))
                                                <img src="{{ asset('storage/images/avatar/'.$u->avatar) }}" class="rounded-lg me-2" width="24" alt="Foto Profil">
                                                @else
                                                <img src="{{ asset('assets/dashboard/images/preview-1.jpg') }}" class="rounded-lg me-2" width="24" alt="Foto Profil">
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-primary">{{ $u->name }}</a>
                                                <div class="text-sm"><b>NIP:</b> {{ $u->nip ?? '-' }} / <b>NRK:</b> {{ $u->nrk ?? '-' }}</div>
                                            </td>
                                            <td>
                                                <span class="badge light badge-{{ $u->role->color }}">{{ $u->role->name }}</span>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $u->tempat_lahir && $u->tanggal_lahir ? $u->tempat_lahir .', '. \Carbon\Carbon::parse($u->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}</div>
                                                <div class="text-sm">{{ $u->alamat }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $u->no_hp }}</div>
                                                <div class="text-sm">{{ $u->email }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('dashboard-pembelajaran-guru-dan-tendik-edit', $u->id) }}" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-name="{{ $u->name }}" data-url="{{ route('dashboard-pembelajaran-guru-dan-tendik-hapus', $u->id) }}"><i class="fa fa-trash"></i></a>
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