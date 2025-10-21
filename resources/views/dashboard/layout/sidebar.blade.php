<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            @foreach($menu as $m)
            <li>
                <a class="has-arrow ai-icon" href="#">
                    <i class="{{ $m->icon }}"></i>
                    <span class="nav-text">{{ $m->name }}</span>
                </a>
                <ul>
                    @foreach($m->children as $c)
                    <li class="{{ $subMenu == $c->name ? 'mm-active' : '' }}"><a class="{{ $subMenu == $c->name ? 'mm-active' : '' }}" href="{{ route($c->route) }}">{{ $c->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
        <div class="copyright">
            <p><strong>SDN Srengseng Sawah 11</strong> <br>© 2025 Developed by HideKy</p>
        </div>
    </div>
</div>