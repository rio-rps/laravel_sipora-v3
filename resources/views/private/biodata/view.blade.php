@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card shadow-sm border-0">
            <div class="card-header  bg-secondary text-white d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">
                    <i class="fa fa-id-card mr-2 text-primary"></i><strong>{{ $title }}</strong>
                </h4>

                @php $level = Auth::user()->level; @endphp
                @if ($level == 3)
                    <button class="btn btn-sm btn-primary" id="tombolModalForm"
                        data-url="{{ route('biodata.create', ['id_user' => $id_user]) }}">
                        <i class="fa fa-edit mr-1"></i> Edit Biodata
                    </button>
                @endif
            </div>

            <div class="card-body">
                <div class="biodata">
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="fa fa-upload mr-2"></i><strong>DOKUMEN WAJIB UPLOAD</strong>
                </h5>
            </div>
            <div class="card-body">
                <div class="upload">
                </div>
            </div>
        </div>

        <div id="loading-spinner" class="text-center mt-3 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Memuat...</span>
            </div>
        </div>

        <div class="viewModal" style="display:none;"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            show();
            upload();
        });

        function show() {
            $.ajax({
                type: 'GET',
                url: "{{ route('biodata.show', $id_user) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    $('.biodata').html(response).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }

        function upload() {
            $.ajax({
                type: 'GET',
                url: "{{ route('upload.showUploadDokumenBiodata', $id_user) }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    $('.upload').html(response).show();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    </script>
@endsection
