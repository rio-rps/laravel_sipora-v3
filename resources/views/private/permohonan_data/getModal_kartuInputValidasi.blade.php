<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{$title_form}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('datapermohonan.validasiSelesai', $rows->id_permohonan_izin) }}" class="formData" style="cursor: context-menu;">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label  border-bottom">Tanggal Validasi</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="tgl_validasi_selesai">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                        <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">VALIDASI</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('private/js/myscriptpost.js')}}"></script>