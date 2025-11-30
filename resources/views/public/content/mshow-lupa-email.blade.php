<div id="getModalForm" class="modal fade" tabindex="-1" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"><b>LUPA EMAIL</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p> Apabila Anda lupa email, silakan hubungi Call Center kami melalui nomor berikut:</p>
                <p><i class="fa fa-phone"></i> (0711) 352005- 363125</p>
                <p><i class="fa fa-address-card"></i> Bidang Angkutan Jalan</p>
                <p>Atau Anda juga dapat langsung mengunjungi kantor kami di<br>
                    <b>Dinas Perhubungan Provinsi Sumatera Selatan</b><br>
                    <b>Jl. Kapten A. Rivai No. 51 Palembang, Prov Sumsel </b><br>
                </p>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">TUTUP</button>
            </div>

        </div>
    </div>
</div>

<script>
    $('#getModalForm').on('hidden.bs.modal', function() {
        $('body').css('padding-right', '0');
    });
</script>
