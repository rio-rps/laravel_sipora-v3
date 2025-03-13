@if ($row != 'kosong')
    <table class="table table-responsive">
        <tr>
            <td width="30%">NIB</td>
            <td width="1%">:</td>
            <td>
                @if (isset($row->file_dokumen))
                    <a target="_blank"
                        href="{{ asset('upload/file_biodata/' . $row->file_dokumen) }}">{{ $row->file_dokumen }}</a>
                @else
                    <span class="text-danger">Kosong</span>
                @endif
            </td>
            <td align="right">
                <center>
                    <div class="btn-icon-list btn-list">
                        @if (isset($row->file_dokumen))
                            <form method="POST" action="{{ route('upload.destroy', $row->id_upload_dok ?? '') }}"
                                class="formDelete" style="display: inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @else
                            <button class="btn btn-success btn-sm" id="tombolModalForm"
                                data-url="{{ route('upload.createUpload', ['id_biodata' => $biodata->id_biodata, 'jenis_dok' => '1']) }}"
                                title="Upload NIB"><i class="fa fa-upload"></i></button>
                        @endif
                    </div>
                </center>
            </td>
        </tr>
        <tr>
            <td>KTP</td>
            <td>:</td>
            <td>
                @if (isset($row2->file_dokumen))
                    <a target="_blank"
                        href="{{ asset('upload/file_biodata/' . $row2->file_dokumen) }}">{{ $row2->file_dokumen }}</a>
                @else
                    <span class="text-danger">Kosong</span>
                @endif
            </td>
            <td align="right">
                <center>
                    <div class="btn-icon-list btn-list">
                        @if (isset($row2->file_dokumen))
                            <form method="POST" action="{{ route('upload.destroy', $row2->id_upload_dok ?? '') }}"
                                class="formDelete" style="display: inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @else
                            <button class="btn btn-success btn-sm" id="tombolModalForm"
                                data-url="{{ route('upload.createUpload', ['id_biodata' => $biodata->id_biodata, 'jenis_dok' => '2']) }}"
                                title="Upload KTP"><i class="fa fa-upload"></i></button>
                        @endif
                    </div>
                </center>
            </td>
        </tr>
        <tr>
            <td>AKTE PENDIRIAN</td>
            <td>:</td>
            <td>
                @if (isset($row3->file_dokumen))
                    <a target="_blank"
                        href="{{ asset('upload/file_biodata/' . $row3->file_dokumen) }}">{{ $row3->file_dokumen }}</a>
                @else
                    <span class="text-danger">Kosong</span>
                @endif
            </td>
            <td align="right">
                <center>
                    <div class="btn-icon-list btn-list">
                        @if (isset($row3->file_dokumen))
                            <form method="POST" action="{{ route('upload.destroy', $row3->id_upload_dok ?? '') }}"
                                class="formDelete" style="display: inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @else
                            <button class="btn btn-success btn-sm" id="tombolModalForm"
                                data-url="{{ route('upload.createUpload', ['id_biodata' => $biodata->id_biodata, 'jenis_dok' => '3']) }}"
                                title="Upload Akte Pendirian"><i class="fa fa-upload"></i></button>
                        @endif
                    </div>
                </center>
            </td>
        </tr>
        <tr>
            <td>NPWP</td>
            <td>:</td>
            <td>
                @if (isset($row4->file_dokumen))
                    <a target="_blank"
                        href="{{ asset('upload/file_biodata/' . $row4->file_dokumen) }}">{{ $row4->file_dokumen }}</a>
                @else
                    <span class="text-danger">Kosong</span>
                @endif
            </td>
            <td align="right">
                <center>
                    <div class="btn-icon-list btn-list">
                        @if (isset($row4->file_dokumen))
                            <form method="POST" action="{{ route('upload.destroy', $row4->id_upload_dok ?? '') }}"
                                class="formDelete" style="display: inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        @else
                            <button class="btn btn-success btn-sm" id="tombolModalForm"
                                data-url="{{ route('upload.createUpload', ['id_biodata' => $biodata->id_biodata, 'jenis_dok' => '4']) }}"
                                title="Upload NPWP"><i class="fa fa-upload"></i></button>
                        @endif
                    </div>
                </center>
            </td>
        </tr>
    </table>
@else
    <div class="card-body">
        <div class="alert alert-danger" role="alert">
            Data Kosong, Silakan Edit Biodata !
        </div>
    </div>
@endif
