<div class="modal fade text-left" id="getModalForm2" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel1">PILIH DATA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="myTableDataModal" class="table table-striped  " style="width:100%">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Nama Jenis Angkutan</th>
                                <th width="10%" align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var id_mengangkut = "{{$id_mengangkut}}";
        myTableDataModal = $('#myTableDataModal').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('cparMengangkut.showJenisAngkutan')}}",
                data: {
                    id_mengangkut: id_mengangkut
                },
            },


            // "data": null,
            // "class": "align-top",
            // "orderable": false,
            // "searchable": false,
            columns: [{
                    // "class": "align-top",
                    "orderable": false,
                    "searchable": false,
                    "data": "no",
                    className: 'text-center',
                    "render": function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'nm_jenis_angkutan',
                    name: 'nm_jenis_angkutan'
                },
                {
                    className: 'text-center',
                    data: 'action',
                    name: 'action',
                }
            ]
        });
    });
</script>