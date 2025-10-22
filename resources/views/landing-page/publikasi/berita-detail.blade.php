@extends('landing-page.layout.app')

@section('content')
<section class="ns-blog-details-area pt-115">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="ns-blog-details-wrap mb-55">
                    <img class="ns-blog-details-banner-img" src="{{ asset('storage/images/berita/'.$berita->img) }}" alt="Foto Berita">
                    <div class="ns-blog-details-content">
                        <ul class="ns-blog-details-meta">
                            <li><i class="icofont-pencil"></i>{{ $berita->writer?->name }}</li>
                            <li><i class="icofont-archive"></i>{{ $berita->kategori->text() }}</li>
                            <li><i class="icofont-calendar"></i>{{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->isoFormat('D MMMM Y') : '-' }}</li>
                            <li><i class="icofont-eye"></i>Dibaca ({{ $berita->viewed }})</li>
                        </ul>
                        <h2 class="ns-blog-details-title mb-20">{{ $berita->title }}</h2>
                        <div class="text-justify ns-blog-content-text">{!! $berita->content !!}</div>
                    </div>

                    @if($berita->quote && $berita->quote_by)
                    <div class="ns-blog-details-client-review">
                        <h5 class="ns-client-review-title">Kutipan:</h5>
                        <blockquote class="ns-blog-detials-quote">
                            <p class="text-justify">{{ $berita->quote }}</p>
                            <div class="ns-quote-admin">
                                <h5>{{ $berita->quoteBy->name }}</h5>
                                <span>{{ $berita->quoteBy->role->name }}</span>
                            </div>
                            <span class="ns-quote-icon"><i class="icofont-quote-left"></i></span>
                        </blockquote>
                    </div>
                    @endif

                    <div class="row">
                        @if($berita->img_2)
                        <div class="col-lg mb-4">
                            <img class="ns-blog-details-banner-img-bottom" src="{{ asset('storage/images/berita/'.$berita->img_2) }}" alt="Foto Berita">
                        </div>
                        @endif

                        @if($berita->img_3)
                        <div class="col-lg mb-4">
                            <img class="ns-blog-details-banner-img-bottom" src="{{ asset('storage/images/berita/'.$berita->img_3) }}" alt="Foto Berita">
                        </div>
                        @endif

                        @if($berita->img_4)
                        <div class="col-lg mb-4">
                            <img class="ns-blog-details-banner-img-bottom" src="{{ asset('storage/images/berita/'.$berita->img_4) }}" alt="Foto Berita">
                        </div>
                        @endif
                    </div>

                    <div class="ns-blog-details-tag mb-3">
                        @foreach ($berita->tags as $t)
                        <a href="{{ route('berita-list', array_merge(request()->query(), ['tag' => strtolower($t)])) }}">{{ $t }}</a>
                        @endforeach
                    </div>

                    <div class="ns-blog-list-social-icon ns-blog-list-social-icon-detail">
                        <h5 class="ns-client-review-title">Bagikan:</h5>
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('berita-detail', $berita->slug) }}"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="https://twitter.com/share?url={{ route('berita-detail', $berita->slug) }}&text={{ $berita->title }}"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="whatsapp://send?text={{ route('berita-detail', $berita->slug) }}"><i class="fab fa-whatsapp"></i></a>
                    </div>

                    <!-- <div class="ns-blog-details-comment">
                        <h5 class="ns-blog-details-comment-title">Comments (2)</h5>
                        <div class="ns-blog-details-comment-item ns-comment-border">
                            <div class="ns-blog-details-comment-item-img">
                                <img src="assets/img/blog/blog-admin-1.png" alt="">
                            </div>
                            <div class="ns-blog-details-comment-item-content">
                                <h5 class="ns-comment-title">Bonas Mera</h5>
                                <p>Lorem ipsum is simply free textdolor sit amet, consectetur notted adipisicing elit sed do iusmod tempor incididu.</p>
                                <div class="ns-blog-details-comment-meta">
                                    <span>November 16, 2022 at 4:31 am</span>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                        <div class="ns-blog-details-comment-item ml-130">
                            <div class="ns-blog-details-comment-item-img">
                                <img src="assets/img/blog/blog-admin-2.png" alt="">
                            </div>
                            <div class="ns-blog-details-comment-item-content">
                                <h5 class="ns-comment-title">Bonas Mera</h5>
                                <p>Lorem ipsum is simply free textdolor sit amet, consectetur notted adipisicing elit sed do iusmod tempor incididu.</p>
                                <div class="ns-blog-details-comment-meta">
                                    <span>November 16, 2022 at 4:31 am</span>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ns-blog-details-contact">
                        <h3 class="ns-blog-details-contact-title">Blog For Contact</h3>
                        <p>Promote your blog posts, case udie, and product ouncems
                            with the the branded videoscustomers coming back for
                            services Makes best effort.</p>
                        <form action="#">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <input type="text" placeholder="Your Name">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <input type="email" placeholder="Your Email">
                                </div>
                                <div class="col-12">
                                    <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="ns-theme-btn ns-blog-details-btn">Send Request</button>
                                </div>
                            </div>
                        </form>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                @include('landing-page.publikasi.berita-sidebar')
            </div>
        </div>
    </div>
</section>
@endsection