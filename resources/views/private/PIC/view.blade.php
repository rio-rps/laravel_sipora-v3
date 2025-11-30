@extends('private.layout.main')
@section('isi')
    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="viewData" style="display:none;width:100%"></div>
            </div>
        </div>
    </div>
    <div class="viewModal" style="display:none;width:100%"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            reload();
        });

        function reload() {
            $.ajax({
                type: 'GET',
                url: "{{ url('PIC/show') }}",
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
    </script>
@endsection
