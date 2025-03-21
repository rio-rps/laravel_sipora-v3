<div class="modal fade" id="getModalForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                            @foreach ($result as $dkabkota)
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $dkabkota->nm_kabkota }}</td>
                                    <td>
                                        <center>
                                            <div class="btn-icon-list btn-list">
                                                <a class="btn btn-sm btn-primary" href="#"
                                                    onclick="pilih({{ $id }},{{ $dkabkota->id_kabkota }})"
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
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
<script>
    function pilih(id, id_kabkota) {
        var id = id;
        $.ajax({
            type: "POST",
            url: "{{ route('userdataakseskabkota.store') }}",
            data: {
                id: id,
                id_kabkota: id_kabkota,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loading-spinner').removeClass('d-none');
            },
            complete: function() {
                $('#loading-spinner').addClass('d-none');
            },
            success: function(response) {
                if (response.success) {

                    Swal.fire('Berhasil', response.success, 'success').then((result) => {
                        $('#getModalForm2').modal('hide');
                        myTables.ajax.reload();
                        myTable.ajax.reload();
                    })
                } else if (response.error) {
                    Swal.fire('Gagal', response.error, 'error')
                }
            },
            error: function(xhr, ajaxOptons, throwError) {
                if (xhr.status == 423) {
                    var errors = xhr.responseJSON.errors;
                    var errorList = '';
                    Swal.fire('Gagal', errors, 'warning');
                }
            }
        });
    }
</script>
