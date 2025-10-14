@props(['title', 'type', 'messages'])

@php
    if($type == "success") { $bgTheme = 'bg-theme-18'; $textTheme = 'text-theme-9'; }
    if($type == "danger") { $bgTheme = 'bg-theme-31'; $textTheme = 'text-theme-6'; }
    if($type == "info") { $bgTheme = 'bg-theme-14'; $textTheme = 'text-theme-10'; }
@endphp

<div id="alert-container" class="rounded-md px-5 py-4 mb-2 {{ $bgTheme }} {{ $textTheme }}">
    <div class="flex flex items-center">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
        <strong>{{ $title }}</strong>
    </div>
    @if(session('errors'))
    <div id="error-messages">
        @foreach ($errors->all() as $error)
        <p class="mb-0">{{ $error }}</p>
        @endforeach
    </div>
    @else
    <div id="messages">
        @foreach ($messages as $message)
        <p class="mb-0">{{ $message }}</p>
        @endforeach
    </div>
    @endif
</div>