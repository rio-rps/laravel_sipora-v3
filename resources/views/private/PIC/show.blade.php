@if (getLevel() == 2)
    <div class="bs-callout-danger callout-border-left callout-bordered mt-1 mb-2 p-1">
        <h4 class="primary">Informasi</h4>
        <p>Silakan Hubungi Admin Dishub Provinsi Sumatera Selatan apabila ada perubahan nomor Telpon PIC.</p>
    </div>
@endif
<div class="table-responsive">
    <table id="myTable" class="table table-striped  table-hover" style="width:100%;  ">
        <thead class="thead-dark ">
            <tr>
                <th width="1%">#No</th>
                <th><i class="fa fa-university"></i> Kab/Kotak</th>
                <th><i class="fa fa-phone-square"></i> No Telepon 1</th>
                <th><i class="fa fa-phone-square"></i> No Telepon 2</th>
                @if (getLevel() == 1)
                    <th width="10%" align="center"><i class="fa fa-cogs"></i> Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $resultPIC)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $resultPIC->nm_kabkota }}</td>
                    <td>{{ $resultPIC->no_tlp1 }}</td>
                    <td>{{ $resultPIC->no_tlp2 }}</td>
                    @if (getLevel() == 1)
                        <td align="center">
                            <button class="btn-secondary btn-sm" id="tombolModalForm"
                                data-url="{{ route('PIC.create', ['kode_provinsi' => $resultPIC->kode_provinsix, 'kode_kabkota' => $resultPIC->kode_kabkotax]) }}">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
