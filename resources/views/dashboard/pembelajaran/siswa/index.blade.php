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
                                        <select class="form-control default-select dashboard-select-2 h-auto wide" name="kelas">
                                            <option value="Semua">Semua Kelas</option>
                                            @foreach($kelas as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
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

                            <a href="{{ route('dashboard-pembelajaran-siswa-tambah') }}"><button type="button" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus me-1"></i>Tambah</button></a>
                            <div class="table-responsive">
                                <table class="table table-hover table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>FOTO</th>
                                            <th>KELAS</th>
                                            <th>NAMA/NIPD/NISN/NIK</th>
                                            <th>TTL/JK/AGAMA</th>
                                            <th>HP/ALAMAT</th>
                                            <th>FITUR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswa as $s)
                                        <tr>
                                            <td>
                                                @if($s->avatar && Storage::disk('public')->exists('images/avatar/' . $s->avatar))
                                                <img src="{{ asset('storage/images/avatar/'.$s->avatar) }}" class="rounded-lg me-2" width="24" alt="Foto Profil">
                                                @else
                                                <img src="{{ asset('assets/dashboard/images/profile-default.png') }}" class="rounded-lg me-2" width="24" alt="Foto Profil">
                                                @endif
                                            </td>
                                            <td>
                                                
                                                <div class="bootstrap-popover">
                                                    <span 
                                                        class="badge light badge-{{ $s->kelas->first()?->color }}" 
                                                        data-bs-container="body" 
                                                        data-bs-toggle="popover" 
                                                        data-bs-placement="right" 
                                                        data-bs-html="true"
                                                        data-bs-content="
                                                            @foreach($s->kelasSiswa as $ks) 
                                                                <p class='mb-0'>Tahun {{ $ks->tahun_ajaran->nama }}: {{ $ks->kelas->nama }}</p>
                                                            @endforeach
                                                        " 
                                                        title="Riwayat Kelas">
                                                        {{ $s->kelas->first()?->nama }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="fw-bold text-primary">{{ $s->nama }}</a>
                                                <div class="text-sm"><b>NIPD:</b> {{ $s->nipd ?? '-' }} / <b>NISN:</b> {{ $s->nisn ?? '-' }} / <b>NIK:</b> {{ $s->nik ?? '-' }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $s->tempat_lahir && $s->tanggal_lahir ? $s->tempat_lahir .', '. \Carbon\Carbon::parse($s->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}</div>
                                                <div class="text-sm">{{ $s->jenis_kelamin }}</b> / <b>Agama:</b> {{ $s->agama ?? '-' }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold">{{ $s->no_hp }}</div>
                                                <div class="text-sm">{{ $s->alamat_detail . ' RT ' . $s->alamat_rt . ' RW ' . $s->alamat_rw . $s->alamat_dusun . ' Kel. ' . $s->alamat_kelurahan  . ' Kec. ' . $s->alamat_kecamatan . ' Kode Pos. ' . $s->alamat_kode_pos  }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('dashboard-pembelajaran-siswa-edit', $s->id) }}" class="btn btn-warning shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                                    <button type="button" class="btn btn-danger shadow btn-xs sharp delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-name="{{ $s->nama }}" data-url="{{ route('dashboard-pembelajaran-siswa-hapus', $s->id) }}"><i class="fa fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{ $siswa->onEachSide(1)->withQueryString()->links('dashboard.layout.pagination') }}
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