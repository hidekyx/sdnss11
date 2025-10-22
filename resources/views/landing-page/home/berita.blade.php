<section class="ns-blog-area pt-110 pb-115">
    <img src="{{ asset('assets/landing-page/images/blog-shape-1.png') }}" alt="Not Found" class="ns-blog-bg-shape-1 ns-blog-shape-bg">
    <img src="{{ asset('assets/landing-page/images/blog-shape-2.png') }}" alt="Not Found" class="ns-blog-bg-shape-2 ns-blog-shape-bg">
    <img src="{{ asset('assets/landing-page/images/blog-shape-3.png') }}" alt="Not Found" class="ns-blog-bg-shape-3 ns-blog-shape-bg">
    <img src="{{ asset('assets/landing-page/images/blog-shape-4.png') }}" alt="Not Found" class="ns-blog-bg-shape-4 ns-blog-shape-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="ns-section mb-50 text-center">
                    <h2 class="ns-section-title text-uppercase ns-text-primary mb-0">BERITA TERBARU</h2>
                </div>
            </div>
        </div>
        <div class="swiper-container blog-active">
            @foreach($beritaTerbaru as $bt)
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="ns-blog-item">
                        <div class="ns-blog-img w_img">
                            <a href="{{ route('berita-detail', $bt->slug) }}"><img src="{{ asset('storage/images/berita/'.$bt->img) }}" alt="Foto Berita" style="height: 240px; object-fit: cover;"></a>
                            <span class="ns-blog-tag">{{ $bt->kategori->text() }}</span>
                            <span class="ns-blog-img-shape-1"></span>
                            <span class="ns-blog-img-shape-2"></span>
                        </div>
                        <div class="ns-blog-content">
                            <div class="ns-blog-content-meta">
                                <span class="ns-blog-admin"><i class="icofont-eye text-danger"></i> Dibaca ({{ $bt->viewed }})</span>
                                <span class="ns-blog-date"><i class="icofont-calendar text-danger"></i> {{ \Carbon\Carbon::parse($bt->published_at)->isoFormat('D MMMM Y') }}</span>
                            </div>
                            <h3 class="ns-blog-content-title">
                                <a href="{{ route('berita-detail', $bt->slug) }}">{!! Str::limit($bt->title, 40) !!}</a>
                            </h3>
                            <p>{!! Str::limit($bt->content, 50) !!}</p>
                            <p><a href="{{ route('berita-detail', $bt->slug) }}" class="ns-blog-btn">Baca Selengkapnya<i class="icofont-plus"></i></a></p>
                            <span class="ns-blog-shape-1"></span>
                            <span class="ns-blog-shape-2"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="ns-blog-pagination mt-50"></div>
        </div>
    </div>
</section>