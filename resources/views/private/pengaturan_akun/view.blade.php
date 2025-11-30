@extends('private.layout.main')
@section('isi')
    @php
        $id = Auth::user()->id;
    @endphp

    <div class="content-body">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><b>{{ $title }}</b></h4>
            </div>
            <hr>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">

                            <ul class="list-group mb-1">
                                <li class="list-group-item bg-default white bg-blue-grey">
                                    AKUN LOGIN E-MAIL
                                </li>

                                <li class="list-group-item">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label border-bottom">Ganti</label>
                                            <div class="col-md-9">
                                                <form action="{{ route('pengaturanakun.updateemail') }}"
                                                    class="formDataPengaturanAkun" method="PUT">
                                                    <input type="hidden" name="id" class="form-control"
                                                        value="{{ $id }}">
                                                    @csrf
                                                    <div class="input-group">
                                                        <input type="text" name="email" id="email"
                                                            class="form-control" placeholder="Masukkan disini e-Mail">
                                                        <button type="submit" class="btn-send btn btn-primary btn-glow"
                                                            id="tombolSaveEmail">
                                                            <i class='feather icon-play mr-25'></i> <span
                                                                class="d-sm-inline">GANTI EMAIL</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>


                            <ul class="list-group">
                                <li class="list-group-item bg-default  white bg-blue-grey">
                                    AKUN LOGIN PASSWORD
                                </li>
                                <li class="list-group-item">
                                    <form action="{{ route('pengaturanakun.updatepassword', $id) }}"
                                        class="formDataPengaturanAkun" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label border-bottom">Password Lama</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" autocomplete="off"
                                                        name="password_old" placeholder="Password Lama" maxlength="100"
                                                        id="showpassword1">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="show('1')"><i
                                                                class="eye1 fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label border-bottom">Password Baru</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="password" class="form-control" name="password_new"
                                                        placeholder="Password Baru" id="showpassword2">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="show('2')"><i
                                                                class="eye2 fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label border-bottom">Confirm Password
                                                Baru</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="password" class="form-control"
                                                        name="password_new_confirmation" placeholder="Confirm Password Baru"
                                                        id="showpassword3">
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            onclick="show('3')"><i
                                                                class="eye1 fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3"></label>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <button type="submit" class="btn-send btn btn-primary btn-glow"
                                                        id="tombolSave">
                                                        <i class='feather icon-play mr-25'></i> <span
                                                            class="d-sm-inline">GANTI PASSWORD</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item default">INFO</li>
                                <li class="list-group-item" style=" text-align: justify;">
                                    Untuk Keamanan Akun, pergantian password setidaknya harus memiliki persyaratan sebagai
                                    berikut :<br>
                                    > Minimal 6 karakter.<br>
                                    > Menggunakan kombinasi antara huruf besar dan huruf kecil.<br>
                                    > Menggunakan simbol atau angka.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function show(kode) {
            var x = document.getElementById("showpassword" + kode);
            if (x.type === "password") {
                x.type = "text";
                $('.eye' + kode).removeClass("fa-eye-slash");
                $('.eye' + kode).addClass("fa-eye");
            } else {
                x.type = "password";
                $('.eye' + kode).addClass("fa-eye-slash");
                $('.eye' + kode).removeClass("fa-eye");
            }
        }


        document.addEventListener('DOMContentLoaded', function() {

            var tombolSave = document.getElementById("tombolSave");
            var tombolSaveEmail = document.getElementById("tombolSaveEmail");
            var tmbol, label;

            tombolSave.addEventListener("click", function() {
                tmbol = 'tombolSave';
                label = 'PASSWORD';
            });
            tombolSaveEmail.addEventListener("click", function() {
                tmbol = 'tombolSaveEmail';
                label = 'EMAIL';
            });


            $('.formDataPengaturanAkun').submit(function(e) {
                e.preventDefault();


                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin melanjutkan?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, pilih'
                }).then((result) => {
                    if (result.value) {


                        $.ajax({
                            type: $(this).attr('method'),
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            beforeSend: function() {
                                $('#' + tmbol).prop('disabled', true);
                                $('#' + tmbol).html(
                                    "<i class='fa fa-spin fa-spinner'></i>");
                            },
                            complete: function() {
                                $('#' + tmbol).prop('disabled', false);
                                $('#' + tmbol).html(
                                    "<i class='feather icon-play mr-25'></i> <span class='d-sm-inline'>GANTI " +
                                    label + "</span>");

                            },
                            success: function(response) {

                                if (response.success) {
                                    Swal.fire('Berhasil', response.success, 'success')
                                        .then((
                                            result) => {
                                            $('#email').val('');
                                            $('#idemail').html(response.email);
                                            if (response.myReload ==
                                                'ReloadPassword') {
                                                window.location.href = response
                                                    .route
                                            }
                                        })
                                }

                            },
                            error: function(xhr, ajaxOptons, throwError) {
                                if (xhr.status >= 500) {
                                    // alert(xhr.status + '\n' + throwError);
                                    Swal.fire('Error', xhr.status + '\n' + throwError,
                                        'error');
                                }

                                if (xhr.status == 422) {
                                    var errors = xhr.responseJSON.errors;
                                    var errorList = '';
                                    for (var key in errors) {
                                        if (errors.hasOwnProperty(key)) {
                                            errorList += '\n - ' + errors[key] +
                                                '</br>';
                                        }
                                    }
                                    Swal.fire('Gagal', errorList, 'warning');
                                    $('#email').val('');
                                }
                            }
                        });
                        return false;
                    }
                });

            });

        });
    </script>
@endsection
