<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h4 class="modal-title" id="myModalLabel5"><b><i class="fa fa-edit"></i> {{ $title }}</b>
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($row)
                <form action="{{ route('PIC.update', $row->id_pic) }}" class="formData" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('PIC.store') }}" class="formData" method="POST">
                        @csrf
            @endif
            <input type="hidden" name="kode_provinsi" value="{{ $kabkota->kode_provinsi }}">
            <input type="hidden" name="kode_kabkota" value="{{ $kabkota->kode_kabkota }}">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <span class="card-title font-weight-bold">{{ $kabkota->nm_kabkota }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">TELEPON 1</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="no_tlp1" maxlength="13"
                                    value="{{ $row ? $row->no_tlp1 : '0' }}"
                                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label border-bottom">TELEPON 2</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" name="no_tlp2" maxlength="13"
                                    value="{{ $row ? $row->no_tlp2 : '0' }}"
                                    oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span class="text-left"></span>
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                    <i class="fa fa-times mr-1"></i> TUTUP
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="fa fa-undo mr-25"></i>
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
