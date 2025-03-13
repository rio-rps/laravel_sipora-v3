<div class="card">
    <div class="row">


        @foreach ($result as $ddresult)
        <div class="col-sm-4 mb-1">
            <p>
                <a href="#"><span class="badge bg-blue-grey pull-right" style="margin-left: 5px;">{{status_actived($ddresult->status_actived) }}</span></a>
                <a href="#" class="btn btn-sm btn-danger pull-right" id="tombol-hapus" data-url="{{ route('slideshow.destroy',['slideshow' => $ddresult->id_slide,'myReload' =>'slideShowData'])}}" title="Hapus Data" style="margin-left: 5px;">
                    <i class="fa fa-trash"></i>
                </a>
                <a href="" class="btn btn-sm btn-success pull-right" id="tombol-form-modal" data-url="{{route('slideshow.edit',$ddresult->id_slide)}}" title="Edit Status" style="margin-left: 5px;">
                    <i class="fa fa-edit"></i>
                </a>
            </p>
            <a href="">
                <img src="{{asset('images/gambar_slide/'.$ddresult->gambar_slide)}}" class="img-thumbnail" style="height: 170px; width: 370px;" title="">
            </a>
        </div>
        @endforeach
        @if (count($result) ==0)
        <div class="container">
            <div class="alert alert-danger" role="alert">
                <strong>Data Kosong</strong>
            </div>
        </div>
        @endif

    </div>
</div>