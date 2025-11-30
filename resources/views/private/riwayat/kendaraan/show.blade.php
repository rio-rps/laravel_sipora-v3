@if ($result->isNotEmpty())
    <div class="alert alert-success" role="alert">
        Data ditemukan berjumlah {{ count($result) }} Data
    </div>

    @foreach ($result as $row)
        <div class="card mb-1 shadow-sm border-secondary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="card-title font-weight-bold">
                            <i class="fa fa-building text-primary"></i> {{ $row->nm_badan_usaha ?? '-' }}
                        </h6>
                        <ul class="list-unstyled small">
                            <li>
                                <strong><i class="fa fa-address-card text-success"></i> Nama Perusahaan /
                                    Personal:</strong><br>
                                {{ $row->nm_perusahaan_personal ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-user text-info"></i> Nama Pimpinan / Pemilik:</strong><br>
                                {{ $row->nm_pimpinan_pemilik ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-envelope text-warning"></i> Email:</strong><br>
                                {{ $row->email ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-phone text-danger"></i> No HP:</strong><br>
                                {{ $row->no_telp ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-map-marker text-secondary"></i> Alamat:</strong><br>
                                {{ $row->alamat_biodata ?? '-' }}
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h6 class="card-title font-weight-bold">
                            <i class="fa fa-car"></i> {{ $row->nm_kendaraan ?? '-' }}
                        </h6>
                        <ul class="list-unstyled small">
                            <li>
                                <strong><i class="fa fa-industry text-primary"></i> Merek / Tipe:</strong>
                                {{ $row->nm_merek_kendaraan ?? '-' }} /
                                {{ $row->nm_type_kendaraan ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-id-card text-info"></i> Plat Nomor:</strong>
                                {{ $row->plat_no_kendaraan ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-cogs text-warning"></i> Nomor Rangka:</strong>
                                {{ $row->no_rangka ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-cog text-danger"></i> Nomor Mesin:</strong>
                                {{ $row->no_mesin ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-users text-success"></i> Daya Angkut Orang:</strong>
                                {{ number_format($row->daya_angkut_orang ?? 0) }} Org
                            </li>
                            <li>
                                <strong><i class="fa fa-th text-secondary"></i> Daya Angkut Barang:</strong>
                                {{ number_format($row->daya_angkut_barang ?? 0) }} Kg
                            </li>
                            <li>
                                <strong><i class="fa fa-calendar text-primary"></i> Tahun:</strong>
                                {{ $row->thn_pembuatan ?? '-' }}
                            </li>
                            <li>
                                <strong><i class="fa fa-toggle-on text-success"></i> Status:</strong>
                                {!! status_actived($row->status_actived) !!}
                            </li>
                        </ul>
                        <button class="btn btn-secondary" type="button" id="tombolModalForm"
                            data-url="{{ route('datakendaraan.edit', $row->id_kendaraan) }}">
                            <i class="fa fa-edit me-1 text-success"></i> Edit Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="list-group">
        <a class="list-group-item flex-column align-items-start">
            Data Tidak ditemukan ...
        </a>
    </div>
@endif
