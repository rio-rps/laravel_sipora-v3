@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                @php
                    $level = Auth::user()->level;
                @endphp
                @if ($level == 3)
                    <button class="btn btn-sm btn-primary pull-right" id="tombolModalForm"
                        data-url="{{ route('biodata.create', ['id_user' => $id_user]) }}" title="Edit Data"><i
                            class="fa fa-edit"></i> Edit</button>
                @endif
                <h4 class="card-title"><b>{{ $title }}</b></h4>
                <hr class="border-secondary">
            </div>
            <div class="card-body" style="margin-top: -45px;">
                <div class="row biodata"></div>
            </div>
            <div class="card-footer">

                <div class="card box-shadow-0 border-blue box-sm">
                    <div class="card-header card-head-inverse bg-secondary">
                        <h4 class="card-title"><i class="fa fa-upload"></i> DOKUMEN WAJIB UPLOAD</h4>
                    </div>

                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="upload"></div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="viewModal" style="display:none;"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            show();
            upload();
        });

        function show() {
            myTable = $.ajax({
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
                error: function(xhr, ajaxOptons, throwError) {
                    alert(xhr.status + '\n' + throwError);
                }
            });
        }

        function upload() {
            myTable = $.ajax({
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
                error: function(xhr, ajaxOptons, throwError) {
                    alert(xhr.status + '\n' + throwError);
                }
            });
        }
    </script>
@endsection
