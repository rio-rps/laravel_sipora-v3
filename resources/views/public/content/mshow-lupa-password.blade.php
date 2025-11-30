<div id="getModalForm" class="modal fade" tabindex="-1" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"><b>LUPA PASSWORD</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <div class="border-start border-4 border-warning ps-3 py-2 bg-light">
                        Silakan masukkan email Anda untuk mereset password.<br>
                        Link reset password akan dikirim ke email Anda/ bisa juga hubungi admin.
                    </div>
                </div>
                <form action="{{ route('sendResetEmail') }}" method="POST" class="formActData">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fs-6 fw-semibold">Email <span
                                class="text-danger">*</span></label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa fa-envelope text-muted"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control border-start-0 fs-6"
                                placeholder="Masukkan email...">
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning w-100  fs-5 py-2 tombolReset" id="tombolActSave">
                            <i class="fa fa-key fs-5"></i> Kirim Link Reset Password
                        </button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">TUTUP</button>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('private/js/myscriptpost.js') }}"></script>

<script>
    $('#getModalForm').on('hidden.bs.modal', function() {
        $('body').css('padding-right', '0');
    });
</script>
