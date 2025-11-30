<div class="modal fade " id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header bg-secondary text-white">
                <h4 class="modal-title " id="myModalLabel5">
                    <b><i class="fa fa-university"></i> {{ $title_form }}</b>
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">


                <div class="form-group">
                    <div class="bs-callout-default callout-border-left callout-bordered mt-1 p-1">
                        <h4 class="primary">Informasi !</h4>
                        <p>
                            Daftar PIC adalah orang yang bertugas memeriksa dan memastikan kebenaran data permohonan
                            untuk di verifikasi, apabila ada kesalahan mengirim data silakan hubungi PIC.
                        </p>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered zero-configuration"
                        style="width:100%">
                        <thead>
                            <th width="1%">No</th>
                            <th>Nama Kab/ Kota</th>
                            <th>No Telpon 1</th>
                            <th>No Telpon 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $resultPIC)
                                <tr>
                                    <td align="center" width="1%">{{ $loop->iteration }}</td>
                                    <td>{{ $resultPIC->nm_kabkota }}</td>
                                    <td>{{ $resultPIC->no_tlp1 }}</td>
                                    <td>{{ $resultPIC->no_tlp2 }}</td>
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
