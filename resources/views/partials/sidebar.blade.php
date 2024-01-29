<div class="col-2 bg-primer px-0" style="height: 100vh;">
    <div class="p-0" style="position: relative; top: 120px">
        <a href="{{ route('presensi') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'presensi-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Presensi</span>
        </a>
        <a href="{{ route('rekap-presensi') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'presensi-rekap' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Rekap Absensi Bulanan</span>
        </a>
        <a href="{{ route('data-dinas') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-dinas' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data Dinas</span>
        </a>
        <a href="{{ route('data-izin') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-izin' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data Izin</span>
        </a>
        <a href="{{ route('data-cuti') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-cuti' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data Cuti</span>
        </a>
        <a href="{{ route('data-permintaan') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data Permintaan</span>
        </a>
        <a href="{{ route('data-pelanggaran') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pelanggaran-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data Pelanggaran</span>
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawai-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data PNS</span>
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawai-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Data Akun</span>
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawai-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            <span class="text-dark">Pengaturan</span>
        </a>
    </div>
</div>