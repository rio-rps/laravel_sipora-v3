<center>
    <div class="btn-icon-list btn-list">

        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop2" type="button" class="btn btn-sm btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Aksi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start">
                        <!-- <a class="dropdown-item" target="_blank" href="{{route('laporan.cetakpengajuanpermohonan',$model->id_permohonan_izin)}}"><i class="fa fa-print"></i> Cetak Permohonan</a> -->


                        @if (getLevel() ==1|| getLevel() ==2 )
                        @if ($model->status_permohonan==2)
                        <form method="POST" action="{{ route('datapermohonan.validasiPermohonan', $model->id_permohonan_izin ) }}" class="dropdown-item formPilih" style="cursor: context-menu;">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> <i class="fa fa-check"></i> Validasi
                        </form>

                        <a class="dropdown-item" title="Ditolak" id="tombolModalForm" data-url="{{ route('datapermohonan.createTolak',$model->id_permohonan_izin)}}"><i class="fa fa-close"></i> Tolak</a>
                        @endif
                        @endif
                        @if ($model->status_permohonan==4)
                        <a class="dropdown-item" title="{{(getLevel()==3)?'Lihat Detail Data':'Proses Data'}}" href="{{ route('datapermohonan.kartuInput',Crypt::encrypt($model->id_permohonan_izin))  }}">{!!(getLevel()==3)?'<i class="fa fa-desktop"></i> Lihat Detail Data':'<i class="fa fa-edit"></i> Proses Data'!!}</a>
                        @endif
                        <a class="dropdown-item" title="Dokumen Upload" id="tombolModalForm" data-url="{{ route('datapermohonan.dokumenUpload',$model->id_permohonan_izin)}}"><i class="fa fa-desktop"></i> Dokumen Upload</a>
                        @if ($model->status_permohonan==5)
                        <a class="dropdown-item" title="Lihit Detail Data" href="{{ route('datapermohonan.kartuInput',Crypt::encrypt($model->id_permohonan_izin))}}"><i class="fa fa-desktop"></i> Lihat Detail Data</a>
                        @endif
                        <!-- @if ($model->status_permohonan==5)
                        <a class="dropdown-item" title="Lihat Permohonan" id="tombolModalForm" data-url="{{ route('datapermohonan.detailView',$model->id_permohonan_izin)}}"><i class="fa fa-eye"></i> Lihat Kartu Pengawas</a>
                        @endif -->
                        <a class="dropdown-item" title="Lihat Permohonan" id="tombolModalForm" data-url="{{ route('datapermohonan.detailView',$model->id_permohonan_izin)}}"><i class="fa fa-eye"></i> Lihat Permohonan</a>
                        @if ($model->status_permohonan==3)
                        <a class="dropdown-item" title="Informasi ditolak" id="tombolModalForm" data-url="{{ route('datapermohonan.getModalHistoriData',$model->id_permohonan_izin)}}"><i class="fa fa-comment"></i> Informasi ditolak</a>
                        @endif

                        @if ($model->status_permohonan==1 || $model->status_permohonan==2)
                        <form method="POST" action="{{ route('datapermohonan.destroy', $model->id_permohonan_izin ) }}" class="dropdown-item formDelete" style="cursor: context-menu;">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> <i class="fa fa-trash"></i> Hapus Data
                        </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</center>