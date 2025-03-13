<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('biodata.store') }}" class="formData" method="POST">
                @csrf
                <input type="hidden" class="form-control" name="id_user" value="{{ $id_user }}">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">Badan Usaha</label>
                            <div class="col-md-8">
                                <select name="id_badan_usaha" class="form-control">
                                    <option value="" selected>--Pilih--</option>
                                    @foreach ($resultBadanUsaha as $resultBadanUsahax)
                                        <option value="{{ $resultBadanUsahax->id_badan_usaha }}"
                                            {{ $badanUsaha == $resultBadanUsahax->id_badan_usaha ? 'selected' : '' }}>
                                            {{ $resultBadanUsahax->nm_badan_usaha }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">Nama Perusahaan / Personal</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nm_perusahaan_personal"
                                    value="{{ $row->nm_perusahaan_personal ?? '' }}" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">Nama Pimpinan / Pemilik</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nm_pimpinan_pemilik"
                                    value="{{ $row->nm_pimpinan_pemilik ?? '' }}" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">Alamat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="alamat_biodata"
                                    value="{{ $row->alamat_biodata ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">No Hp</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="no_telp" maxlength="12"
                                    value="{{ $row->no_telp ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary"
                            data-dismiss="modal">TUTUP</button>
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
