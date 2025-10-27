@extends('landing-page.layout.app')

@section('content')
<section class="ns-about-area pt-35 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ns-section mb-50 text-center">
                    <h2 class="ns-section-title mb-0">Tentang Sekolah</h2>
                    <span class="ns-section-subtitle">SDN Srengseng Sawah 11 Pagi</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="ns-about-left bg-default mb-40" data-background="{{ asset('assets/images/layout/shape-2.png') }}">
                    <div class="ns-about-img-1 mb-10">
                        <div class="ns-about-img-inner">
                            <img class="inner-img-1" src="{{ asset('assets/images/layout/visi-misi-img-2.jpg') }}" alt="Not Found">
                            <a class="ns-about-play-btn popup-video" href="#"><img src="{{ asset('assets/images/layout/play-btn.png') }}" alt="Not Found"></a>
                        </div>
                    </div>
                    <div class="ns-about-img-wrap-2">
                        <div class="ns-about-img-inner-2">
                            <img class="inner-img-2" src="{{ asset('assets/images/layout/visi-misi-img-1.jpeg') }}" alt="Not Found">
                            <img class="ns-about-shape" src="assets/img/about/shape-1.png" alt="Not Found">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="ns-about-wrap mb-40">
                    <div class="ns-section mb-25">
                        <span class="ns-section-subtitle">Visi SDN Srengseng Sawah 11</span>
                        <h2 class="ns-section-title text-visi mb-15 fst-italic">Terwujudnya Pelajar berkarakter unggul, cerdas, sehat, dan peduli</h2>
                        <p class="ns-section-text text-justify mb-0">Indikator ketercapaian visi meliputi lima aspek utama: <b class="ns-text-primary">unggul</b> melalui pencapaian di atas standar nasional dalam akademik, karakter, keterampilan abad 21, dan layanan belajar; <b class="ns-text-primary">cerdas</b> dengan penguasaan ilmu, berpikir kritis, dan kematangan diri; <b class="ns-text-primary">sehat</b> melalui kondisi fisik, mental, dan sosial yang prima; <b class="ns-text-primary">berkarakter</b> dengan penerapan tujuh kebiasaan anak hebat dan delapan dimensi profil lulusan; serta <b class="ns-text-primary">peduli</b> yang tercermin dari empati dan tanggung jawab terhadap diri sendiri, orang lain, lingkungan, dan masyarakat.</p>
                    </div>
                    <div class="ns-about-content">
                        <div class="ns-about-content-bottom">
                            <div class="ns-about-content-admin">
                                <div class="ns-about-content-admin-img">
                                    <img src="{{ asset('assets/images/layout/about-admin.png') }}" alt="Not Found">
                                </div>
                                <div class="ns-about-content-admin-info">
                                    <h4 class="ns-about-admin-title"><a href="about.html">Arianto, S.Kom</a></h4>
                                    <span>Plt. Kepala Sekolah</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="ns-about-content-info-right mb-50">
                    <h5 class="inner-title">Misi SDN Srengseng Sawah 11</h5>
                    <div class="ns-about-info-inner">
                        <div class="ns-about-content-list">
                            <ul class="text-justify lh-lg">
                                <li class="lh-base"><i class="icofont-tick-boxed"></i>Menumbuhkan keimanan dan ketakwaan melalui pembiasaan ibadah, budi pekerti, dan teladan yang baik</li>
                                <li class="lh-base"><i class="icofont-tick-boxed"></i>Membentuk akhlaq mulia, sikap mandiri dan tanggung jawab dalam kehidupan sehari - hari</li>
                                <li class="lh-base"><i class="icofont-tick-boxed"></i>Mengembangkan kemampuan berpikir kritis, keratif, serta ketrampilan komunikasi dan kolaborasi melalui pembelajaran aktif dan inovatif</li>
                                <li class="lh-base"><i class="icofont-tick-boxed"></i>Menyelenggarakan kegiatan yang pendukung kesehatan jasmani, rohani, dan gaya hidup sehat</li>
                                <li class="lh-base"><i class="icofont-tick-boxed"></i>Menanamkan kepedulian terhadap lingkungan melalui program berbasis konservasi dan kebersihan sekolah</li>
                                <li class="lh-base"><i class="icofont-tick-boxed"></i>Menumbuhkan rasa cinta, tanah air, semangat kebangsaan, dan partisipasi aktif dalam kegiatan sosial</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection