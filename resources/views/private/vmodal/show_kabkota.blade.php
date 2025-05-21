<div class="modal fade" id="getModalForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{ $title_form }}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Nama Kab/ Kota</th>
                                <th width="10%" align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @if ($act == 'lap_permohonan')
                                @php
                                    $no = 1;
                                @endphp
                                <tr>
                                    <td align="center">{{ $no }}</td>
                                    <td>SEMUA</td>
                                    <td>
                                        <center>
                                            <div class="btn-icon-list btn-list">
                                                <a class="btn btn-sm btn-primary" href="#"
                                                    onclick="pilih('{{ $act }}','SEMUA','SEMUA')"
                                                    title="Pilih Kab/ Kota">Pilih
                                                </a>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endif
                            @foreach ($result as $dkabkota)
                                <tr>
                                    <td align="center">{{ $loop->iteration + $no }}</td>
                                    <td>{{ $dkabkota->nm_kabkota }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-icon-list btn-list">
                                                <a class="btn btn-sm btn-primary" href="#"
                                                    onclick="pilih('{{ $act }}',{{ $dkabkota->id_kabkota }},'{{ $dkabkota->nm_kabkota }}')"
                                                    title="Pilih Kab/ Kota">Pilih
                                                </a>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function pilih(act, id, nama) {
        if (act == 'lap_permohonan') {
            $('#getModalForm2').modal('hide');
            $('.kabkota-name').html(nama);
            $('#id_kabkota').val(id);
        }
    }
</script>
