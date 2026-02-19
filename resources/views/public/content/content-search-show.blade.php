<style>
    .single-line {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .list-item.hover-item {
        transition: background-color 0.2s ease-in-out;
    }

    .list-item.hover-item:hover {
        background-color: #f0f0f0;
        color: #000;
        cursor: pointer;
    }
</style>
@if (count($resultPermohonan) > 0)

    <div class="row g-4 mt-0">
        <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
        <div class="col-md-12 col-lg-12 col-xl-12 wow fadeInUp" data-wow-delay="0.2s">
            <div class="service-days p-4">
                <div class="d-flex justify-content-between align-items-center   bg-white mb-4">
                    <div class="fw-bold d-flex align-items-center">
                        <i class="fa fa-search me-2 text-primary"></i>
                        <span class="fs-6">Pencarian : {{ $search }} </span>
                        &nbsp;<span class="badge bg-secondary">{{ count($resultPermohonan) }} Data</span>
                    </div>
                    <button type="button" onclick="tombolRefresh()"><i class="fa fa-times"></i></button>
                </div>
                <div class="table-responsive">
                    <table class="table " style="font-size:11px;">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th>No Kartu Pengawas</th>
                                <th>No Plat Kendaraan</th>
                                <th>No Rangka</th>
                                <th>No Mesin</th>
                                <th>Tgl Berlaku</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        @foreach ($resultPermohonan as $resultPermohonanAll)
                            <tr class="list-item hover-item">
                                <td>{{ $loop->iteration }}.</td>
                                <td class="single-line">{{ $resultPermohonanAll->no_kartu_pengawas }} </td>
                                <td class="single-line">{{ $resultPermohonanAll->plat_no_kendaraan }}</td>
                                <td class="single-line">
                                    {{ $resultPermohonanAll->no_rangka ? Str::mask($resultPermohonanAll->no_rangka, '*', 4, -4) : '-' }}
                                </td>
                                <td class="single-line">
                                    {{ $resultPermohonanAll->no_mesin ? Str::mask($resultPermohonanAll->no_mesin, '*', 4, -4) : '-' }}
                                </td>
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $isExpired = \Carbon\Carbon::parse($resultPermohonanAll->tgl_akhir)->lt($now);
                                @endphp

                                @if ($resultPermohonanAll->status_permohonan == 5)
                                    <td class="{{ $isExpired ? 'bg-danger text-white' : 'bg-success text-white' }}">
                                        <span class="single-line">
                                            {{ isset($resultPermohonanAll->tgl_awal) ? cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_awal) : '-' }}
                                            s/d
                                        </span>
                                        <span class="single-line">
                                            {{ isset($resultPermohonanAll->tgl_akhir) ? cek_date_ddmmyyyy_his_v2($resultPermohonanAll->tgl_akhir) : '-' }}
                                        </span>
                                    </td>
                                @else
                                    <td class="bg-warning text-white">-</td>
                                @endif


                                <td align="center">
                                    <a href="#" class="btn-secondary btn-sm" title="Lihat" id="tombol-act-modal"
                                        data-url="{{ route('mshow_detail', $resultPermohonanAll->id_permohonan_izin) }}">
                                        <i class="fa fa-id-card  border-1" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="7">
                                <span class="text-danger fw-bold ">
                                    Penting: Untuk memastikan semua fitur aplikasi berjalan dengan lancar, silakan
                                    bersihkan cache / riwayat (history) browser Anda Minimal 24 jam terakhir, kemudian
                                    muat ulang halaman ini.
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row g-4 mt-4">
        <div class="col-0 col-md-1 col-lg-2 col-xl-2"></div>
        <div class="col-md-10 col-lg-8 col-xl-8 wow fadeInUp" data-wow-delay="0.2s">

            <div class="service-days p-4">
                <div class="d-flex justify-content-between align-items-center   bg-white mb-4">
                    <div class="fw-bold d-flex align-items-center">
                        <i class="fa fa-search me-2 text-danger"></i>
                        <span class="fs-6">Pencarian : {{ $search }} </span>
                        &nbsp;<span class="badge bg-secondary">{{ count($resultPermohonan) }} Data</span>
                    </div>
                    <button type="button" onclick="tombolRefresh()"><i class="fa fa-times"></i></button>
                </div>
                <div class="py-2 border-bottom border-top d-flex align-items-center justify-content-between flex-wrap">
                    <p class="mb-0"><i class="fa fa-exclamation-triangle  text-danger me-2"></i>Data tidak
                        ditemukan ...</p>
                </div>
            </div>
        </div>
    </div>
@endif
