<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{$title_form}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('datapermohonan.storeTolakPermohonan',$id) }}" class="formData" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-form-label border-bottom">Isi Kenapa di tolak ?</label>
                            <div class="col-md-12">
                                <textarea name="keterangan_histori" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
                        <button type="reset" class="btn btn-secondary">
                            <i class='feather icon-x mr-25'></i>
                            <span class="d-sm-inline">RESET</span>
                        </button>
                        <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                            <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">TOLAK</span>
                        </button>
                    </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('private/js/myscriptpost.js')}}"></script>