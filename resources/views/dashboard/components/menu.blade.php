@props(['menus'])

<ul>
    @foreach($menus as $menu)
        <li>
            <a href="{{ Route::has($menu->route) ? route($menu->route) : '#' }}"
               class="top-menu {{ request()->is(ltrim($menu->route, '/')) ? 'top-menu--active' : '' }}">
               
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
                <x-menu :menus="$menu->children" />
            @endif
        </li>
    @endforeach
</ul>
