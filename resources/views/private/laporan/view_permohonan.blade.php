@extends('private.layout.main')
@section('isi')
    <style>
        .kabkota-container {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .kabkota-image {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .kabkota-details {
            flex-grow: 1;
            /* Membuat elemen ini mengambil ruang yang tersedia */
        }

        .kabkota-name {
            font-size: 16px;
            font-weight: bold;
        }
    </style>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="form-group">
                    <div id="accordionWrap1" role="tablist" aria-multiselectable="true" style="margin-bottom:-16px;">
                        <div class="card accordion collapse-icon accordion-icon-rotate">
                            <div id="heading11" class="  collapsed font-weight-bold text-white px-1 py-1"
                                data-toggle="collapse" href="#accordion11" aria-expanded="false" aria-controls="accordion11"
                                style="background-color:#8b8d91; border-radius: 10px 10px 0px 0px; cursor: pointer;">
                                Pengaturan Kertas PDF
                            </div>

                            <div id="accordion11" role="tabpanel" data-parent="#accordionWrap1" aria-labelledby="heading11"
                                class="collapse" style="margin-bottom:-16px;">
                                <div class="card-content card border-secondary" style="border-radius: 0px 0px 10px 10px; ">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label>Ukuran Font</label>
                                                <input type="number" class="form-control" id="font_size" value="12"
                                                    min="1">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Font</label>
                                                <select class="form-control" name="font_family" id="font_family">
                                                    <option value="Inter, Sans-Serif" selected>Inter, Sans-Serif</option>
                                                    <option value="Arial">Arial</option>
                                                    <option value="Times New Roman">Times New Roman</option>
                                                    <option value="Calibri">Calibri</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group btn-group-sm " role="group" aria-label="Basic example">
                        <button onclick="openPrintFromURL()" class="btn btn-outline-success mr-1">
                            <i class="fa fa-file-pdf-o"></i> CETAK DOKUMEN PDF
                        </button>
                        <button type="button" onclick="downloadExcel()" class="btn btn-outline-primary">
                            <i class="fa fa-file-excel-o"></i> EXCEL
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-content card border-teal border-lighten-2 ">
                    <div class="card-body ">

                        <div class="row">
                            <div class="col-md-3">
                                <label for="basic-url">Jenis Permohonan</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="id_jenis_permohonan">
                                        <option selected value="">Pilih</option>
                                        <option value="All">Semua Permohonan</option>
                                        @foreach ($resultPermohonan as $resultPermohonanAll)
                                            <option value="{{ $resultPermohonanAll->id_jenis_permohonan }}">
                                                {{ $resultPermohonanAll->nm_jenis_permohonan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="basic-url">Status Permohonan</label>
                                <div class="input-group mb-3">
                                    <select class="custom-select" id="status_permohonan">
                                        <option selected value="">Pilih</option>
                                        <option value="2">Masuk</option>
                                        <option value="4">Proses</option>
                                        <option value="5">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="kabkota-container">
                            <img src ="{{ asset('images/img/instansi.webp') }}" alt="Logo kabkota" class ="kabkota-image">
                            <div class="kabkota-details">
                                <div class="kabkota-name"> Nama Kab/Kota</div>
                                <input type="hidden" id="id_kabkota">
                            </div>
                            <button class="btn btn-sm btn-secondary" id="tombolModalForm2"
                                data-url="{{ route('vmodal.show_kabkota', ['act' => 'lap_permohonan']) }}"> <i
                                    class="fa fa-search"></i>
                                Pilih KAB/KOTA </button>
                        </div>
                        <div class="form-group mt-3">
                            <label for="basic-url">Periode Permohonan</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="datesFilter" id="datesFilter"
                                    data-date-format='yyyy-mm-dd' />
                            </div>
                        </div>


                        <div>
                            <button type="button" class="btn  btn-primary" id="tombolProses" onclick="tombolProses()">
                                <i class='bx bx-save mr-25'></i> Tampilkan
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-content card border-teal border-lighten-2">
                    <div class="card-body ">
                        <div class="views" style="display:none;width:100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="viewModal2" style="display:none;width:100%"></div>



    <input type="hidden" id="id_jenis_permohonanV">
    <input type="hidden" id="status_permohonanV">
    <input type="hidden" id="id_kabkotaV">
    <input type="hidden" id="datesFilterV">
    <script>
        const today = moment();
        const startOfYear = moment().startOf('year');

        $('input[name="datesFilter"]').daterangepicker({
            startDate: startOfYear, // tanggal awal = 1 Januari
            endDate: today, // tanggal akhir = hari ini
            locale: {
                format: 'YYYY-MM-DD', // Format tampilannya
                applyLabel: "Apply",
                cancelLabel: "Cancel",
            }
        });




        // Saat ukuran font berubah
        $('#font_size').on('input', function() {
            var fontSize = $(this).val();
            $('.views .font-custom').css('font-size', fontSize + 'px');
        });

        // Saat font family berubah
        $('#font_family').on('change', function() {
            var fontFamily = $(this).val();
            $('.views .font-custom').css('font-family', fontFamily);
        });


        function tombolProses() {
            var id_jenis_permohonan = $('#id_jenis_permohonan').val();
            var status_permohonan = $('#status_permohonan').val();
            var id_kabkota = $('#id_kabkota').val();
            var datesFilter = $('#datesFilter').val();


            if (id_jenis_permohonan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Jenis Permohonan !', 'warning');
            } else if (status_permohonan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Status Permohonan !', 'warning');
            } else if (id_kabkota == '') {
                Swal.fire('Informasi', 'Silakan di pilih Kab/Kota !', 'warning');
            } else if (datesFilter == '') {
                Swal.fire('Informasi', 'Silakan di pilih Tanggal Filter !', 'warning');
            } else {

                myTable = $.ajax({
                    type: 'GET',
                    url: "{{ url('laporan/getLapPermohonan') }}",
                    data: {
                        id_jenis_permohonan: id_jenis_permohonan,
                        status_permohonan: status_permohonan,
                        id_kabkota: id_kabkota,
                        datesFilter: datesFilter,
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
                        $('.views').html(response).show();
                        $('#id_jenis_permohonanV').val(id_jenis_permohonan);
                        $('#status_permohonanV').val(status_permohonan);
                        $('#id_kabkotaV').val(id_kabkota);
                        $('#datesFilterV').val(datesFilter);

                        var fontSize = $('#font_size').val();
                        $('.views .font-custom').css('font-size', fontSize + 'px');

                        var fontFamily = $('#font_family').val();
                        $('.views .font-custom').css('font-family', fontFamily);
                    },
                    error: function(xhr, ajaxOptons, throwError) {
                        alert(xhr.status + '\n' + throwError);
                    }
                });
            }
        }

        async function openPrintFromURL() {
            // Tampilkan SweetAlert loading tanpa tombol
            Swal.fire({
                title: 'Memproses...',
                text: 'Sedang menyiapkan data untuk dicetak.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                // Ambil nilai dari input pengaturan
                const font_size = document.getElementById('font_size').value || 12;
                const font_family = document.getElementById('font_family').value || 'Inter, Sans-Serif';

                // Ambil filter data dari input hidden
                const id_jenis_permohonanV = document.getElementById('id_jenis_permohonanV').value;
                const status_permohonanV = document.getElementById('status_permohonanV').value;
                const id_kabkotaV = document.getElementById('id_kabkotaV').value;
                const datesFilterV = document.getElementById('datesFilterV').value;

                const params = new URLSearchParams({
                    jenisPermohonan: id_jenis_permohonanV,
                    sttsPermohonan: status_permohonanV,
                    id_kabkotaFilter: id_kabkotaV,
                    tglFilter: datesFilterV,
                    font_size: font_size,
                    font_family: font_family
                });

                const url = "{{ url('/laporan/cetakPermohonanFilter') }}?" + params.toString();

                const response = await fetch(url);

                if (!response.ok) throw new Error("Gagal memuat data cetak");

                const html = await response.text();

                const printFrame = document.getElementById("printFrame");
                const doc = printFrame.contentWindow.document;

                doc.open();
                doc.write(html);
                doc.close();

                printFrame.onload = function() {
                    Swal.close(); // Tutup loading saat frame siap
                    printFrame.contentWindow.focus();
                    printFrame.contentWindow.print();
                };

            } catch (err) {
                Swal.close(); // Tutup loading jika error
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mencetak: ' + err.message,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }

        async function downloadExcel() {
            Swal.fire({
                title: 'Menyiapkan File Excel...',
                text: 'Mohon tunggu sebentar.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Ambil nilai filter dari elemen HTML
            const jenisPermohonan = document.getElementById('id_jenis_permohonanV').value;
            const sttsPermohonan = document.getElementById('status_permohonanV').value;
            const id_kabkotaFilter = document.getElementById('id_kabkotaV').value;
            const tglFilter = document.getElementById('datesFilterV').value;

            const params = new URLSearchParams({
                jenisPermohonan,
                sttsPermohonan,
                id_kabkotaFilter,
                tglFilter
            });

            const url = "{{ url('/laporan/exportPermohonanFilter') }}?" + params.toString();

            try {
                const response = await fetch(url, {
                    method: 'GET'
                });

                if (!response.ok) throw new Error("Gagal mengunduh file Excel.");

                const blob = await response.blob();
                const fileURL = window.URL.createObjectURL(blob);
                const link = document.createElement('a');

                link.href = fileURL;
                link.download = "permohonan_filter.xlsx"; // Ganti sesuai nama file
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);

                window.URL.revokeObjectURL(fileURL);
                Swal.close();
            } catch (error) {
                Swal.fire("Gagal", error.message, "error");
            }
        }
    </script>
@endsection
