@extends('landing-page.layout.app')

@section('content')
<section class="ns-project-area-5 pt-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-5">
                <div class="ns-section text-start mb-25 mb-lg-0">
                    <h2 class="ns-section-title text-uppercase ns-text-primary mb-0">EKSTRAKULIKULER</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="ns-project-wrap-5">
            <div class="tab-content">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <div class="swiper-container project-active-5">
                        <div class="swiper-wrapper">
                            @foreach($ekstrakulikuler as $e)
                            <div class="swiper-slide">
                                <div class="ns-project-content-wrap-5 pt-50 pb-50">
                                    <div class="ns-project-item-5">
                                        <div class="ns-project-item-img-5 w_img">
                                            <a href="{{ route('ekstrakulikuler-detail', str_replace(' ', '-', strtolower($e->nama))) }}">
                                                @if(isset($e->ekstrakulikulerGaleri->first()->img) && Storage::disk('public')->exists('images/ekstrakulikuler/'.str_replace(' ', '-', strtolower($e->nama)).'/'.$e->ekstrakulikulerGaleri->first()->img))
                                                <img src="{{ asset('storage/images/ekstrakulikuler/'.str_replace(' ', '-', strtolower($e->nama)).'/'.$e->ekstrakulikulerGaleri->first()->img) }}" alt="Ekstrakulikuler" class="thumbnail-ekstrakulikuler">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="ns-project-item-content-5">
                                            <div class="ns-project-left-5">
                                                <h4><a href="{{ route('ekstrakulikuler-detail', str_replace(' ', '-', strtolower($e->nama))) }}">{{ $e->nama }}</a></h4>
                                                <p>{{ $e->deskripsi_singkat }}</p>
                                            </div>
                                            <div class="ns-project-right-5">
                                                <a href="{{ route('ekstrakulikuler-detail', str_replace(' ', '-', strtolower($e->nama))) }}"><i class="icofont-circled-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="ns-project-navigation-5">
                            <div class="ns-project-swiper-prev-5"><i class="icofont-circled-left"></i>
                            </div>
                            <div class="ns-project-swiper-next-5"><i class="icofont-circled-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection