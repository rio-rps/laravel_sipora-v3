<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="navigation-header">
                <span>Main</span>
                <i class="feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="Main"></i>
            </li>
            <li class="nav-item {{ request()->segment(1) == 'panel' ? 'active ' : '' }}">
                <a href="{{ route('panel.index') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Beranda">Beranda</span>
                </a>
            </li>

            @if (Auth::user()->level == 1 or Auth::user()->level == 2)
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-random"></i>
                        <span class="menu-title" data-i18n="Permohonan">Proses Permohonan</span>
                    </a>
                    <ul class="menu-content">
                        <li
                            class="nav-item {{ request()->url() == url('/datapermohonan/viewProses/Masuk') ? 'active' : '' }}">
                            <a href=" {{ route('datapermohonan.viewProses', ['act' => 'Masuk']) }}">
                                <i class="fa fa-file-text"></i>
                                <span class="menu-title" data-i18n="Masuk">Masuk</span>
                            </a>
                        </li>
                        <li
                            class="nav-item {{ request()->url() == url('/datapermohonan/viewProses/Proses') ? 'active' : '' }} || {{ Request::is('datapermohonan/kartuInput*') ? 'active' : '' }}">
                            <a href="{{ route('datapermohonan.viewProses', ['act' => 'Proses']) }}">
                                <i class="fa fa-spinner"></i>
                                <span class="menu-title" data-i18n="Proses">Proses</span>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item ">
                    <a href="{{ route('historikartupengawas.index') }}">
                        <i class="fa fa-clone"></i>
                        <span class="menu-title" data-i18n="Histori Kartu Pengawas">Histori Kartu Pengawas</span>
                    </a>
                </li>
                @if (Auth::user()->level == 2)
                    <li class="nav-item {{ request()->url() == url('/PIC') ? 'active' : '' }}">
                        <a href="{{ route('PIC.index') }}">
                            <i class="fa fa-phone"></i>
                            <span class="menu-title" data-i18n="PIC Kab/Kota">PIC Kab/Kota</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-print"></i>
                        <span class="menu-title" data-i18n="Laporan">Laporan</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item ">
                            <a href="{{ route('laporan.permohonan') }}">
                                <i class="fa fa-file-pdf-o"></i>
                                <span class="menu-title" data-i18n="Lap. Permohonan">Lap. Permohonan</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('laporan.kendaraan') }}">
                                <i class="fa fa-file-pdf-o"></i>
                                <span class="menu-title" data-i18n="Lap.Data Kendaraan">Lap. Data kendaraan</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->level == 2)
                {{--  <li class="navigation-header">
                    <span>GLOBAL</span>
                    <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                        data-original-title="Global"></i>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-search"></i>
                        <span class="menu-title" data-i18n="Cek Data">Cek Data</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item {{ request()->url() == url('/qrcode') ? 'active' : '' }} ">
                            <a href="{{ route('qrcode.index') }}">
                                <i class="fa fa-qrcode"></i>
                                <span class="menu-title" data-i18n="QRCODE">QR CODE</span>
                            </a>
                        </li>
                    </ul>
                </li>  --}}
            @endif
            @if (Auth::user()->level == 1)
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span class="menu-title" data-i18n="Tools">Tools</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item" style="font-size:11px;">
                            <a href="{{ route('tools.ubahStatusKartuPengawas') }}">
                                <i class="fa fa-file-text"></i>
                                <span class="menu-title" data-i18n="Ubah Status Kartu Pengawas"
                                    title="Ubah Status Kartu Pengawas">Ubah Status Kartu Pengawas</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="navigation-header">
                    <span>GLOBAL</span>
                    <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                        data-original-title="Global"></i>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-search"></i>
                        <span class="menu-title" data-i18n="Cek Data">Cek Data</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item {{ request()->url() == url('/badanUsaha') ? 'active' : '' }}">
                            <a href="{{ route('badanUsaha') }}">
                                <i class="fa fa-file-text"></i>
                                <span class="menu-title" data-i18n="Badan Usaha">Badan Usaha</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->url() == url('/kendaraan') ? 'active' : '' }}">
                            <a href="{{ route('kendaraan') }}">
                                <i class="fa fa-car"></i>
                                <span class="menu-title" data-i18n="Kendaraan">Kendaraan</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->url() == url('/mutasiPIC') ? 'active' : '' }} ">
                            <a href="{{ route('mutasiPIC.index') }}">
                                <i class="fa fa-random "></i>
                                <span class="menu-title" data-i18n="Mutasi PIC">Mutasi PIC</span>
                            </a>
                        </li>
                        {{--  <li class="nav-item {{ request()->url() == url('/qrcode') ? 'active' : '' }} ">
                            <a href="{{ route('qrcode.index') }}">
                                <i class="fa fa-qrcode"></i>
                                <span class="menu-title" data-i18n="QRCODE">QR CODE</span>
                            </a>
                        </li>  --}}
                    </ul>
                </li>


                <li class="navigation-header">
                    <span>Parameter</span>
                    <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                        data-original-title="Parameter"></i>
                </li>
                <li class="nav-item {{ request()->url() == url('/ttddokumen') ? 'active' : '' }}">
                    <a href="{{ route('ttddokumen.index') }}">
                        <i class="fa fa-file-text"></i>
                        <span class="menu-title" data-i18n="TTD Dokumen">TTD Dokumen</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->url() == url('/cparJenisPermohonan') ? 'active' : '' }}">
                    <a href="{{ route('cparJenisPermohonan.index') }}">
                        <i class="fa fa-file-text"></i>
                        <span class="menu-title" data-i18n="Jenis Permohonan">Jenis Permohonan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fa fa-car"></i>
                        <span class="menu-title" data-i18n="Kendaraan">Kendaraan</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item {{ request()->url() == url('/cparKendaraanMerek') ? 'active' : '' }}">
                            <a href="{{ route('cparKendaraanMerek.index') }}">
                                <i class="fa fa-file-text"></i>
                                <span class="menu-title" data-i18n="Merek">Merek</span>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->url() == url('/cparKendaraanType') ? 'active' : '' }}">
                            <a href="{{ route('cparKendaraanType.index') }}">
                                <i class="fa fa-file-text"></i>
                                <span class="menu-title" data-i18n="Type">Type</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->url() == url('/cparTrayek') ? 'active' : '' }}">
                    <a href="{{ route('cparTrayek.index') }}">
                        <i class="fa fa-road"></i>
                        <span class="menu-title" data-i18n="Trayek">Trayek</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->url() == url('/cparMengangkut') ? 'active' : '' }}">
                    <a href="{{ route('cparMengangkut.index') }}">
                        <i class="fa fa-th-large"></i>
                        <span class="menu-title" data-i18n="Mengangkut">Mengangkut</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->url() == url('/PIC') ? 'active' : '' }}">
                    <a href="{{ route('PIC.index') }}">
                        <i class="fa fa-phone"></i>
                        <span class="menu-title" data-i18n="PIC Kab/Kota">PIC Kab/Kota</span>
                    </a>
                </li>
                <li class="navigation-header">
                    <span>Managemen User</span>
                    <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                        data-original-title="Managemen User"></i>
                </li>
                <li class="nav-item {{ request()->url() == url('/dataUser') ? 'active' : '' }}">
                    <a href="{{ route('dataUser.index') }}">
                        <i class="fa fa-th-large"></i>
                        <span class="menu-title" data-i18n="Data User">Data User Pengguna</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->url() == url('/dataUserPetugas') ? 'active' : '' }}">
                    <a href="{{ route('dataUserPetugas.index') }}">
                        <i class="fa fa-th-large"></i>
                        <span class="menu-title" data-i18n="Data User">Data User Petugas</span>
                    </a>
                </li>
            @elseif (Auth::user()->level == 3)
                @if (in_array(getSttsUser(), ['2', '3', '4']))
                    <li class="nav-item  {{ URL::full() == url('/cekpassword/password') ? 'active' : '' }}">
                        <a href="{{ route('cekpassword.password') }}">
                            <i class="fa fa-info-circle"></i>
                            <span class="menu-title" data-i18n="Info Penting">Info Penting </span>
                        </a>
                    </li>
                @endif
                @if (getSttsUser() == 1)
                    <li class="nav-item">
                        <a href="#">
                            <i class="fa fa-random"></i>
                            <span class="menu-title" data-i18n="Pengajuan Permohonan"
                                style="font-size: 12px;">Pengajuan
                                Permohonan</span>
                        </a>
                        <ul class="menu-content">
                            <li
                                class="nav-item {{ request()->url() == url('/pengajuanpermohonan') ? 'active' : '' }}">
                                <a href="{{ route('pengajuanpermohonan.index') }}">
                                    <i class="fa fa-file-text-o"></i>
                                    <span class="menu-title" data-i18n="Isi Form">Isi Form</span>
                                </a>
                            </li>
                            <li
                                class="nav-item {{ URL::full() == url('/datapermohonan?act=Input') ? 'active' : '' }}">
                                <a href="{{ route('datapermohonan.index', ['act' => 'Input']) }}">
                                    <i class="fa fa-file-text-o"></i>
                                    <span class="menu-title" data-i18n="Data Permohonan">Data Permohonan</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="nav-item {{ URL::full() == url('/datapermohonan?act=Histori') ? 'active' : '' }} || {{ Request::is('datapermohonan/kartuInput*') ? 'active' : '' }}">
                        <a href="{{ route('datapermohonan.index', ['act' => 'Histori']) }}">
                            <i class="fa fa-clone"></i>
                            <span class="menu-title" data-i18n="Histori Permohonan">Histori Permohonan</span>
                        </a>
                    </li>


                    <li class="navigation-header">
                        <span>Global</span>
                        <i class="feather icon-minus" data-toggle="tooltip" data-placement="right"
                            data-original-title="Global"></i>
                    </li>
                    <li class="nav-item {{ URL::full() == url('/biodata') ? 'active' : '' }}">
                        <a href="{{ route('biodata.index') }}">
                            &nbsp; <i class="fa fa-user"></i>
                            <span class="menu-title" data-i18n="Biodata">Biodata</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ URL::full() == url('/datakendaraan') ? 'active' : '' }}">
                        <a href="{{ route('datakendaraan.index') }}">
                            <i class="fa fa-car"></i>
                            <span class="menu-title" data-i18n="Data Kendaraan">Data Kendaraan</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
