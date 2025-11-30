<div
    class="card {{ $rowKendaraan && $rowKendaraan->file_kir && $rowKendaraan->file_stnk ? 'border-primary' : 'border-danger' }} shadow-sm">

    <div
        class="card-header {{ $rowKendaraan && $rowKendaraan->file_kir && $rowKendaraan->file_stnk ? 'bg-primary' : 'bg-danger' }}    text-white py-2">
        <strong><i class="fa fa-exclamation-triangle mr-1"></i> KELENGKAPAN DOKUMEN
            KENDARAAN</strong>
    </div>
    <div class="card-body" style="margin-top: -10px;">
        {{--  <hr class="border-secondary">  --}}
        <div class="col-md-12">
            <div class="form-body">
                <table class="   table-sm">
                    <tbody>
                        <tr>
                            <td width="30%">KIR</td>
                            <td width="1%">:</td>
                            <td>
                                @if (isset($rowKendaraan->file_kir))
                                    <a target="_blank"
                                        href="{{ asset('upload/file_kendaraan/' . $rowKendaraan->file_kir) }}">
                                        [Download]
                                    </a>
                                @else
                                    <span class="text-danger">Kosong</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>STNK</td>
                            <td>:</td>
                            <td>
                                @if (isset($rowKendaraan->file_stnk))
                                    <a target="_blank"
                                        href="{{ asset('upload/file_kendaraan/' . $rowKendaraan->file_stnk) }}">
                                        [Download]
                                    </a>
                                @else
                                    <span class="text-danger">Kosong</span>
                                @endif
                            </td>
                        </tr>
                        @if (!($rowKendaraan && $rowKendaraan->file_kir && $rowKendaraan->file_stnk))
                            <tr>
                                <td colspan="3" class="text-danger">
                                    * Silakan dilengkapi dokumen kendaraan
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
