<section class="ns-service-area-2 pt-110 pb-115 p-relative">
    <img src="{{ asset('assets/landing-page/images/agenda-bg.jpg') }}" class="ns-service-bg-img-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="ns-section mb-50 text-left">
                    <h2 class="ns-section-title text-uppercase ns-text-primary mb-0">AGENDA SEKOLAH</h2>
                </div>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('agenda-list') }}" class="ns-recent-btn ns-theme-btn">Lihat Riwayat Agenda <i class="fal fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="ns-service-wrap-2">
            <div class="swiper-container service-active-2">
                <div class="swiper-wrapper">
                    @forelse($agendaTerbaru as $at)
                    <div class="swiper-slide">
                        <div class="ns-service-item ns-service-item-2">
                            <div class="ns-service-img ns-service-img-2 w_img">
                                <div class="ns-service-content-icon ns-service-content-icon-2">
                                    <i class="icofont-mega-phone"></i>
                                </div>
                            </div>
                            <div class="ns-service-content ns-service-content-2">
                                <h4 class="ns-service-content-title ns-service-content-title-2">{{ $at->title }}</h4>
                                <table class="table">
                                    <tr>
                                        <td>
                                            <h3 class="icofont-location-pin text-danger"></h3>
                                        </td>
                                        <td>
                                            <p class="ns-blog-date">{{ $at->location }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="icofont-calendar text-danger"></h3>
                                        </td>
                                        <td>
                                            <p class="ns-blog-date">{{ \Carbon\Carbon::parse($at->date)->isoFormat('D MMMM Y') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="icofont-clock-time text-danger"></h3>
                                        </td>
                                        <td>
                                            <p class="ns-blog-date">{{ $at->time }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="icofont-user text-danger"></h3>
                                        </td>
                                        <td>
                                            <p class="ns-blog-date">{{ $at->penanggungJawab->name }}</p>
                                        </td>
                                    </tr>
                                </table>
                                <span class="ns-service-shape-1 ns-service-shape-21"></span>
                                <span class="ns-service-shape-2 ns-service-shape-22"></span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <span class="ns-section-subtitle text-dark">Belum ada Agenda mendatang</span>
                    @endforelse
                </div>
            </div>
            <div class="ns-service-bottom ns-service-bottom-2 mt-50">
                <div class="ns-service-pagination ns-service-pagination-2"></div>
            </div>
        </div>
    </div>
</section>