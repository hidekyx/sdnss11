@extends('landing-page.layout.app')

@section('content')
    @include('landing-page.home.banner')
    @include('landing-page.home.counter')
    @include('landing-page.home.profil')
    @include('landing-page.home.agenda')
    @include('landing-page.home.ekstrakulikuler')
    @include('landing-page.home.berita')
@endsection