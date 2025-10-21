@extends('landing-page.layout.app')

@section('content')
<section class="ns-blog-list-area pt-115 pb-20">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="ns-blog-list-wrap">
                    @foreach($berita as $b)
                    <div class="single-blog-list-item mb-50">
                        <div class="ns-blog-list-img ns-blog-list-img-slide">
                            <div class="swiper-container blog-list-active">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/images/berita/'.$b->img) }}" alt="Foto Berita">
                                    </div>

                                    @if($b->img_2)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/images/berita/'.$b->img_2) }}" alt="Foto Berita">
                                    </div>
                                    @endif

                                    @if($b->img_3)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/images/berita/'.$b->img_3) }}" alt="Foto Berita">
                                    </div>
                                    @endif

                                    @if($b->img_4)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/images/berita/'.$b->img_4) }}" alt="Foto Berita">
                                    </div>
                                    @endif

                                </div>
                                <div class="ns-blog-list-navigation">
                                    <div class="ns-blog-list-swiper-prev"><i class="icofont-circled-left"></i>
                                    </div>
                                    <div class="ns-blog-list-swiper-next"><i class="icofont-circled-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ns-blog-list-content">
                            <div class="ns-blog-list-meta">
                                <span class="ns-blog-list-admin"><i class="icofont-pencil"></i>{{ $b->writer?->name }}</span>
                                <span class="ns-blog-list-date"><i class="icofont-calendar"></i>{{ $b->published_at ? \Carbon\Carbon::parse($b->published_at)->isoFormat('D MMMM Y') : '-' }}</span>
                                <span class="ns-blog-list-comment"><i class="icofont-archive"></i>{{ $b->kategori->text() }}</span>
                                <span class="ns-blog-list-comment"><i class="icofont-speech-comments"></i>Komentar (0)</span>
                                <span class="ns-blog-list-comment"><i class="icofont-eye"></i>Dibaca ({{ $b->viewed }} )</span>
                            </div>
                            <h3 class="ns-blog-list-title">
                                <a href="{{ route('berita-detail', $b->slug) }}">{{ $b->title }}</a>
                            </h3>
                            <p>{!! Str::limit($b->content, 400) !!}</p>
                            <div class="ns-blog-list-bottom">
                                <a href="{{ route('berita-detail', $b->slug) }}" class="ns-theme-btn">Baca Selengkapnya <i class="fal fa-arrow-right"></i></a>
                                <div class="ns-blog-list-social">
                                    <span>Bagikan:</span>
                                    <div class="ns-blog-list-social-icon">
                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('berita-detail', $b->slug) }}"><i class="fab fa-facebook-f"></i></a>
                                        <a target="_blank" href="https://twitter.com/share?url={{ route('berita-detail', $b->slug) }}&text={{ $b->title }}"><i class="fab fa-twitter"></i></a>
                                        <a target="_blank" href="whatsapp://send?text={{ route('berita-detail', $b->slug) }}"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{ $berita->onEachSide(1)->withQueryString()->links('landing-page.layout.pagination') }}
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                @include('landing-page.publikasi.berita-sidebar')
            </div>
        </div>
    </div>
</section>
@endsection