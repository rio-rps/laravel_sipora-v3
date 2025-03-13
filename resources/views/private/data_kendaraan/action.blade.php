<center>
    <div class="btn-icon-list btn-list">
        <button type="button" class="btn btn-sm btn-warning" id="tombolModalForm"
            data-url="{{ route('datakendaraan.createUpload', $model->id_kendaraan) }}" title="Upload Data"><i
                class="fa fa-upload"></i></button>
        <button type="button" class="btn btn-sm btn-success" id="tombolModalForm"
            data-url="{{ route('datakendaraan.edit', $model->id_kendaraan) }}" title="Edit Data"><i
                class="fa fa-edit"></i></button>
        <form method="POST" action="{{ route('datakendaraan.destroy', $model->id_kendaraan) }}" class="formDelete"
            style="display: inline">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
</center>
