<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">

    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            {{-- ==========================================================
            | MAIN
            =========================================================== --}}

            <li class="navigation-header">
                <span>Main</span>
                <i class="feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Main"></i>
            </li>

            <li class="nav-item {{ request()->segment(1) == 'panel' ? 'active' : '' }}">
                <a href="{{ route('panel.index') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Beranda">
                        Beranda
                    </span>
                </a>
            </li>


            {{-- ==========================================================
            | LEVEL 1 & 2
            =========================================================== --}}

            @if (Auth::user()->level == 1 || Auth::user()->level == 2)

                {{-- INFO PENTING --}}
                @if (in_array(getSttsUser(), ['2', '3', '4']))
                    <li class="nav-item {{ request()->is('cekpassword/password') ? 'active' : '' }}">
                        <a href="{{ route('cekpassword.password') }}">
                            <i class="fa fa-info-circle"></i>
                            <span class="menu-title" data-i18n="Info Penting">
                                Info Penting
                            </span>
                        </a>
                    </li>
                @endif


                {{-- ======================================================
                | MENU USER AKTIF
                ======================================================= --}}

                @if (getSttsUser() == 1)

                    {{-- PROSES PERMOHONAN --}}
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-random"></i>
                            <span class="menu-title" data-i18n="Permohonan">
                                Proses Permohonan
                            </span>
                        </a>

                        <ul class="menu-content">

                            <li
                                class="nav-item
                                {{ request()->url() == url('/datapermohonan/viewProses/Masuk') ? 'active' : '' }}">

                                <a href="{{ route('datapermohonan.viewProses', ['act' => 'Masuk']) }}">
                                    <i class="fa fa-file-text"></i>
                                    <span class="menu-title">
                                        Masuk
                                    </span>
                                </a>

                            </li>


                            <li
                                class="nav-item
                                {{ request()->url() == url('/datapermohonan/viewProses/Proses') ? 'active' : '' }}
                                {{ Request::is('datapermohonan/kartuInput*') ? 'active' : '' }}">

                                <a href="{{ route('datapermohonan.viewProses', ['act' => 'Proses']) }}">
                                    <i class="fa fa-spinner"></i>
                                    <span class="menu-title">
                                        Proses
                                    </span>
                                </a>

                            </li>

                        </ul>
                    </li>


                    {{-- HISTORI --}}
                    <li class="nav-item">
                        <a href="{{ route('historikartupengawas.index') }}">
                            <i class="fa fa-clone"></i>
                            <span class="menu-title">
                                Histori Kartu Pengawas
                            </span>
                        </a>
                    </li>


                    {{-- PIC KAB/KOTA --}}
                    @if (Auth::user()->level == 2)
                        <li class="nav-item {{ request()->url() == url('/PIC') ? 'active' : '' }}">
                            <a href="{{ route('PIC.index') }}">
                                <i class="fa fa-phone"></i>
                                <span class="menu-title">
                                    PIC Kab/Kota
                                </span>
                            </a>
                        </li>
                    @endif


                    {{-- LAPORAN --}}
                    <li class="nav-item">

                        <a href="#">
                            <i class="fa fa-print"></i>
                            <span class="menu-title">
                                Laporan
                            </span>
                        </a>

                        <ul class="menu-content">

                            <li class="nav-item">
                                <a href="{{ route('laporan.permohonan') }}">
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span class="menu-title">
                                        Lap. Permohonan
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('laporan.kendaraan') }}">
                                    <i class="fa fa-file-pdf-o"></i>
                                    <span class="menu-title">
                                        Lap. Data Kendaraan
                                    </span>
                                </a>
                            </li>

                        </ul>

                    </li>

                @endif

            @endif


            {{-- ==========================================================
            | LEVEL 1
            =========================================================== --}}

            @if (Auth::user()->level == 1)

                {{-- ======================================================
                | USER AKTIF
                ======================================================= --}}

                @if (getSttsUser() == 1)
                    {{-- TOOLS --}}
                    <li class="nav-item">

                        <a href="#">
                            <i class="fa fa-cog"></i>
                            <span class="menu-title">
                                Tools
                            </span>
                        </a>

                        <ul class="menu-content">

                            <li class="nav-item" style="font-size:11px;">

                                <a href="{{ route('tools.ubahStatusKartuPengawas') }}">

                                    <i class="fa fa-file-text"></i>

                                    <span class="menu-title">
                                        Ubah Status Kartu Pengawas
                                    </span>

                                </a>

                            </li>

                        </ul>

                    </li>


                    {{-- GLOBAL --}}
                    <li class="navigation-header">

                        <span>GLOBAL</span>

                        <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                            data-original-title="Global"></i>

                    </li>


                    {{-- CEK DATA --}}
                    <li class="nav-item">

                        <a href="#">
                            <i class="fa fa-search"></i>
                            <span class="menu-title">
                                Cek Data
                            </span>
                        </a>

                        <ul class="menu-content">

                            <li class="nav-item {{ request()->url() == url('/badanUsaha') ? 'active' : '' }}">

                                <a href="{{ route('badanUsaha') }}">

                                    <i class="fa fa-file-text"></i>

                                    <span class="menu-title">
                                        Badan Usaha
                                    </span>

                                </a>

                            </li>


                            <li class="nav-item {{ request()->url() == url('/kendaraan') ? 'active' : '' }}">

                                <a href="{{ route('kendaraan') }}">

                                    <i class="fa fa-car"></i>

                                    <span class="menu-title">
                                        Kendaraan
                                    </span>

                                </a>

                            </li>


                            <li class="nav-item {{ request()->url() == url('/mutasiPIC') ? 'active' : '' }}">

                                <a href="{{ route('mutasiPIC.index') }}">

                                    <i class="fa fa-random"></i>

                                    <span class="menu-title">
                                        Mutasi PIC
                                    </span>

                                </a>

                            </li>

                        </ul>

                    </li>


                    {{-- PARAMETER --}}
                    <li class="navigation-header">

                        <span>Parameter</span>

                        <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                            data-original-title="Parameter"></i>

                    </li>


                    <li class="nav-item {{ request()->url() == url('/ttddokumen') ? 'active' : '' }}">

                        <a href="{{ route('ttddokumen.index') }}">

                            <i class="fa fa-file-text"></i>

                            <span class="menu-title">
                                TTD Dokumen
                            </span>

                        </a>

                    </li>


                    <li class="nav-item {{ request()->url() == url('/cparJenisPermohonan') ? 'active' : '' }}">

                        <a href="{{ route('cparJenisPermohonan.index') }}">

                            <i class="fa fa-file-text"></i>

                            <span class="menu-title">
                                Jenis Permohonan
                            </span>

                        </a>

                    </li>


                    {{-- KENDARAAN --}}
                    <li class="nav-item">

                        <a href="#">

                            <i class="fa fa-car"></i>

                            <span class="menu-title">
                                Kendaraan
                            </span>

                        </a>

                        <ul class="menu-content">

                            <li class="nav-item {{ request()->url() == url('/cparKendaraanMerek') ? 'active' : '' }}">

                                <a href="{{ route('cparKendaraanMerek.index') }}">

                                    <i class="fa fa-file-text"></i>

                                    <span class="menu-title">
                                        Merek
                                    </span>

                                </a>

                            </li>


                            <li class="nav-item {{ request()->url() == url('/cparKendaraanType') ? 'active' : '' }}">

                                <a href="{{ route('cparKendaraanType.index') }}">

                                    <i class="fa fa-file-text"></i>

                                    <span class="menu-title">
                                        Type
                                    </span>

                                </a>

                            </li>

                        </ul>

                    </li>


                    {{-- TRAYEK --}}
                    <li class="nav-item {{ request()->url() == url('/cparTrayek') ? 'active' : '' }}">

                        <a href="{{ route('cparTrayek.index') }}">

                            <i class="fa fa-road"></i>

                            <span class="menu-title">
                                Trayek
                            </span>

                        </a>

                    </li>


                    {{-- MENGANGKUT --}}
                    <li class="nav-item {{ request()->url() == url('/cparMengangkut') ? 'active' : '' }}">

                        <a href="{{ route('cparMengangkut.index') }}">

                            <i class="fa fa-th-large"></i>

                            <span class="menu-title">
                                Mengangkut
                            </span>

                        </a>

                    </li>


                    {{-- PIC --}}
                    <li class="nav-item {{ request()->url() == url('/PIC') ? 'active' : '' }}">

                        <a href="{{ route('PIC.index') }}">

                            <i class="fa fa-phone"></i>

                            <span class="menu-title">
                                PIC Kab/Kota
                            </span>

                        </a>

                    </li>


                    {{-- MANAGEMENT USER --}}
                    <li class="navigation-header">

                        <span>Managemen User</span>

                        <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                            data-original-title="Managemen User"></i>

                    </li>


                    <li class="nav-item {{ request()->url() == url('/dataUser') ? 'active' : '' }}">

                        <a href="{{ route('dataUser.index') }}">

                            <i class="fa fa-th-large"></i>

                            <span class="menu-title">
                                Data User Pengguna
                            </span>

                        </a>

                    </li>


                    <li class="nav-item {{ request()->url() == url('/dataUserPetugas') ? 'active' : '' }}">

                        <a href="{{ route('dataUserPetugas.index') }}">

                            <i class="fa fa-th-large"></i>

                            <span class="menu-title">
                                Data User Petugas
                            </span>

                        </a>

                    </li>
                @endif


                {{-- ======================================================
                | MAINTENANCE
                | Tidak tergantung stts_user
                ======================================================= --}}

                @if (Auth::user()->maintenance_access == 1)
                    <li class="navigation-header">

                        <span>More Tool</span>

                        <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                            data-original-title="More Tool"></i>

                    </li>


                    <li class="nav-item {{ request()->is('maintenance') ? 'active' : '' }}">

                        <a href="{{ route('maintenance.index') }}">

                            <i class="fa fa-wrench"></i>

                            <span class="menu-title" data-i18n="Maintenance">
                                Maintenance
                            </span>

                        </a>

                    </li>
                @endif

            @endif


            {{-- ==========================================================
            | LEVEL 3
            =========================================================== --}}

            @if (Auth::user()->level == 3)

                {{-- INFO PENTING --}}
                @if (in_array(getSttsUser(), ['2', '3', '4']))
                    <li class="nav-item {{ request()->is('cekpassword/password') ? 'active' : '' }}">

                        <a href="{{ route('cekpassword.password') }}">

                            <i class="fa fa-info-circle"></i>

                            <span class="menu-title">
                                Info Penting
                            </span>

                        </a>

                    </li>
                @endif


                @if (getSttsUser() == 1)
                    {{-- PENGAJUAN PERMOHONAN --}}
                    <li class="nav-item">

                        <a href="#">

                            <i class="fa fa-random"></i>

                            <span class="menu-title" style="font-size:12px;">

                                Pengajuan Permohonan

                            </span>

                        </a>

                        <ul class="menu-content">

                            <li
                                class="nav-item
                                {{ request()->url() == url('/pengajuanpermohonan') ? 'active' : '' }}">

                                <a href="{{ route('pengajuanpermohonan.index') }}">

                                    <i class="fa fa-file-text-o"></i>

                                    <span class="menu-title">
                                        Isi Form
                                    </span>

                                </a>

                            </li>


                            <li
                                class="nav-item
                                {{ URL::full() == url('/datapermohonan?act=Input') ? 'active' : '' }}">

                                <a href="{{ route('datapermohonan.index', ['act' => 'Input']) }}">

                                    <i class="fa fa-file-text-o"></i>

                                    <span class="menu-title">
                                        Data Permohonan
                                    </span>

                                </a>

                            </li>

                        </ul>

                    </li>


                    {{-- HISTORI --}}
                    <li
                        class="nav-item
                        {{ URL::full() == url('/datapermohonan?act=Histori') ? 'active' : '' }}
                        {{ Request::is('datapermohonan/kartuInput*') ? 'active' : '' }}">

                        <a href="{{ route('datapermohonan.index', ['act' => 'Histori']) }}">

                            <i class="fa fa-clone"></i>

                            <span class="menu-title">
                                Histori Permohonan
                            </span>

                        </a>

                    </li>


                    {{-- GLOBAL --}}
                    <li class="navigation-header">

                        <span>Global</span>

                        <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                            data-original-title="Global"></i>

                    </li>


                    {{-- BIODATA --}}
                    <li class="nav-item
                        {{ URL::full() == url('/biodata') ? 'active' : '' }}">

                        <a href="{{ route('biodata.index') }}">

                            <i class="fa fa-user"></i>

                            <span class="menu-title">
                                Biodata
                            </span>

                        </a>

                    </li>


                    {{-- DATA KENDARAAN --}}
                    <li
                        class="nav-item
                        {{ URL::full() == url('/datakendaraan') ? 'active' : '' }}">

                        <a href="{{ route('datakendaraan.index') }}">

                            <i class="fa fa-car"></i>

                            <span class="menu-title">
                                Data Kendaraan
                            </span>

                        </a>

                    </li>
                @endif

            @endif

        </ul>

    </div>

</div>
