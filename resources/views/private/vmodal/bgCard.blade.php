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
                            Ini merupakan contoh warna background untuk kartu Permohonan (kode-{{ $bgCard }})
                        </p>
                    </div>
                </div>


                <div class="card text-left">

                    <div class="card-body">
                        <img class="card-img-top" src="{{ asset('images/kartu/' . $bgCard . '/depan.png') }}">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
