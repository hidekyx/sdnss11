@extends('dashboard.layout.app')

@section('content')
<div class="content-body default-height">
    <!-- row -->
    <div class="container-fluid">
        <div class="form-head d-flex mb-3 mb-md-5 align-items-start flex-wrap justify-content-between">
            <div class="me-auto d-lg-block">
                <h3 class="text-primary font-w600">Selamat datang di dashboard SDN Srengseng Sawah 11!</h3>
                <p class="mb-0">Silahkan pilih menu</p>
            </div>

            <div class="input-group search-area ms-auto d-inline-flex">
                <input type="text" class="form-control" placeholder="Pencarian">
                <span class="input-group-text"><i class="flaticon-381-search-2"></i></span>
            </div>
        </div>
    </div>
</div>
@endsection