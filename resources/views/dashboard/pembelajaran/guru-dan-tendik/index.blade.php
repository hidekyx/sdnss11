@extends('dashboard.layout.app')

@section('content')
<div class="content">
    <h2 class="intro-y text-lg font-medium mt-10">
        {{ $detailMenu }} - {{ $subMenu }}
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <button class="button text-white bg-theme-1 shadow-md mr-2">Tambah {{ $subMenu }}</button>
            <div class="dropdown relative">
                <button class="dropdown-toggle button px-2 box text-gray-700">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="chevron-down"></i> </span>
                </button>
                <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                    <div class="dropdown-box__content box p-2">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Cetak ke Excel </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Cetak ke PDF </a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-full relative text-gray-700">
                    <div class="flex">
                        <div class="mr-3">
                            <select data-placeholder="Filter Role" class="select2 w-full" multiple>
                                @foreach($kategoriRole as $kr)
                                <option value="{{ $kr->id }}">{{ $kr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Cari Nama">
                            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">FOTO</th>
                        <th class="whitespace-no-wrap">NAMA/NIP/NRK</th>
                        <th class="text-center whitespace-no-wrap">ROLE</th>
                        <th class="whitespace-no-wrap">TTL/ALAMAT</th>
                        <th class="text-center whitespace-no-wrap">HP/EMAIL</th>
                        <th class="text-center whitespace-no-wrap">FITUR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $u)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full" src="dist/images/preview-4.jpg" title="Uploaded at 17 July 2021">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" class="font-medium text-theme-1 whitespace-no-wrap">{{ $u->name }}</a>
                            <div class="text-gray-600 text-xs whitespace-no-wrap"><b>NIP:</b> {{ $u->nip ?? '-' }} / <b>NRK:</b> {{ $u->nrk ?? '-' }}</div>
                        </td>
                        <td class="w-40">
                            <div class="flex items-center justify-center text-theme-6">
                                <div class="py-1 px-2 rounded-full text-xs bg-{{ $u->role->color }}-200 text-{{ $u->role->color }}-600 cursor-pointer text-center truncate">{{ $u->role->name }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-no-wrap">{{ $u->tempat_lahir && $u->tanggal_lahir ? $u->tempat_lahir .', '. \Carbon\Carbon::parse($u->tanggal_lahir)->isoFormat('D MMMM Y') : '-' }}</div>
                            <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $u->alamat }}</div>
                        </td>
                        <td>
                            <div class="font-medium whitespace-no-wrap">{{ $u->no_hp }}</div>
                            <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $u->email }}</div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-theme-11 mr-3" href="javascript:;"> <i data-feather="edit" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            <ul class="pagination">
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-left"></i> </a>
                </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li> <a class="pagination__link" href="">1</a> </li>
                <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
                <li> <a class="pagination__link" href="">3</a> </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-right"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                </li>
            </ul>
            <select class="w-20 input box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
            </div>
        </div>
    </div>
    <!-- END: Delete Confirmation Modal -->
</div>
@endsection