<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        Dashboard
                    </div>
                </div>

                <ul class="navbar-nav header-right">
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
                            <i id="icon-light" class="fas fa-sun"></i>
                            <i id="icon-dark" class="fas fa-moon"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link dz-fullscreen" href="javascript:void(0);">
                            <i id="icon-full" class="fa-solid fa-expand"></i>
                            <i id="icon-minimize" class="fa-solid fa-compress"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <div class="header-info">
                                <span>{{ Auth::user()->name }}</span>
                                <small>{{ Auth::user()->role->name }}</small>
                            </div>
                            @if(Auth::user()->avatar && Storage::disk('public')->exists('images/avatar/' . Auth::user()->avatar))
                            <img src="{{ asset('storage/images/avatar/'.Auth::user()->avatar) }}" width="20">
                            @else
                            <img src="{{ asset('assets/dashboard/images/profile-default.png') }}" width="20">
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="#" class="dropdown-item ai-icon">
                                <span class="mdi mdi-account text-info"></span>
                                <span class="ms-2">Profile </span>
                            </a>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item ai-icon">
                                    <span class="mdi mdi-logout text-danger"></span>
                                    <span class="ms-2">Logout </span>
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>