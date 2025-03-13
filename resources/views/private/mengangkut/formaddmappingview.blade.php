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
                <div class="table-responsive">
                    <table id="myTable2" class="table table-striped table-bordered zero-configuration" style="width:100%">
                        <thead>
                            <tr>
                                <th width=" 1%">No</th>
                                <th>Nama Jenis Angkutan</th>
                                <th width="15%" align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-send btn btn-primary btn-glow" id="tombolModalForm2" data-url="{{ route('cparMengangkut.createMappingForm',$id_mengangkut)}}" title="Mapping Data Mengangkut">
                    <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">TAMBAH</span>
                </button>
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
<div class="viewModal2" style="display:none;"></div>
<script>
    $(document).ready(function() {
        var id_mengangkut = "{{$id_mengangkut}}";
        myTable2 = $('#myTable2').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{route('cparMengangkut.showJenisAngkutanData')}}",
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
                    data: 'jenisAngkut',
                    name: 'jenisAngkut'
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