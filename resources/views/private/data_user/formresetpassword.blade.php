<div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel5"><b>{{$title_form}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dataUser.updateResetPassword',$id) }}" class="formData" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <table class="table-striped">
                        <tr>
                            <td width="30%">Password Default</td>
                            <td width="1%">:</td>
                            <td>123456</td>
                        </tr>
                    </table>
                    <div class="alert alert-success" role="alert" style="margin-top: 15px;">
                        Apabila di reset maka password akan menjadi default.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                        <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">RESET</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('private/js/myscriptpost.js')}}"></script>