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
                            <li><i class="icofont-calendar"></i>{{ $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->isoFormat('D MMMM Y') : '-' }}</li>
                        </ul>
                        <h2 class="ns-blog-details-title mb-20">{{ $berita->title }}</h2>
                        {!! $berita->content !!}
                    </div>

                    <div class="ns-blog-details-client-review">
                        <h5 class="ns-client-review-title">Kutipan:</h5>
                        <blockquote class="ns-blog-detials-quote">
                            <p>Isi kutipan</p>
                            <div class="ns-quote-admin">
                                <h5>Nama</h5>
                                <span>Jabatan</span>
                            </div>
                            <span class="ns-quote-icon"><i class="icofont-quote-left"></i></span>
                        </blockquote>
                    </div>

                    <div class="row mb-4">
                        @if($berita->img_2)
                        <div class="col-lg">
                            <img class="ns-blog-details-banner-img-bottom" src="{{ asset('storage/images/berita/'.$berita->img_2) }}" alt="Foto Berita">
                        </div>
                        @endif

                        @if($berita->img_3)
                        <div class="col-lg">
                            <img class="ns-blog-details-banner-img-bottom" src="{{ asset('storage/images/berita/'.$berita->img_3) }}" alt="Foto Berita">
                        </div>
                        @endif

                        @if($berita->img_4)
                        <div class="col-lg">
                            <img class="ns-blog-details-banner-img-bottom" src="{{ asset('storage/images/berita/'.$berita->img_4) }}" alt="Foto Berita">
                        </div>
                        @endif
                    </div>

                    <div class="ns-blog-details-tag mb-3">
                        @foreach ($beritaPenanda as $key => $bp)
                        <a href="{{ route('berita-list', array_merge(request()->query(), ['tag' => strtolower($key)])) }}">{{ $key }}</a>
                        @endforeach
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