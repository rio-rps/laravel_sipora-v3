<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        style="width:100%;font-size:11px;">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Nama Kendaraan</th>
                                <th> No. Plat Kendaraan</th>
                                <th>No. Ranngka</th>
                                <th>No. Mesin</th>
                                <th width="1%" align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
    $(document).ready(function() {
        var id_biodata = "{{ $id_biodata }}";
        myTable = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('pengajuanpermohonan/show') }}",
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
                    data: 'merekType',
                    name: 'merekType'
                },
                {
                    data: 'plat_no_kendaraan',
                    name: 'plat_no_kendaraan'
                },
                {
                    data: 'no_rangka',
                    name: 'no_rangka'
                },
                {
                    data: 'no_mesin',
                    name: 'no_mesin'
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
