 <div class="modal fade" id="getModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel5" aria-hidden="true">
     <div class="modal-dialog " role="document">
         <div class="modal-content">
             <div class="modal-header bg-secondary text-white">
                 <h4 class="modal-title" id="myModalLabel5"><b><i class="fa fa-random"></i> {{ $title }}</b>
                 </h4>
                 <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="{{ route('mutasiPIC.update', $id) }}" class="formData" method="POST">
                 @csrf
                 <input type="hidden" name="_method" value="PUT">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <div class="modal-body">
                     <div class="card">
                         <div class="card-body">
                             <div class="form-body">
                                 <div class="form-group row">
                                     <label class="col-sm-12 col-form-label font-weight-bold">PIC SEBEUMNYA</label>
                                     <div class="col-md-12">
                                         {{ $nm_kabkota }}
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-body">
                             <div class="form-body">
                                 <div class="form-group row">
                                     <label class="col-sm-12 col-form-label  font-weight-bold">PIC BARU</label>
                                     <div class="col-md-12">
                                         <input type="hidden" class="form-control  " name="id_kabkota" id="id_kabkota">
                                         <div class="input-group">
                                             <input type="text" class="form-control " id="kabkota-name" readonly>
                                             <div class="input-group-append">
                                                 <span class="btn input-group-text  btn-primary" id="tombolModalForm2"
                                                     data-url="{{ route('vmodal.show_kabkota', ['act' => 'cekdata_mutasiPIC']) }}"
                                                     title="Cari Data"><i class="fa fa-search"></i></span>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <span class="text-left"></span>
                     <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                         <i class="fa fa-times mr-1"></i> TUTUP
                     </button>
                     <button type="reset" class="btn btn-secondary">
                         <i class="fa fa-undo mr-25"></i>
                         <span class="d-sm-inline">RESET</span>
                     </button>
                     <button type="submit" class="btn-send btn btn-primary btn-glow" id="tombolSave">
                         <i class='feather icon-play mr-25'></i> <span class="d-sm-inline">SIMPAN</span>
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>


 <script src="{{ asset('private/js/myscriptpost.js') }}"></script>
