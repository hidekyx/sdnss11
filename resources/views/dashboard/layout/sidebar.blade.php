<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a class="has-arrow ai-icon" href="#">
                    <i class="flaticon-381-layer-1"></i>
                    <span class="nav-text">Data Pembelajaran</span>
                </a>
                <ul>
                    <li class="{{ Route::is('dashboard-pembelajaran-guru-dan-tendik*') ? 'mm-active' : '' }}"><a class="{{ Route::is('dashboard-pembelajaran-guru-dan-tendik*') ? 'mm-active' : '' }}" href="{{ route('dashboard-pembelajaran-guru-dan-tendik') }}">Guru dan Tendik</a></li>
                    <li class="{{ Route::is('dashboard-pembelajaran-kelas*') ? 'mm-active' : '' }}"><a class="{{ Route::is('dashboard-pembelajaran-kelas*') ? 'mm-active' : '' }}" href="{{ route('dashboard-pembelajaran-kelas') }}">Kelas</a></li>
                    <li class="{{ Route::is('dashboard-pembelajaran-siswa*') ? 'mm-active' : '' }}"><a class="{{ Route::is('dashboard-pembelajaran-siswa*') ? 'mm-active' : '' }}" href="{{ route('dashboard-pembelajaran-siswa') }}">Siswa</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="#">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Publikasi</span>
                </a>
                <ul>
                    <li class="{{ Route::is('dashboard-publikasi-berita*') ? 'mm-active' : '' }}"><a class="{{ Route::is('dashboard-publikasi-berita*') ? 'mm-active' : '' }}" href="{{ route('dashboard-publikasi-berita') }}">Berita</a></li>
                    <li><a href="#">Agenda</a></li>
                    <li><a href="#">Prestasi</a></li>
                </ul>
            </li>
        </ul>
        <div class="copyright">
            <p><strong>SDN Srengseng Sawah 11</strong> <br>© 2025 Developed by HideKy</p>
        </div>
    </div>
</div>