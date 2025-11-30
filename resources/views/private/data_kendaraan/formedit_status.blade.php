<link rel="stylesheet" type="text/css" href="{{ asset('add-plugins/select2/css/select2.min.css') }}">
<script src="{{ asset('add-plugins/autoNumeric.js') }}"></script>
<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('datakendaraan.update_status', $id) }}" class="formData" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-secondary">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label border-bottom">
                                                Ubah Satus</label>
                                            <div class="col-md-7">
                                                <select name="status_actived" class="form-control select2">
                                                    <option value="" selected>-- Pilih --</option>
                                                    <option value="1">AKTIF</option>
                                                    <option value="2">NON AKTIF</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
