<center>
    <div class="pull-right actionDiSetujui">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

            @if (getLevel() == 1 or getLevel() == 2)
                @if ($rows->status_permohonan != 5)
                    <a class="dropdown-item btn-sm btn-success" href="#" id="tombolModalForm"
                        data-url="{{ route('datapermohonan.getModal_kartuInputValidasi', $rows->id_permohonan_izin) }}"
                        title="Validasi"><i class="fa fa-check"></i></a>
                @endif
            @endif

            <div class="btn-group" role="group">
                <button id="btnGroupDrop2" type="button" class="btn btn-sm btn-outline-info dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Aksi
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start"
                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 41px, 0px);">
                    @if (getLevel() == 1 or getLevel() == 2)

                        @if ($rows->status_permohonan != 5)
                            <a class="dropdown-item " href="#" id="tombolModalForm"
                                data-url="{{ route('datapermohonan.getModal_kartuInput', $rows->id_permohonan_izin) }}"
                                title="Input Data"><i class="fa fa-edit"></i> Input Data</a>
                        @endif

                        @if ($rows->status_permohonan == 4 and $rows->status_permohonan != 5)
                            <form method="POST"
                                action="{{ route('datapermohonan.destroyBatalProses', $rows->id_permohonan_izin) }}"
                                class="dropdown-item formDelete" style="cursor: context-menu;">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> <i
                                    class="fa fa-window-close"></i> Batal Proses
                            </form>
                        @endif

                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" title="Dokumen Upload" id="tombolModalForm"
                        data-url="{{ route('datapermohonan.dokumenUpload', $rows->id_permohonan_izin) }}"><i
                            class="fa fa-desktop"></i> Dokumen Upload</a>
                    <!-- <a class="dropdown-item" href="#" data-url="" title="Cetak Kartu"><i class="fa fa-print"></i> Cetak Permohonan</a> -->
                    <a class="dropdown-item" target="_blank"
                        href="{{ route('laporan.cetakKartuPengawas', Crypt::encrypt($rows->id_permohonan_izin)) }}"
                        title="Cetak Surat Kartu Pengawas"><i class="fa fa-print"></i> Cetak Surat Kartu Pengawas</a>
                    <a class="dropdown-item" target="_blank"
                        href="{{ route('laporan.cetakKartuPengawasElektronik', Crypt::encrypt($rows->id_permohonan_izin)) }}"
                        title="Cetak Kartu Pengawas Elektronik"><i class="fa fa-print"></i> Cetak Kartu Pengawas
                        Elektronik</a>
                    <a class="dropdown-item" target="_blank"
                        href="{{ route('laporan.cetakQRcode', Crypt::encrypt($rows->id_permohonan_izin)) }}"
                        title="Cetak Qrcode"><i class="fa fa-qrcode"></i> Cetak Qrcode</a>

                </div>
            </div>
        </div>
    </div>
</center>
