<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
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
                    <table id="myTables" class="table table-striped " style="width:100%; font-size: 11px;">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>Kab/ Kota</th>
                                <th align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-primary" id="tombolModalForm2"
                    data-url="{{ route('userdataakseskabkota.kabkota_pilih', ['id' => $id]) }}"><i
                        class="feather icon-plus-square"></i>
                    Tambah Data</a></li>
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
<div class="viewModal2" style="display:none;width:100%"></div>
<script>
    $(document).ready(function() {

        myTables = $('#myTables').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('userdataakseskabkota/show') }}",
                data: {
                    id: {{ $id }},
                }
            },
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
                    data: 'kabkota',
                    name: 'kabkota'
                },
                {
                    data: 'action',
                    name: 'action',
                }
            ]
        });

    });
</script>
