@extends('private.layout.main')
@section('isi')
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12  mb-2 ">
            <div class="list-group">
                <a
                    class="list-group-item list-group-item-action flex-column align-items-start active text-white-600 text-white">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="text-white-600 text-white">Mutasi PIC</h5>
                    </div>
                    <small>
                        Perubahan/ Mutasi PIC bisa dilakukan pada halaman ini, sertakan data pendukung /melampirkan dokumen
                        lainnya seperti STNK atau BPKB kendaraan. </small>
                    <br>
                    <small>Mutasi data kendaraan akan
                        mempengaruh data permohonan KIR yang telah dikirim/diproses/selesai sehingga sebelum dimutasi PIC
                        harus
                        diteliti.
                    </small>
                </a>
                <a class="list-group-item  flex-column align-items-start  ">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="basic-url">Status Permohonan</label>
                                <select class="custom-select" id="status_permohonan">
                                    <option selected value="">Pilih</option>
                                    <option value="2">Masuk</option>
                                    <option value="4">Proses</option>
                                    <option value="5">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cari_field">Cari Berdasarkan Kriteria</label>
                                <select class="form-control" id="cari_field" name="cari_field">
                                    <option value="" selected>-- Pilih --</option>
                                    <option value="plat_no_kendaraan">No Plat Kendaraan</option>
                                    <option value="no_rangka">No Rangka</option>
                                    <option value="no_mesin">No Mesin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group"><label for="cari_data">Masukkan Data</label><input type="text"
                                    id="cari_data" name="cari_data" class="form-control"
                                    placeholder="Ketik data sesuai kriteria..."></div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-group"><button type="button" class="btn btn-primary btn-block"
                                    onclick="tombolProses()"><i class="fa fa-search mr-1"></i>Cari </button></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div id="info">
                <div class="list-group"><a class="list-group-item flex-column align-items-start">Silakan isi data
                        diatas... </a></div>
            </div>
            <div class="viewData" style="display:none;width:100%"></div>
        </div>
    </div>
    <div class="viewModal" style="display:none;width:100%"></div>
    <div class="viewModal2" style="display:none;width:100%"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            myTable = $('#myTable').DataTable()
        });

        function tombolProses() {
            var cari_status_permohonan = $('#status_permohonan').val();
            var cari_field = $('#cari_field').val();
            var cari_data = $('#cari_data').val();

            if (cari_status_permohonan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Status Permohonan !', 'warning');
            } else if (cari_field == '') {
                Swal.fire('Informasi', 'Silakan di pilih Kreteria !', 'warning');
            } else if (cari_data == '') {
                Swal.fire('Informasi', 'Silakan Masukkan data yang dicari !', 'warning');
            } else if (!cari_data || cari_data.trim().length < 3) {
                Swal.fire('Informasi', 'Karakter minimal 3 digit !', 'warning');
                return;
            } else {

                $.ajax({
                    type: 'GET',
                    url: "{{ url('mutasiPIC/show') }}",
                    data: {
                        cari_status_permohonan: cari_status_permohonan,
                        cari_field: cari_field,
                        cari_data: cari_data
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        // $('#loading-spinner').removeClass('d-none');
                        Swal.fire({
                            title: 'Mengambil Data...',
                            text: 'Mohon tunggu sebentar.',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    complete: function() {
                        //$('#loading-spinner').addClass('d-none');
                        $('#info').addClass('d-none');
                        Swal.close();

                    },
                    success: function(response) {
                        $('.viewData').html(response).show();
                    },
                    error: function(xhr, ajaxOptons, throwError) {
                        alert(xhr.status + '\n' + throwError);
                    }
                });
            }
        };
    </script>
@endsection
