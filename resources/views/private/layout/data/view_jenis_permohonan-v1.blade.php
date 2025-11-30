  <span class=" fw-bold mr-1 ml-1 font-6">{{ $title_form }}</span>
  <div class="row mt-1 ">
      @foreach ($resultJenisPermohonan as $resultJenisPermohonanAll)
          <div class="col-xl-4 col-lg-4 col-12">
              <div class="card card border-primary text-center bg-transparent  mr-1 ml-1">
                  <div class="card-content">
                      <div class="card-body">
                          <div class="media">
                              <div class="media-body text-left w-100">
                                  <h3 class="primary">
                                      {{ number_format($resultJenisPermohonanAll->total, 0, ',', '.') }} Kendaraan
                                  </h3>
                                  <span>{{ $resultJenisPermohonanAll->nm_jenis_permohonan }}</span>
                              </div>
                              <div class="media-right media-middle">
                                  <i class="fa fa-sticky-note-o primary font-large-2 float-right"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
