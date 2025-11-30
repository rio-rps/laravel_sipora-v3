<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary   text-white">
                <h4 class="modal-title" id="myModalLabel5"><b>
                        <i class="fa a fa-download"></i> {{ $title_form }}</b></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Kartu Dokumen Perusahaan -->
                            <div class="card border">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">📄 Dokumen Perusahaan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless table-sm mb-0">
                                        <tr>
                                            <th width="35%">NIB</th>
                                            <td width="1%">:</td>
                                            <td>
                                                @if (isset($dok1->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok1->file_dokumen) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>KTP</th>
                                            <td>:</td>
                                            <td>
                                                @if (isset($dok2->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok2->file_dokumen) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>AKTE PENDIRIAN</th>
                                            <td>:</td>
                                            <td>
                                                @if (isset($dok3->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok3->file_dokumen) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>NPWP</th>
                                            <td>:</td>
                                            <td>
                                                @if (isset($dok4->file_dokumen))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_biodata/' . $dok4->file_dokumen) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <!-- Dokumen Kendaraan -->
                            <div class="card mt-3 border">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0"><i class="fa fa-car"></i> Dokumen Kendaraan</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless table-sm mb-0">
                                        <tr>
                                            <th width="35%">KIR</th>
                                            <td width="1%">:</td>
                                            <td>
                                                @if (isset($kendaraan->file_kir))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_kendaraan/' . $kendaraan->file_kir) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>STNK</th>
                                            <td>:</td>
                                            <td>
                                                @if (isset($kendaraan->file_stnk))
                                                    <a target="_blank"
                                                        href="{{ asset('upload/copy_file_permohonan/file_kendaraan/' . $kendaraan->file_stnk) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="badge bg-danger">Kosong</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>

        </div>
    </div>
</div>
