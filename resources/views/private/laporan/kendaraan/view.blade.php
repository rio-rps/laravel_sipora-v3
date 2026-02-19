@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="btn-group btn-group-sm " role="group" aria-label="Basic example">
                    <button onclick="openPrintFromURL()" class="btn btn-outline-success mr-1">
                        <i class="fa fa-file-pdf-o"></i> CETAK DOKUMEN PDF
                    </button>
                    <button type="button" onclick="downloadExcel()" class="btn btn-outline-primary">
                        <i class="fa fa-file-excel-o"></i> EXCEL
                    </button>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card-content card border-teal border-lighten-2 ">
                    <div class="card-body ">

                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="stts_kendaraan">Status Kendaraan</label>
                                <select class="custom-select" id="stts_kendaraan">
                                    <option value="">Pilih</option>
                                    <option value="0">Semua</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary w-100" id="tombolProses"
                                    onclick="tombolProses()">
                                    <i class="bx bx-save mr-25"></i> Tampilkan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="views" style="display:none;width:100%"></div>

            </div>
        </div>
    </div>
    <iframe id="printFrame" style="display:none;"></iframe>

    <script>
        function tombolProses() {
            var stts_kendaraan = $('#stts_kendaraan').val();


            if (stts_kendaraan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Status Kendaraan !', 'warning');
            } else {

                myTable = $.ajax({
                    type: 'GET',
                    url: "{{ url('laporan/show_kendaraan') }}",
                    data: {
                        stts_kendaraan: stts_kendaraan,
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
                    },
                    error: function(xhr, ajaxOptons, throwError) {
                        alert(xhr.status + '\n' + throwError);
                    }
                });
            }
        }

        async function openPrintFromURL() {

            var stts_kendaraan = $('#stts_kendaraan').val();
            if (stts_kendaraan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Status Kendaraan !', 'warning');
            } else {

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

                    const stts_kendaraan = document.getElementById('stts_kendaraan').value;
                    const params = new URLSearchParams({
                        stts_kendaraan: stts_kendaraan
                    });

                    const url = "{{ url('/laporan/cetakKendaraanFilterPdf') }}?" + params.toString();

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
        }

        async function downloadExcel() {
            var stts_kendaraan = $('#stts_kendaraan').val();
            if (stts_kendaraan == '') {
                Swal.fire('Informasi', 'Silakan di pilih Status Kendaraan !', 'warning');
            } else {
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
                const stts_kendaraan = document.getElementById('stts_kendaraan').value;

                const params = new URLSearchParams({
                    stts_kendaraan
                });

                const url = "{{ url('/laporan/exportKendaraanFilterExcel') }}?" + params.toString();

                try {
                    const response = await fetch(url, {
                        method: 'GET'
                    });

                    if (!response.ok) throw new Error("Gagal mengunduh file Excel.");

                    const blob = await response.blob();
                    const fileURL = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');

                    link.href = fileURL;
                    link.download = "data_kendaraan.xlsx"; // Ganti sesuai nama file
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);

                    window.URL.revokeObjectURL(fileURL);
                    Swal.close();
                } catch (error) {
                    Swal.fire("Gagal", error.message, "error");
                }
            }
        }
    </script>
@endsection
