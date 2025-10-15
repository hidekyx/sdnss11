@props(['title', 'type', 'icon', 'messages'])

<div class="alert alert-{{ $type }} left-icon-big alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
    </button>
    <div class="media">
        <div class="alert-left-icon-big">
            <span><i class="mdi {{ $icon }}"></i></span>
        </div>
        <div class="media-body">
            <h5 class="mt-1 mb-2">{{ $title }}</h5>
            @foreach ($messages as $message)
            <p class="mb-0">{{ $message }}</p>
            @endforeach

            @foreach ($errors->all() as $error)
            <p class="mb-0">{{ $error }}</p>
            @endforeach
        </div>
    </div>
</div>