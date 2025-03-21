<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{$title_form}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table-striped">
                    <tr>
                        <td width="30%">Nama</td>
                        <td width="1%">:</td>
                        <td>{{ $row->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $row->email }}</td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>:</td>
                        <td>{{ level($row->level) }}</td>
                    </tr>
                    <tr>
                        <td>Lihat Biodata</td>
                        <td>:</td>
                        <td>
                            @if ($biodata->count() >0)
                            <a href=""> Cek Biodata</a>
                            @else
                            Belum Mengisi Biodata
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>