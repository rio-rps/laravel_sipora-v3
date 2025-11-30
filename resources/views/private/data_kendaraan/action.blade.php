<div class="d-flex justify-content-center gap-1">
    {{-- Tombol Upload terpisah --}}
    <button type="button" class="btn btn-sm btn-warning mr-1" id="tombolModalForm"
        data-url="{{ route('datakendaraan.createUpload', $model->id_kendaraan) }}" title="Upload Data">
        <i class="fa fa-upload"></i>
    </button>

    {{-- Dropdown Aksi --}}
    <div class="dropdown">
        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
            aria-expanded="false">
            Aksi
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            {{-- Edit --}}
            <button class="dropdown-item" type="button" id="tombolModalForm"
                data-url="{{ route('datakendaraan.edit', $model->id_kendaraan) }}">
                <i class="fa fa-edit me-1 text-success"></i> Edit Data
            </button>

            {{-- Ubah Status --}}
            <button class="dropdown-item" type="button" id="tombolModalForm"
                data-url="{{ route('datakendaraan.edit_status', $model->id_kendaraan) }}">
                <i class="fa fa-bars me-1 text-secondary"></i> Ubah Status
            </button>

            {{-- Hapus Data --}}
            <form method="POST" action="{{ route('datakendaraan.destroy', $model->id_kendaraan) }}"
                class="formDelete  m-0 p-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fa fa-trash me-1"></i> Hapus Data
                </button>
            </form>

        </div>
    </div>
</div>
