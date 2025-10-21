<div class="ns-blog-details-widget-wrap mb-50">
    <div class="ns-blog-details-widget-search mb-50">
        <form method="get" action="{{ route('berita-list') }}">
            <input type="text" name="search" placeholder="Cari Judul Berita">
            <button class="ns-blog-search-btn"><i class="icofont-search-2"></i></button>
        </form>
    </div>
    <div class="ns-blog-details-widget mb-50">
        <h5 class="ns-blog-details-widget-title">Berita Terbaru</h5>
        @foreach($beritaTerbaru as $bt)
        <div class="ns-blog-details-widget-post">
            <div class="ns-blog-details-post-img">
                <a href="{{ route('berita-detail', $bt->slug) }}"><img src="{{ asset('storage/images/berita/'.$bt->img) }}" alt="Foto Berita Terbaru"></a>
            </div>
            <div class="ns-blog-details-post-content">
                <span><i class="icofont-calendar"></i>{{ $bt->published_at ? \Carbon\Carbon::parse($bt->published_at)->isoFormat('D MMMM Y') : '-' }}</span>
                <h5 class="ns-blog-details-post-content-title"><a href="{{ route('berita-detail', $bt->slug) }}">{!! Str::limit($bt->title, 50) !!}</a></h5>
            </div>
        </div>
        @endforeach
    </div>
    <div class="ns-blog-details-widget mb-50">
        <h5 class="ns-blog-details-widget-title">Kategori</h5>
        <div class="ns-blog-details-widget-category">
            <ul class="ns-blog-details-category-list">
                @foreach($kategoriBerita as $kb)
                <li><a href="{{ route('berita-list', array_merge(request()->query(), ['kategori' => $kb->kategori])) }}">{{ $kb->kategori->text() }} <span>({{ $kb->total }})</span></a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="ns-blog-details-widget ns-tag">
        <h5 class="ns-blog-details-widget-title">Tag Terpopuler</h5>
        <div class="ns-blog-details-tag">
            @foreach ($beritaPenanda as $key => $bp)
            <a href="{{ route('berita-list', array_merge(request()->query(), ['tag' => strtolower($key)])) }}">{{ $key }}</a>
            @endforeach
        </div>
    </div>
</div>