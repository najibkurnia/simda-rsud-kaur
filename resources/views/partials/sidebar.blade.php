<div class="col-2 px-0" style="height: 100vh;">
    <div class="p-0" style="position: relative; top: 120px">
        <a href="{{ route('presensi') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'presensi-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            Presensi
        </a>
        <a href="{{ route('rekap-presensi') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'presensi-rekap' ? 'active' : null }}" style="border: 1px solid #aaa">
            Rekap Absensi Bulanan
        </a>
        <a href="{{ route('data-dinas') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-dinas' ? 'active' : null }}" style="border: 1px solid #aaa">
            Data Dinas
        </a>
        <a href="{{ route('data-izin') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-izin' ? 'active' : null }}" style="border: 1px solid #aaa">
            Data Izin
        </a>
        <a href="{{ route('data-cuti') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-cuti' ? 'active' : null }}" style="border: 1px solid #aaa">
            Data Cuti
        </a>
        <a href="{{ route('data-permintaan') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'permintaan-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            Data Permintaan
        </a>
        <a href="{{ route('data-pelanggaran') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pelanggaran-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            Data Pelanggaran
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawai-index' ? 'active' : null }}" style="border: 1px solid #aaa">
            Data PNS
        </a>
        <a href="{{ route('data-pegawai') }}" class="menu-sidebar col-12 p-2 {{ $id_page == 'pegawaiindex' ? 'active' : null }}" style="border: 1px solid #aaa">
            Pengaturan        
        </a>
    </div>
</div>