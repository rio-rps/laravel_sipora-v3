<center>
    <div class="btn-icon-list btn-list">
        <button type="button" class="btn btn-sm btn-success" id="tombolModalForm" data-url="{{ route('cparTrayek.edit',$model->id_trayek)}}" title="Edit Data"><i class="fa fa-edit"></i></button>
        <form method="POST" action="{{ route('cparTrayek.destroy', $model->id_trayek) }}" class="formDelete" style="display: inline">
            @csrf
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
</center>