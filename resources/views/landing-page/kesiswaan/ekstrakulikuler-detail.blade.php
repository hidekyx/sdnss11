@extends('landing-page.layout.app')

@section('content')
<section class="ns-about-area-4 pt-110">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                @if(isset($ekstrakulikuler->ekstrakulikulerGaleri->first()->img) && Storage::disk('public')->exists('images/ekstrakulikuler/'.str_replace(' ', '-', strtolower($ekstrakulikuler->nama)).'/'.$ekstrakulikuler->ekstrakulikulerGaleri->first()->img))
                <div class="ns-about-4-img mb-40">
                    <img src="{{ asset('storage/images/ekstrakulikuler/'.str_replace(' ', '-', strtolower($ekstrakulikuler->nama)).'/'.$ekstrakulikuler->ekstrakulikulerGaleri->first()->img) }}" alt="Ekstrakulikuler" style="border-radius: 20px;">
                    <a class="ns-about-play-btn-4 popup-video" href="#"><img src="{{ asset('assets/images/layout/play-btn.png') }}" alt="Ekstrakulikuler"></a>
                </div>
                @endif
                <h4 class="mb-15">Anggota</h4>
                <div class="table table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="ns-bg-primary fw-bold">
                            <td>Foto</td>
                            <td>Kelas</td>
                            <td>Nama</td>
                        </thead>
                        <tbody>
                            @forelse($ekstrakulikuler->ekstrakulikulerSiswa as $s)
                            <tr class="kelas-{{ $s->siswa->kelas->first()?->nama }}">
                                <td>
                                    @if($s->avatar && Storage::disk('public')->exists('images/avatar/' . $s->avatar))
                                    <img src="{{ asset('storage/images/avatar/'.$s->avatar) }}" class="rounded-lg me-2" width="48" alt="Foto Profil">
                                    @else
                                    <img src="{{ asset('assets/dashboard/images/profile-default.png') }}" class="rounded-lg me-2" width="48" alt="Foto Profil">
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $s->siswa->kelas->first()?->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $s->siswa->nama }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="10">Belum ada data siswa ekstrakulikuler</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="ns-about-wrap-4 mb-40">
                    <div class="ns-section mb-45">
                        <h2 class="ns-section-title ns-text-primary mb-15">{{ $ekstrakulikuler->nama }}</h2>
                        <p class="ns-section-text mb-0 text-justify">{{ $ekstrakulikuler->deskripsi }}</p>
                    </div>
                    <div class="ns-about-content-wrap-4">
                        <div class="ns-header-action-info">
                            <span>Penanggung Jawab</span>
                            <h4>{{ $ekstrakulikuler->penanggungJawab->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                
            </div>
        </div>
    </div>
    <div class="container container-custom-3">
        <div class="row">
            <div class="col-12 text-center">
                <span class="ns-section-subtitle">Dokumentasi Kegiatan</span>
            </div>
            @forelse($ekstrakulikuler->ekstrakulikulerGaleri as $g)
            <div class="col-xxl-3 col-xl-4 col-lg-4 order-lg-2 order-xxl-0 col-md-6">
                <div class="ns-project-item mb-30">
                    <div class="ns-project-img w_img">
                        @if(isset($ekstrakulikuler->ekstrakulikulerGaleri->first()->img) && Storage::disk('public')->exists('images/ekstrakulikuler/'.str_replace(' ', '-', strtolower($ekstrakulikuler->nama)).'/'.$ekstrakulikuler->ekstrakulikulerGaleri->first()->img))
                        <img src="{{ asset('storage/images/ekstrakulikuler/'.str_replace(' ', '-', strtolower($ekstrakulikuler->nama)).'/'.$g->img) }}" alt="Ekstrakulikuler">
                        @endif
                    </div>
                    <div class="ns-project-content">
                        <div class="ns-project-content-info">
                            <h4 class="ns-project-content-title">{{ $g->title }}</h4>
                            <span>{{ \Carbon\Carbon::parse($g->created_at)->isoFormat('D MMMM Y') }}</span>
                        </div>
                        <div class="ns-project-content-btn">
                            <a href="#"><i class="icofont-ui-zoom-in"></i></a>
                        </div>
                    </div>
                    <span class="ns-project-shape-1 ns-project-shape"></span>
                    <span class="ns-project-shape-2 ns-project-shape"></span>
                </div>
            </div>
            @empty
            <div class="text-center mb-3">
                <span class="ns-section-subtitle text-dark">Belum ada dokumentasi</span>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection