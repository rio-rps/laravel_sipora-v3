@if ($row)
    <div class="table-responsive">
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td width="30%"><i class="fa fa-building text-primary"></i> <strong>Badan Usaha</strong></td>
                    <td width="1%">:</td>
                    <td>{{ $row->BadanUsaha->nm_badan_usaha }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-address-card text-success"></i> <strong>Nama Perusahaan / Personal</strong></td>
                    <td>:</td>
                    <td>{{ $row->nm_perusahaan_personal }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user text-info"></i> <strong>Nama Pimpinan / Pemilik</strong></td>
                    <td>:</td>
                    <td>{{ $row->nm_pimpinan_pemilik }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-envelope text-warning"></i> <strong>Email</strong></td>
                    <td>:</td>
                    <td>{{ $row->email }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-phone text-danger"></i> <strong>No HP</strong></td>
                    <td>:</td>
                    <td>{{ $row->no_telp }}</td>
                </tr>
                <tr>
                    <td><i class="fa fa-map-marker text-secondary"></i> <strong>Alamat</strong></td>
                    <td>:</td>
                    <td>{{ $row->alamat_biodata }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                            <h4 class="danger">Informasi !</h4>
                            <p>
                                Harap mengisi data secara benar dan lengkap, karena data yang Anda masukkan akan menjadi
                                dasar informasi pada cetakan di aplikasi.<br>
                                Pada nama perusahan tuliskan kembali PT/CV, Contoh: PT. Maju Bersama / CV. Maju Bersama
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@else
    <div class="card-body">
        <div class="alert alert-danger" role="alert">
            <i class="fa fa-exclamation-triangle"></i> <strong>Data Kosong</strong>, silakan klik <strong>Edit
                Biodata</strong> untuk melengkapi data Anda!
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <td width="30%"><i class="fa fa-building text-primary"></i> <strong>Badan Usaha</strong></td>
                    <td width="1%">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user text-success"></i> <strong>Nama Perusahaan / Personal</strong></td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><i class="fa fa-user text-info"></i> <strong>Nama Pimpinan / Pemilik</strong></td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><i class="fa fa-envelope text-warning"></i> <strong>Email</strong></td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><i class="fa fa-phone text-danger"></i> <strong>No HP</strong></td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td><i class="fa fa-map-marker text-secondary"></i> <strong>Alamat</strong></td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="bs-callout-danger callout-border-left callout-bordered mt-1 p-1">
                            <h4 class="danger">Informasi !</h4>
                            <p>
                                Harap mengisi data secara benar dan lengkap, karena data yang Anda masukkan akan menjadi
                                dasar informasi pada cetakan di aplikasi.<br>
                                Pada nama perusahan tuliskan kembali PT/CV, Contoh: PT. Maju Bersama / CV. Maju Bersama
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif
