@section('content')
    <style>
        .bgg {
            background-image: url('{{ asset('images/img/bg1.jpg') }}');
        }
    </style>
    <div class="container-fluid service py-5 bgg">
        <div class="container service-section py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="mb-2 fw-bold text-white">Periksa Data Dokumen Kendaraan Anda</h4>
                <p class="mb-4 text-light">Masukkan data kendaraan Anda untuk mencari informasi KIR, Kartu Pengawas, atau
                    dokumen lainnya yang terdaftar di sistem SIPORA.</p>
            </div>

            <div class="row">
                <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
                <div class="col-md-12 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-days p-4">
                        <div class="row g-4">
                            <div class="col-12 col-xl-4">
                                <select class="form-select border-1 fs-5 py-2" aria-label="select" id="cari_field">
                                    <option selected value="">- Pilih Jenis -</option>
                                    <option value="no_kartu_pengawas">No Kartu Pengawas</option>
                                    <option value="plat_no_kendaraan" selected>No Plat Kendaraan</option>
                                    <option value="no_rangka">No Rangka</option>
                                    <option value="no_mesin">No Mesin</option>
                                </select>
                            </div>
                            <div class="col-12 col-xl-6">
                                <input type="text" class="form-control border-1 fs-5 py-2  w-100 " id="cari_data"
                                    placeholder="Ketikan Pencarian ..." value="BG 7424 AO">
                                {{--  <small class="text-danger">nn</small>  --}}
                            </div>
                            <div class="col-12 col-xl-2">
                                <button type="button" class="btn btn-primary  w-100 fs-5 py-2 " onclick="tombolProses()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="load-search"></div>

        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <script>
        function tombolProses() {
            var cari_field = $('#cari_field').val();
            var cari_data = $('#cari_data').val();


            if (cari_field == '') {
                Swal.fire('Informasi', 'Silakan di pilih Jenis !', 'warning');
            } else if (cari_data == '') {
                Swal.fire('Informasi', 'Silakan ketikan pencarian data yang dicari !', 'warning');
            } else if (!cari_data || cari_data.trim().length < 3) {
                Swal.fire('Informasi', 'Karakter minimal 3 digit !', 'warning');
                return;
            } else {

                Swal.fire({
                    title: 'Get Data...',
                    html: '<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div></div>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                myTable = $.ajax({
                    type: 'GET',
                    url: "{{ url('show_pencarian') }}",
                    data: {
                        cari_field: cari_field,
                        cari_data: cari_data,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.close();
                        $('.load-search').html(response).show();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.close();
                        // Optional: sembunyikan atau kosongkan konten modal jika error
                        $('.load-search').html('').hide();

                        // Tampilkan alert atau SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: xhr.status + ' - ' + thrownError
                        });
                    }
                });
            }
        };

        function tombolRefresh() {
            $('.load-search').empty().hide();
        }
    </script>
@endsection('content')
