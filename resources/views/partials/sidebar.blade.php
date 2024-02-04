<div class="col-2 px-0" style="height: 100vh;">
    <div class="p-0" style="position: relative; top: 120px">
        <a href="{{ route('presensi') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'presensi-index' ? 'active' : null }}">
            Presensi
        </a>
        <a href="{{ route('rekap-presensi') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'presensi-rekap' ? 'active' : null }}">
            Rekap Absensi Bulanan
        </a>
        <a href="{{ route('data-dinas') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-dinas' ? 'active' : null }}">
            Data Dinas
        </a>
        <a href="{{ route('data-izin') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-izin' ? 'active' : null }}">
            Data Izin
        </a>
        <a href="{{ route('data-cuti') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-cuti' ? 'active' : null }}">
            Data Cuti
        </a>
        <a href="{{ route('data-permintaan') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-index' ? 'active' : null }}">
            Data Permintaan
        </a>
        <a href="{{ route('data-pelanggaran') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pelanggaran-index' ? 'active' : null }}">
            Data Pelanggaran
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawai-index' ? 'active' : null }}">
            Data PNS
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawaiindex' ? 'active' : null }}">
            Pengaturan        
        </a>
    </div>
</div>