<table class="table table-responsive">
    <tr>
        <td width="30%">KIR</td>
        <td width="1%">:</td>
        <td>
            @if (isset($row->file_kir))
            <a target="_blank" href="{{asset('upload/file_kendaraan/'.$row->file_kir)}}">{{$row->file_kir}}</a>
            @else
            <span class="text-danger">Kosong</span>
            @endif
        </td>
        <td align="right">
            <center>
                <div class="btn-icon-list btn-list">
                    @if (isset($row->file_kir))
                    <form method="POST" action="{{ route('datakendaraan.destroyUploadKir', $row->id_kendaraan) }}" class="formDelete" style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    @else
                    <button class="btn btn-success btn-sm" id="tombolModalForm2" data-url="{{ route('datakendaraan.createUploadForm',['id_kendaraan'=>$row->id_kendaraan,'jenis_dok'=>'5'])}}" title="Upload KIR"><i class="fa fa-upload"></i></button>
                    @endif
                </div>
            </center>
        </td>
    </tr>

    <tr>
        <td width="30%">STNK</td>
        <td width="1%">:</td>
        <td>
            @if (isset($row->file_stnk))
            <a target="_blank" href="{{asset('upload/file_kendaraan/'.$row->file_stnk)}}">{{$row->file_stnk}}</a>
            @else
            <span class="text-danger">Kosong</span>
            @endif
        </td>
        <td align="right">
            <center>
                <div class="btn-icon-list btn-list">
                    @if (isset($row->file_stnk))
                    <form method="POST" action="{{ route('datakendaraan.destroyUploadSTNK', $row->id_kendaraan) }}" class="formDelete" style="display: inline">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    @else
                    <button class="btn btn-success btn-sm" id="tombolModalForm2" data-url="{{ route('datakendaraan.createUploadForm',['id_kendaraan'=>$row->id_kendaraan,'jenis_dok'=>'6'])}}" title="Upload STNK"><i class="fa fa-upload"></i></button>
                    @endif
                </div>
            </center>
        </td>
    </tr>
</table>