  <style>
      /* Container kartu (ukuran fisik ATM/KTP: 85.6mm x 53.98mm) */
      .kotak_depan,
      .kotak_belakang {
          width: 85.6mm;
          height: 53.98mm;
          border: 0px solid #000;
          border-radius: 2px;
          overflow: hidden;
          box-sizing: border-box;
          //font-family: Arial, Helvetica, sans-serif;
          padding: 2mm;
          box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
          position: relative;
          /* untuk background absolute */
          background-color: transparent;
      }

      /* Gambar background sebagai elemen <img> (supaya html2canvas bisa deteksi crossOrigin) */
      .bg-img {
          position: absolute;
          inset: 0;
          /* top:0;right:0;bottom:0;left:0; */
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: 0;
          pointer-events: none;
      }

      /* Konten di atas background */
      .kartu-content {
          position: relative;
          z-index: 1;
          color: #000;
      }

      table {
          font-size: 9px;
          width: 100%;
          border-collapse: collapse;
      }

      .title {
          text-align: center;
          font-weight: bold;
      }

      .desk {
          font-weight: bold;
      }

      .logos {
          width: 100%;
      }

      /* Perbaikan comment CSS: gunakan /* ... *\/ bukan // */
      .kotak_belakang {
          background-size: contain;
          background-repeat: no-repeat;
          background-position: center;
          padding: 2mm;
          background-blend-mode: overlay;
      }

      .text-center {
          text-align: center;
      }

      /* styling tambahan untuk layout QR dan teks */
      .qr-cell {
          width: 20px;
          text-align: center;
          vertical-align: top;
      }

      /* kecilkan font pada beberapa teks */
      .small-note {
          font-size: 8px;
          display: block;
      }

      /* agar tombol tidak terlalu menempel */
      .download-row {
          margin-top: 12px;
          margin-bottom: 24px;
      }
  </style>

  <!-- KARTU DEPAN -->
  <div id="kartuDepan" class="kotak_depan">
      <img src="{{ asset("images/kartu/{$bgCard}/depan.png") }}" class="bg-img" crossorigin="anonymous" alt="bg-depan">
      <div class="kartu-content">
          <table>
              <tr>
                  <td colspan="4" align="center">
                      <table class="logos">
                          <tr>
                              <td>
                                  <img src="{{ asset('images/kartu/logo_dishub.png') }}" width="40"
                                      crossorigin="anonymous" alt="logo_dishub">
                              </td>
                              <td width="100%" align="center" class="title" style="font-size: 13px; color:  #000">
                                  DINAS PERHUBUNGAN <br> PROVINSI SUMATERA SELATAN
                              </td>
                              <td>
                                  <img src="{{ asset('images/kartu/logo_provsumsel.png') }}" width="40"
                                      crossorigin="anonymous" alt="logo_report">
                              </td>
                          </tr>
                      </table>
                      <hr style="border: 2px solid #000; margin-top: -2px;">
                  </td>
              </tr>
          </table>

          <div class="text-center title" style="margin-top:-12px;margin-bottom:12px; color: #000; ">
              KARTU PENGAWASAN ELEKTRONIK
          </div>

          @if ($row->JPermohonan->id_trayek != 0)
          <table style="margin-top: -10px;font-size: 9px;color: #000;">
              @else
              <table style="margin-top: -10px;font-size: 10px;color: #000;">
                  @endif

                  <tr class="desk">
                      @if ($row->JPermohonan->id_trayek != 0)
                      <td rowspan="5" class="qr-cell">
                          @else
                      <td rowspan="4" class="qr-cell">
                          @endif
                          {{-- QRCode: package biasanya menghasilkan SVG atau IMG --}}
                          <div style="padding-top:5px;">
                              {!! QrCode::size(50)->generate($QRcode) !!}
                          </div>
                      </td>
                      <td>NOMOR</td>
                      <td>:</td>
                      <td>
                          {{ \Illuminate\Support\Str::limit(strtoupper($row->no_kartu_pengawas), 32) }}
                      </td>
                  </tr>

                  <tr class="desk">
                      <td>NO. TNKB</td>
                      <td>:</td>
                      <td>{{ strtoupper($row->JPermohonan->plat_no_kendaraan) }}</td>
                  </tr>

                  <tr class="desk">
                      <td>NAMA PERUSAHAAN</td>
                      <td style="vertical-align: top;">:</td>
                      <td>
                          {{ \Illuminate\Support\Str::limit(strtoupper($row->JPermohonan->nm_perusahaan_personal), 50) }}
                      </td>
                  </tr>

                  @if ($row->JPermohonan->id_trayek != 0)
                  <tr class="desk">
                      <td>TRAYEK</td>
                      <td style="vertical-align: top;">:</td>
                      <td>
                          {{ \Illuminate\Support\Str::limit(strtoupper($row->JPermohonan->Jtrayek->nm_trayek), 53) }}
                      </td>
                  </tr>
                  @endif

                  <tr class="desk">
                      <td>MASA BERLAKU</td>
                      <td style="vertical-align: top;">:</td>
                      <td>S.D {{ cek_ddmmyy_v4($row->tgl_akhir) }}</td>
                  </tr>
              </table>
      </div>
  </div>

  <div class="download-row">
      <button onclick="downloadImage('depan','png')">Download Depan PNG</button>
      <button onclick="downloadImage('depan','jpg')">Download Depan JPG</button>
  </div>

  <!-- KARTU BELAKANG -->
  <div id="kartuBelakang" class="kotak_belakang">
      <img src="{{ asset("images/kartu/{$bgCard}/belakang.png") }}" class="bg-img" crossorigin="anonymous"
          alt="bg-belakang">
      <div class="kartu-content">
          <div class="text-center title" style="margin-bottom:12px; color: #000; ">
              5 CITRA MANUSIA PERHUBUNGAN
              <hr style="border: 2px solid #000; margin-top: -1px;">
          </div>

          <table class="small-note"
              style="font-weight:600;font-size: 9px;  font-family: 'Signika', Arial, sans-serif;    ">
              <tr>
                  <td width="1%" style="vertical-align: top; padding-right: 5px;">1.</td>
                  <td style="padding-left: 5px;">Taqwa&nbsp;terhadap&nbsp;Tuhan&nbsp;Yang&nbsp;Maha&nbsp;Esa.</td>
              </tr>
              <tr>
                  <td style="vertical-align: top; padding-right: 5px;">2.</td>
                  <td style="padding-left: 5px;">Tanggap terhadap kebutuhan masyarakat akan pelayanan jasa yang tertib,
                      teratur, tepat waktu, bersih, dan nyaman.</td>
              </tr>
              <tr>
                  <td style="vertical-align: top; padding-right: 5px;">3.</td>
                  <td style="padding-left: 5px;">Tangguh menghadapi tantangan.</td>
              </tr>
              <tr>
                  <td style="vertical-align: top; padding-right: 5px;">4.</td>
                  <td style="padding-left: 5px;">Terampil dan berperilaku jujur, gesit, ramah, sopan, serta lugas.</td>
              </tr>
              <tr>
                  <td style="vertical-align: top; padding-right: 5px;">5.</td>
                  <td style="padding-left: 5px;">Tanggung jawab terhadap keselamatan dan keamanan jasa perhubungan.</td>
              </tr>
              <tr>
                  <td colspan="2" align="center" style="padding-top: 10px; font-style: italic; font-size: 9px;">
                      <span class="small-note">
                          "Apabila kartu ini tercecer, harap dikembalikan kepada<br>
                          Dinas Perhubungan Provinsi Sumatera Selatan."
                      </span>
                  </td>
              </tr>
          </table>
      </div>
  </div>

  <div class="download-row">
      <button onclick="downloadImage('belakang','png')">Download Belakang PNG</button>
      <button onclick="downloadImage('belakang','jpg')">Download Belakang JPG</button>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
      // Utility: tunggu semua gambar di dalam elemen selesai dimuat
      function waitForImages(container) {
          const imgs = Array.from(container.querySelectorAll('img'));
          const promises = imgs.map(img => {
              return new Promise(resolve => {
                  if (img.complete && img.naturalWidth !== 0) return resolve();
                  img.addEventListener('load', () => resolve());
                  img.addEventListener('error', () => resolve()); // tetap resolve agar tidak menggantung
              });
          });
          return Promise.all(promises);
      }

      // Utility: download blob
      function downloadBlob(blob, filename) {
          const link = document.createElement('a');
          link.href = URL.createObjectURL(blob);
          link.download = filename;
          document.body.appendChild(link);
          link.click();
          setTimeout(() => {
              URL.revokeObjectURL(link.href);
              link.remove();
          }, 100);
      }

      async function downloadImage(pos, type) {
          const el = pos === 'depan' ? document.getElementById('kartuDepan') : document.getElementById(
              'kartuBelakang');

          // tunggu semua gambar di kartu selesai load
          await waitForImages(el);

          // scale agar hasil tajam di layar high-DPI
          const baseScale = Math.max(1, window.devicePixelRatio || 1);
          const scale = baseScale * 2; // *2 untuk kualitas lebih tajam. Sesuaikan bila file terlalu besar.

          html2canvas(el, {
              scale: scale,
              useCORS: true, // coba gunakan CORS untuk gambar
              allowTaint: false, // jangan izinkan taint jika gambar cross-origin
              logging: false,
              imageTimeout: 15000
          }).then(async (canvas) => {
              if (type === 'jpg') {
                  // gunakan toBlob untuk kualitas dan memori lebih baik
                  canvas.toBlob(function(blob) {
                      downloadBlob(blob, `kartu_pengawasan_${pos}.jpg`);
                  }, 'image/jpeg', 0.95);
              } else {
                  canvas.toBlob(function(blob) {
                      downloadBlob(blob, `kartu_pengawasan_${pos}.png`);
                  }, 'image/png');
              }
          }).catch(err => {
              console.error('Gagal membuat gambar:', err);
              alert('Gagal membuat gambar. Cek console untuk detail.');
          });
      }
  </script>