 <center>
     <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
         @if ($model->level != 1)
             <!-- <form method="POST" action="{{ route('dataUser.destroy', $model->id) }}" class="formDelete" style="display: inline">
                 @csrf
                 <input type="hidden" name="_method" value="DELETE">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <button type="submit" class="btn btn-sm btn-danger">
                     <i class="fa fa-trash"></i>
                 </button>
             </form> -->
         @endif
         <div class="btn-group" role="group">
             <button id="btnGroupDrop2" type="button" class="btn btn-sm btn-outline-info dropdown-toggle"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Aksi
             </button>
             <div class="dropdown-menu" aria-labelledby="btnGroupDrop2" x-placement="bottom-start"
                 style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 41px, 0px);">
                 @if ($model->level == 3)
                     <a class="dropdown-item" href="{{ route('dataUser.viewBiodata', $model->id) }}"
                         title="Lihat Biodata"><i class="fa fa-address-card"></i> Lihat Biodata</a>
                 @endif
                 <a class="dropdown-item" id="tombolModalForm" data-url="{{ route('dataUser.editEmail', $model->id) }}"
                     title="Edit e-Mail"><i class="fa fa-user"></i> Edit Email</a>
                 <a class="dropdown-item" id="tombolModalForm"
                     data-url="{{ route('dataUser.editResetPassword', $model->id) }}" title="Reset Password"><i
                         class="fa fa-unlock"></i> Reset Password</a>
             </div>
         </div>
     </div>
 </center>
