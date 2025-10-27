@extends('landing-page.layout.app')

@section('content')
<section class="ns-about-area pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="ns-bg-primary fw-bold">
                            <td>Waktu/Tanggal</td>
                            <td>Kegiatan</td>
                            <td>Lokasi</td>
                            <td>Penanggung Jawab</td>
                            <td>Status</td>
                        </thead>
                        <tbody>
                            @foreach($agenda as $a)
                            <tr>
                                <td>
                                    <p class="ns-blog-date text-secondary mb-0">
                                        <i class="icofont-calendar text-danger"></i>
                                        {{ \Carbon\Carbon::parse($a->date)->isoFormat('D MMMM Y') }}
                                    </p>
                                    <p class="ns-blog-date text-secondary mb-0">
                                        <i class="icofont-clock-time text-danger"></i>
                                        {{ $a->time }}
                                    </p>
                                </td>
                                <td>
                                    <span class="fw-bold">{{ $a->title }}</span>
                                </td>
                                <td>
                                    <p class="ns-blog-date text-secondary mb-0">
                                        <i class="icofont-location-pin text-danger"></i>
                                        {{ $a->location }}
                                    </p>
                                </td>
                                <td>
                                    <span>{{ $a->penanggungJawab->name }}</span>
                                </td>
                                <td>
                                    @if(\Carbon\Carbon::parse($a->date)->isBefore(\Carbon\Carbon::today()))
                                    <span class="badge bg-success">Selesai</span>
                                    @elseif(\Carbon\Carbon::parse($a->date)->isSameDay(\Carbon\Carbon::today()))
                                    <span class="badge bg-primary">Berlangsung</span>
                                    @else
                                    <span class="badge bg-warning">Mendatang</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $agenda->onEachSide(1)->withQueryString()->links('landing-page.layout.pagination') }}
            </div>
        </div>
    </div>
</section>
@endsection