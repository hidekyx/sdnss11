@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $mainMenu }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $subMenu }}</a></li>
            </ol>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $detailMenu }} - {{ $subMenu }}</h4>
                    </div>
                    <div class="card-body">
                        @if(session('alert_type'))
                        <x-alert
                            :title="session('alert_title')"
                            :type="session('alert_type')"
                            :icon="session('alert_icon')"
                            :messages="session('alert_messages')"
                            :display="'block'" />
                        @endif

                        @if(session('errors'))
                        <x-alert :title="'Validasi Gagal!'" :type="'danger'" :icon="'mdi-alert'" :messages="[]" :display="'block'" />
                        @endif

                        <div class="basic-form">
                            <form class="validate-form" action="{{ $detailMenu == 'Tambah' ? route('dashboard-publikasi-berita-simpan') : route('dashboard-publikasi-berita-perbaharui', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @if($detailMenu != 'Tambah')
                                @method('PUT')
                                @endif

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="kategori">Kategori</label>
                                    <div class="col-sm-9">
                                        <select id="kategori" name="kategori" data-placeholder="Pilih Kategori" class="default-select form-control wide" required>
                                            @foreach ($kategoriBerita as $key => $kb)
                                            <option value="{{ $key }}" {{ isset($berita) && $berita->kategori->value == $key ? 'selected' : '' }}>{{ $kb }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="title">Judul Berita</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Judul Berita" value="{{ $berita->title ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="published_at">Tanggal Publikasi</label>
                                    <div class="col-sm-9">
                                        <input name="published_at" class="datepicker-default form-control" id="published_at" placeholder="Tanggal Publikasi" data-value="{{ isset($berita) && $berita->published_at ? \Carbon\Carbon::parse($berita->published_at)->isoFormat('Y/MM/D') : '' }}" required>
                                    </div>
                                </div>
                                @if(Auth::user()->role->id == App\Enums\Role::Admin->value || Auth::user()->role->id == App\Enums\Role::KepalaSekolah->value || Auth::user()->role->id == App\Enums\Role::TataUsaha->value)
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Status Publikasi</label>
                                    <div class="col-sm-9">
                                        <div class="form-check custom-checkbox">
                                            <input name="is_published" id="is_published" type="checkbox" class="form-check-input" {{ isset($berita) && $berita->is_published->value == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_published">Publikasikan</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="content">Konten Berita</label>
                                    <div class="col-sm-9 custom-ekditor">
                                        <textarea id="content" name="content" class="form-control summernote" placeholder="Konten Berita" rows="10" required>{{ $berita->content ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="tags">Tags</label>
                                    <div class="col-sm-9">
                                        <select class="multi-select form-control" style="width:100%;" name="tags[]" multiple="multiple">
                                            @foreach($tags as $t)
                                            <option value="{{ $t->title }}">{{ $t->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="quote">Kutipan</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-3">
                                                <select id="quote_by" name="quote_by" data-placeholder="Pilih Kutipan Dari" class="default-select form-control wide" required>
                                                    @foreach ($user as $u)
                                                    <option value="{{ $u->id }}" {{ isset($berita) && $berita->quote_by->id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" name="quote" id="quote" class="form-control" placeholder="Kutipan" value="{{ $berita->quote ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="img">Foto Utama</label>
                                    <div class="col-sm-9">
                                        <input id="img" name="img" class="form-control mb-3" type="file" placeholder="img" accept=".png, .jpg, .jpeg" {{ isset($berita) && $berita->img ? '' : 'required'}}>
                                        @if(isset($berita) && $berita->img && Storage::disk('public')->exists('images/berita/' . $berita->img))
                                        <img id="foto-preview_img" class="rounded" alt="Foto Utama" src="{{ asset('storage/images/berita/'.$berita->img) }}" width="125">
                                        @else
                                        <img id="foto-preview_img" class="rounded d-none" alt="Foto Utama" width="125">
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="caption">Caption Gambar</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="caption" id="caption" class="form-control" placeholder="Caption Gambar" value="{{ $berita->caption ?? '' }}" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label" for="img_tambahan">Foto Tambahan</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            @foreach (range(2, 4) as $num)
                                            <div class="col-lg-4">
                                                <input id="img_{{ $num }}" name="img_{{ $num }}" class="form-control mb-3" type="file" placeholder="img" accept=".png, .jpg, .jpeg">
                                                @if(isset($berita) && $berita->{'img_' . $num} && Storage::disk('public')->exists('images/berita/' . $berita->{'img_' . $num}))
                                                <img id="foto-preview_img_{{ $num }}" class="rounded" alt="Foto Tambahan" src="{{ asset('storage/images/berita/'.$berita->{'img_' . $num}) }}" width="125">
                                                @else
                                                <img id="foto-preview_img_{{ $num }}" class="rounded d-none" alt="Foto Tambahan" width="125">
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function() {
        $(".summernote").summernote({
            height: 190,
            minHeight: null,
            maxHeight: null,
            focus: !1,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['para', ['ul', 'ol']]
            ]
        }), 
        
        $(".inline-editor").summernote({
            airMode: !0
        }),

        $('.datepicker-default').pickadate({
            formatSubmit: 'yyyy-mm-dd',
        })
    });

    $('input[type="file"]').on("change", function(event) {
        var id = $(this).attr('name');
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#foto-preview_" + id).attr("src", e.target.result).removeClass('d-none');
            };
            reader.readAsDataURL(file);
        }
    });

    $(".multi-select").select2({
        placeholder: "Pilih tag"
    });
</script>
@endpush