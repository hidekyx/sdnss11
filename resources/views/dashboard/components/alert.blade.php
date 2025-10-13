@props(['title', 'type', 'messages'])

<div id="alert-container" class="rounded-md px-5 py-4 mb-2 bg-theme-31 text-theme-6">
    <div class="flex flex items-center">
        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> 
        <strong>{{ $title }}</strong>
    </div>
    <div id="error-messages">
        @foreach ($errors->all() as $error)
        <p class="mb-0">{{ $error }}</p>
        @endforeach
    </div>
</div>