<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($action == 0)
                <form action="{{ route('upload.storeUpload') }}" class="formDataMultipart" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="id_biodata" value="{{ $id }}">
                @else
                    <form action="{{ route('upload.updateUpload', $id) }}" class="formDataMultipart" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @endif


            @csrf
            <input type="hidden" class="form-control" name="jenis_dok" value="{{ $jenis_dok }}">
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label border-bottom">File Dokumen </label>
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="file_dokumen"
                            accept=".pdf,.doc,.docx,.xlsx,.pptx">
                        <span class="badge badge-danger pull-right">pdf | max:500kb</span>
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
                    <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">SIMPAN</span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('private/js/myscriptpost.js') }}"></script>
