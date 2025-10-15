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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $detailMenu }} - {{ $subMenu }}</h4>
                        <a href="{{ route('dashboard-pembelajaran-guru-dan-tendik-tambah') }}"><button type="button" class="btn btn-rounded btn-primary btn-xs">Tambah</button></a>
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
                        
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
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
                                            <span class="badge light badge-info">{{ $u->role->name }}</span>
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
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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
@endsection