<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{$title_form}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive">
                                @foreach ($biodata as $dtBiodata )
                                <tr>
                                    <td width="30%">{{ uploadFile($dtBiodata->jenis_dok) }}</td>
                                    <td width="1%">:</td>
                                    <td>
                                        @if (isset($dtBiodata->file_dokumen))
                                        <a target="_blank" href="{{asset('upload/file_biodata/'.$dtBiodata->file_dokumen)}}">{{$dtBiodata->file_dokumen}}</a>
                                        @else
                                        <span class="text-danger">Kosong</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td>KIR</td>
                                    <td>:</td>
                                    <td>
                                        @if (isset($kendaraan->file_kir))
                                        <a target="_blank" href="{{asset('upload/file_kendaraan/'.$kendaraan->file_kir)}}">{{$kendaraan->file_kir}}</a>
                                        @else
                                        <span class="text-danger">Kosong</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>STNK</td>
                                    <td>:</td>
                                    <td>
                                        @if (isset($kendaraan->file_stnk))
                                        <a target="_blank" href="{{asset('upload/file_kendaraan/'.$kendaraan->file_stnk)}}">{{$kendaraan->file_stnk}}</a>
                                        @else
                                        <span class="text-danger">Kosong</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>

        </div>
    </div>
</div>