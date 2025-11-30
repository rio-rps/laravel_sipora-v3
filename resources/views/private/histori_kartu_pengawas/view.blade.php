@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="form-group">
                    <div style="margin-bottom:-16px;">
                        <div class="card">
                            <div class="font-weight-bold text-white px-1 py-1"
                                style="background-color:#8b8d91; border-radius: 10px 10px 0px 0px; cursor: pointer;">
                                Cari Data
                            </div>

                            <div style="margin-bottom:-16px;">
                                <div class="card-content card border-secondary" style="border-radius: 0px 0px 10px 10px; ">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label>Cari Berdasarkan Kreteria</label>
                                                <select class="form-control" id="cari_field">
                                                    <option value="" selected>-- Pilih --</option>
                                                    <option value="plat_no_kendaraan">No Plat Kendaraan</option>
                                                    <option value="no_rangka">No Rangka</option>
                                                    <option value="no_mesin">No Mesin</option>
                                                    <option value="no_kartu_pengawas">No Kartu Pengawas</option>
                                                    <option value="nm_perusahaan_personal">Nama Perusahaan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Masukkan Data</label>
                                                <input type="text" id="cari_data" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>.</label><br>
                                                <button type="button" class="btn  btn-primary" onclick="tombolProses()">
                                                    <i class='bx bx-save mr-25'></i> Tampilkan
                                                </button>
                                            </div>
                                            @php
                                                //echo count($kabkota);
                                            @endphp
                                            <div class="card-body text-whitex font-weight-bold">

                                                @if (getLevel() == 1)
                                                    <span class="badge badge-pill badge-secondary">
                                                        Semua Prov/Kab/Kota
                                                    </span>
                                                @elseif (getLevel() == 2)
                                                    @if (!empty($kabkota))
                                                        @if (count($kabkota) == 18)
                                                            {{ count($kabkota) }} |
                                                            <span class="badge badge-pill badge-secondary">
                                                                Semua Prov/Kab/Kota
                                                            </span>
                                                        @else
                                                            {{ count($kabkota) }} |
                                                            @foreach ($kabkota as $kabkotaAll)
                                                                <span
                                                                    class="badge badge-pill badge-secondary">{{ $kabkotaAll->nm_kabkota }}
                                                                </span>
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        <span class="badge badge-pill badge-danger">
                                                            Tidak ditemukan
                                                        </span>
                                                    @endif
                                                @endif


                                            </div>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="card-body">
                                        <div class="viewData" style="display:none;width:100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <br>

    <script>
        function tombolProses() {
            var cari_field = $('#cari_field').val();
            var cari_data = $('#cari_data').val();


            if (cari_field == '') {
                Swal.fire('Informasi', 'Silakan di pilih Kreteria !', 'warning');
            } else if (cari_data == '') {
                Swal.fire('Informasi', 'Silakan Masukkan data yang dicari !', 'warning');
            } else {

                myTable = $.ajax({
                    type: 'GET',
                    url: "{{ url('historikartupengawas/show') }}",
                    data: {
                        cari_field: cari_field,
                        cari_data: cari_data,
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
