@extends('landing-page.layout.app')

@push('styles')
<style>
    tbody tr:not(#kelas-kosong) {
        display: none;
    }
</style>
@endpush

@section('content')
<section class="ns-about-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ns-section mb-50 text-center">
                    <h2 class="ns-section-title mb-0">Kelas dan Siswa</h2>
                    <span class="ns-section-subtitle">SDN Srengseng Sawah 11 Pagi</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3 d-flex gap-2">
                    @foreach($kelas as $k)
                    <button class="ns-theme-btn tab-kelas-btn" data-kelas="{{ $k->nama }}">{{ $k->nama }}</button>
                    @endforeach
                </div>
                <div class="table table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="ns-bg-primary fw-bold">
                            <td>Foto</td>
                            <td>Kelas</td>
                            <td>Nama</td>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>JK/Agama</td>
                        </thead>
                        <tbody>
                            @foreach($siswa as $s)
                            <tr class="kelas-{{ $s->kelas->first()?->nama }}">
                                <td>
                                    @if($s->avatar && Storage::disk('public')->exists('images/avatar/' . $s->avatar))
                                    <img src="{{ asset('storage/images/avatar/'.$s->avatar) }}" class="rounded-lg me-2" width="48" alt="Foto Profil">
                                    @else
                                    <img src="{{ asset('assets/dashboard/images/profile-default.png') }}" class="rounded-lg me-2" width="48" alt="Foto Profil">
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ $s->kelas->first()?->nama }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $s->nama }}</span>
                                </td>
                                <td>
                                    {{ $s->tempat_lahir && $s->tanggal_lahir ? $s->tempat_lahir .', '. \Carbon\Carbon::parse($s->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}
                                </td>
                                <td>
                                    <div class="text-sm">{{ $s->jenis_kelamin }}</b> / <b>Agama:</b> {{ $s->agama ?? '-' }}</div>
                                </td>
                            </tr>
                            @endforeach
                            <tr id="kelas-kosong">
                                <td colspan="10" class="text-center">
                                    <span class="fw-bold">Pilih kelas terlebih dahulu</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $("#kelas-kosong").show();

    $(".tab-kelas-btn").on("click", function () {
        var kelas = $(this).data("kelas");

        $(".tab-kelas-btn").removeClass("active");
        $(this).addClass("active");

        $("tbody tr").not("#kelas-kosong").hide();

        if (kelas === "all") {
            $("tbody tr").not("#kelas-kosong").fadeIn(200);
            $("#kelas-kosong").hide();
        } else {
            var $kelasRows = $(".kelas-" + kelas);
            if ($kelasRows.length > 0) {
                $("#kelas-kosong").hide();
                $kelasRows.fadeIn(200);
            } else {
                $("#kelas-kosong").show();
            }
        }
    });
});
</script>
@endpush