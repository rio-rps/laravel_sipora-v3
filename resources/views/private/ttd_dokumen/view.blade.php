@extends('private.layout.main')
@section('isi')


<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><b>{{ $title }}</b></h4>
        </div>
        <hr>
        <div class="col-md-12">
            <form action="{{ route('ttddokumen.update',$row->id_ttd_dok) }}" class="formData" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label border-bottom">Nama</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nm_ttd" value="{{$row->nm_ttd}}" maxlength="225">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label border-bottom">Pangkat Gol</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="pangkat_gol" value="{{$row->pangkat_gol}}" maxlength="225">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label border-bottom">NIP</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nip_ttd" value="{{$row->nip_ttd}}" maxlength="21">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label border-bottom">Jabatan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="jabatan_ttd" value="{{$row->jabatan_ttd}}" maxlength="225">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <button type="reset" class="btn btn-secondary">
                                <i class='feather icon-x mr-25'></i>
                                <span class="d-sm-inline">RESET</span>
                            </button>
                            <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                                <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">SIMPAN</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection