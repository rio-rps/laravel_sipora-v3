<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="getModalFormLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="getModalFormLabel"><b>{{ $title_form }}</b></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('biodata.store') }}" class="formData" method="POST">
                @csrf
                <input type="hidden" name="id_user" value="{{ $id_user }}">

                <div class="modal-body">

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Badan Usaha</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                </div>
                                <select name="id_badan_usaha" class="form-control">
                                    <option value="" selected>-- Pilih --</option>
                                    @foreach ($resultBadanUsaha as $resultBadanUsahax)
                                        <option value="{{ $resultBadanUsahax->id_badan_usaha }}"
                                            {{ $badanUsaha == $resultBadanUsahax->id_badan_usaha ? 'selected' : '' }}>
                                            {{ $resultBadanUsahax->nm_badan_usaha }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Nama Perusahaan / Personal</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="nm_perusahaan_personal" class="form-control"
                                    value="{{ $row->nm_perusahaan_personal ?? '' }}" maxlength="100"
                                    placeholder="Contoh: PT. Maju Bersama">

                            </div>
                            <small class="text-danger">Tuliskan kembali PT/CV, Contoh: PT. Maju Bersama</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Nama Pimpinan / Pemilik</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="nm_pimpinan_pemilik" class="form-control"
                                    value="{{ $row->nm_pimpinan_pemilik ?? '' }}" maxlength="100"
                                    placeholder="Contoh: Budi Santoso">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Email kantor/ Perusahaan</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="text" name="email" class="form-control"
                                    value="{{ $row->email ?? '' }}" maxlength="255" placeholder="Email Perusahaan">
                            </div>
                            <small class="text-danger">Contoh: xyz@gmail.com</small>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">Alamat</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                                </div>
                                <textarea name="alamat_biodata" class="form-control" rows="2" placeholder="Alamat lengkap">{{ $row->alamat_biodata ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label font-weight-bold">No. HP</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="no_telp" class="form-control" maxlength="12"
                                    value="{{ $row->no_telp ?? '' }}" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> TUTUP
                    </button>
                    <div>
                        <button type="reset" class="btn btn-secondary mr-1">
                            <i class="fa fa-undo mr-1"></i> RESET
                        </button>
                        <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                            <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">SIMPAN</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('private/js/myscriptpost.js') }}"></script>
