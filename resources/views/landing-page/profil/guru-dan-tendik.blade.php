@extends('landing-page.layout.app')

@section('content')
<section class="ns-team-area pt-110 pb-25 p-relative">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ns-section mb-50 text-center">
                    <h2 class="ns-section-title mb-0">Guru dan Tenaga Kependidikan</h2>
                    <span class="ns-section-subtitle">SDN Srengseng Sawah 11 Pagi</span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($guruDanTendik as $gdt)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="ns-team-item mb-30">
                    <div class="ns-team-item-img w_img">
                        @if($gdt->avatar && Storage::disk('public')->exists('images/avatar/' . $gdt->avatar))
                        <img src="{{ asset('storage/images/avatar/'.$gdt->avatar) }}" alt="Foto Profil">
                        @else
                        <img src="{{ asset('assets/dashboard/images/profile-default.png') }}" alt="Foto Profil">
                        @endif
                    </div>
                    <div class="ns-team-item-content">
                        <div class="ns-team-item-info">
                            <h5 class="ns-team-info-title"><a href="#">{{ $gdt->name }}</a></h5>
                            <span>{{ $gdt->role->name }}</span>
                        </div>
                    </div>
                    <span class="ns-team-shape-1 ns-team-shape"></span>
                    <span class="ns-team-shape-2 ns-team-shape"></span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection