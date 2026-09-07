<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('datapermohonan.validasiSelesai', $rows->id_permohonan_izin) }}"
                class="formData" style="cursor: context-menu;">

                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal Validasi</label>
                        <div class="input-group date" id="datepicker1">
                            <input type="text" class="form-control border-1 shadow-xs bg-white" autocomplete="off"
                                readonly style="cursor: pointer;" name="tgl_validasi_selesai">
                            <span class="input-group-append input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
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
<script>
    $(function() {
        $('#datepicker1').datepicker({
            format: 'dd-mm-yyyy',
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
            todayHighlight: true,
            container: 'body',
            language: 'id'
        });
    });
</script>

<script <script src="{{ asset('private/js/myscriptpost.js') }}"></script>
