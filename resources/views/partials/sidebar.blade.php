<div class="sidebar-menu">
    <div class="menu-btn">
        <i class='bx bxl-flutter'></i>
    </div>
    <div class="menu">
        <p class="title">Menu</p>
        <ul>
            <li class="{{ \Route::is('presensi') ? 'active' : (\Route::is('detail-presensi') ? 'active' : '') }}">
                <a href="{{ route('presensi') }}" class="sidebar-link">
                    <i class='bx bxs-customize'></i>
                    <span class="text">Presensi</span>
                </a>
            </li>
            <li class="{{ \Route::is('rekap-presensi') ? 'active' : '' }}">
                <a href="{{ route('rekap-presensi') }}" class="sidebar-link">
                    <i class='bx bxs-layer'></i>
                    <span class="text">Abesensi Bulanan</span>
                </a>
            </li>
            <li>
                <a href="#" class="sidebar-link">
                    <i class='bx bxs-copy-alt'></i>
                    <span class="text">Data</span>
                    <i class='bx bx-caret-down crt'></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('data-dinas') }}">
                            <span class="text">Dinas</span>
                        </a>
                    </li>
                    <li class="item ">
                        <a href="{{ route('data-izin') }}">
                            <span class="text">Izin</span>
                        </a>
                    </li>
                    <li class="item ">
                        <a href="{{ route('data-cuti') }}">
                            <span class="text">Cuti</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ \Route::is('data-permintaan') || \Route::is('rincian-permintaan') ? 'active' : '' }}">
                <a href="{{ route('data-permintaan') }}" class="sidebar-link">
                    <i class='bx bxs-hourglass-top'></i>
                    <span class="text">Permintaan</span>
                </a>
            </li>
            <li class="{{ \Route::is('data-pelanggaran') ? 'active' : '' }}">
                <a href="{{ route('data-pelanggaran') }}" class="sidebar-link">
                    <i class='bx bxs-shield-minus'></i>
                    <span class="text">Pelanggaran</span>
                </a>
            </li>
            <li class="{{ \Route::is('data-pegawai') ? 'active' : '' }}">
                <a href="{{ route('data-pegawai') }}" class="sidebar-link">
                    <i class='bx bxs-user-account'></i>
                    <span class="text">Daftar PNS</span>
                </a>
            </li>
            <li class="{{ \Route::is('pengaturan') ? 'active' : '' }}">
                <a href="{{ route('pengaturan') }}" class="sidebar-link">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
</div>
