@props(['menus'])

<ul>
    @foreach($menus as $menu)
    <li>
        <a href="{{ Route::has($menu->route) ? route($menu->route) : '#' }}"
            class="top-menu {{ request()->is(trim($menu->route, '/') . '*') ? 'top-menu--active' : '' }}">

            <div class="top-menu__icon">
                <i data-feather="{{ $menu->icon }}"></i>
            </div>

            <div class="top-menu__title">
                {{ $menu->name }}
                @if ($menu->children->isNotEmpty())
                <i data-feather="chevron-down" class="top-menu__sub-icon"></i>
                @endif
            </div>
        </a>

        @if ($menu->children->isNotEmpty())
            <ul>
                @foreach($menu->children as $children)
                <li>
                    <a href="{{ Route::has($children->route) ? route($children->route) : '#' }}" class="top-menu">

                        <div class="top-menu__icon">
                            <i data-feather="{{ $children->icon }}"></i>
                        </div>

                        <div class="top-menu__title">
                            {{ $children->name }}
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        @endif
    </li>
    @endforeach
</ul>