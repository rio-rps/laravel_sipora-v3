<link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap.css')}}">

<link rel="stylesheet" type="text/css" href="{{ asset('private/css/bootstrap-extended.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('private/css/colors.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('private/css/core/colors/palette-gradient.css')}}">
<!-- BEGIN: Content-->
<div class="content-body">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-6 col-md-12 col-12 box-shadow-2 p-0">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>AKUN BERHASIL DI DAFTARKAN</b></h4>
                    <hr class="border-secondary">
                </div>


                <div class="card-body" style="margin-top: -45px;">
                    <div class="card">
                        <table style="vertical-align: top;" class="table table-striped table-responsive" style="width:100%;">

                            <body>
                                <tr>
                                    <td style="vertical-align: top;">NAMA</td>
                                    <td style="vertical-align: top;" width="1%"> :</td>
                                    <td style="vertical-align: top;">{{ $name }}</td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td>
                                    <td>:</td>
                                    <td>{{ $email }}</td>
                                </tr>
                                <tr>
                                    <td>PASSWORD DEFAULT</td>
                                    <td>:</td>
                                    <td>123456</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-danger" role="alert" style="margin-top:50px;">
                                            Anda bisa login menggunakan email dan password di atas, silakan ganti password default tersebut agar lebih aman.
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="right">
                                        <a href="{{route('login')}}" class="btn btn-primary pull-right">Login</a>
                                    </td>
                                </tr>

                            </body>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>