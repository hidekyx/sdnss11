@extends('dashboard.layout.app')

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        {{ $detailMenu }} - {{ $subMenu }}
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="{{ route('dashboard-pembelajaran-siswa-tambah') }}"><button class="button text-white bg-theme-1 shadow-md mr-2">Tambah {{ $subMenu }}</button></a>
            <div class="dropdown relative">
                <button class="dropdown-toggle button px-2 box text-gray-700">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="chevron-down"></i> </span>
                </button>
                <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                    <div class="dropdown-box__content box p-2">
                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </a>
                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Cetak ke Excel </a>
                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Cetak ke PDF </a>
                    </div>
                </div>
            </div>
            <form method="get" action="#" autocomplete="off" class="flex ml-auto">
                <div class="mr-3">
                    <select name="kelas" data-placeholder="Filter Kelas" class="select2 w-full pr-4">
                        <option value="Semua">Semua Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mr-3">
                    <input type="text" name="search" class="input w-auto box pr-10 placeholder-theme-13" placeholder="Cari Nama">
                </div>
                <div>
                    <button type="submit" class="button w-24 mr-1 flex items-center justify-center bg-theme-1 text-white"><i data-feather="search" class="w-4 h-4 mr-2"></i> Cari</button>
                </div>
            </form>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            @if(session('alert_type'))
            <x-alert
                :title="session('alert_title')"
                :type="session('alert_type')"
                :messages="session('alert_messages')"
                :display="'block'" />
            @endif

            <table class="table table-report -mt-2 mb-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">FOTO</th>
                        <th class="text-center whitespace-no-wrap">KELAS AKTIF</th>
                        <th class="whitespace-no-wrap">NAMA/NIPD/NISN/NIK</th>
                        <th class="whitespace-no-wrap">TTL/JK/AGAMA</th>
                        <th class="text-center whitespace-no-wrap">NO HP/ALAMAT</th>
                        <th class="text-center whitespace-no-wrap">FITUR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $s)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    @if($s->avatar && Storage::disk('public')->exists('images/avatar/' . $s->avatar))
                                    <img alt="Avatar" class="tooltip rounded-full" src="{{ asset('storage/images/avatar/'.$s->avatar) }}" title="{{ $s->name }}">
                                    @else
                                    <img alt="Avatar" class="tooltip rounded-full" src="{{ asset('assets/dashboard/images/preview-1.jpg') }}" title="{{ $s->name }}">
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="w-40">
                            <div class="flex items-center justify-center text-theme-6">
                                <div class="py-1 px-2 rounded-full text-xs bg-{{ $s->kelas->first()->color ?? '' }}-200 text-{{ $s->kelas->first()->color ?? '' }}-600 cursor-pointer text-center truncate">{{ $s->kelas->first()->nama ?? '-' }}</div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="font-medium text-theme-1 whitespace-no-wrap">{{ $s->nama }}</a>
                            <div class="text-gray-600 text-xs whitespace-no-wrap"><b>NIPD:</b> {{ $s->nipd ?? '-' }} / <b>NISN:</b> {{ $s->nisn ?? '-' }} / <b>NIK:</b> {{ $s->nik ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-no-wrap">{{ $s->tempat_lahir && $s->tanggal_lahir ? $s->tempat_lahir .', '. \Carbon\Carbon::parse($s->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}</div>
                            <div class="text-gray-600 text-xs whitespace-no-wrap"><b>{{ $s->jenis_kelamin }}</b> / <b>Agama:</b> {{ $s->agama ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-no-wrap">{{ $s->no_hp }}</div>
                            <div class="text-gray-600 text-xs">{{ $s->alamat_detail . ' RT ' . $s->alamat_rt . ' RW ' . $s->alamat_rw . $s->alamat_dusun . ' Kel. ' . $s->alamat_kelurahan  . ' Kec. ' . $s->alamat_kecamatan . ' Kode Pos. ' . $s->alamat_kode_pos  }}</div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-theme-11 mr-3" href="{{ route('dashboard-pembelajaran-siswa-edit', $s->id) }}"> <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-theme-6 delete-btn"
                                    href="javascript:;"
                                    data-toggle="modal"
                                    data-target="#delete-confirmation-modal"
                                    data-name="{{ $s->nama }}"
                                    data-submenu="{{ $subMenu }}"
                                    data-url="{{ route('dashboard-pembelajaran-siswa-hapus', $s->id) }}">
                                    <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $siswa->withQueryString() }}
        </div>
        <!-- END: Data List -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <form id="delete-form" method="POST" action="">
                @csrf
                @method('DELETE')

                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">Lanjutkan hapus?</div>
                    <div class="text-gray-600 mt-2">Data <span id="delete-item"></span> akan dihapus.</div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>
                    <button type="submit" class="button w-24 bg-theme-6 text-white">Hapus</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
</div>
@endsection

@push('scripts')
<script>
    $(document).on('click', '.delete-btn', function() {
        let name = $(this).data('name');
        let submenu = $(this).data('submenu') || '';
        let url = $(this).data('url');
        $('#delete-item').text(submenu + ' ' + name);
        $('#delete-form').attr('action', url);
    });
</script>
@endpush