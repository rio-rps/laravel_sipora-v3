document.addEventListener('DOMContentLoaded', function() { 
    // FORM GET MODAL INPUT DATA TYPE GET // ke 1
    $(document).on('click', '#tombolModalForm', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loading-spinner').removeClass('d-none');
            },
            complete: function() {
                $('#loading-spinner').addClass('d-none');
            },
            success: function(response) {
                $('.viewModal').html(response).show();
                $('#getModalForm').modal('show');
            },
            error: function(xhr, ajaxOptons, throwError) {
                alert(xhr.status + '\n' + throwError);
            }
        });
    });

      // FORM GET MODAL INPUT DATA TYPE GET // ke 2
      $(document).on('click', '#tombolModalForm2', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loading-spinner').removeClass('d-none');
            },
            complete: function() {
                $('#loading-spinner').addClass('d-none');
            },
            success: function(response) {
                $('.viewModal2').html(response).show();
                $('#getModalForm2').modal('show');
            },
            error: function(xhr, ajaxOptons, throwError) {
                alert(xhr.status + '\n' + throwError);
            }
        });
 
    });


    
    $(document).on('click', '#tombol-act-modal', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        Swal.fire({
            title: 'Load Data...',
            html: '<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div></div>',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.close();   
                $('.viewModal').html(response).show();
                $('#getModalForm').modal('show'); 
            },
            error: function(xhr, ajaxOptions, thrownError) {
                Swal.close();   
                // Optional: sembunyikan atau kosongkan konten modal jika error
                $('.viewModal').html('').hide();
                
                // Pastikan modal tertutup jika sempat terbuka
                $('#getModalForm').modal('hide');
        
                // Tampilkan alert atau SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: xhr.status + ' - ' + thrownError
                });
            }
        });
    });

    // PILIH

    $(document).on('click', '#tombolGetPilih', function(e) {
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#loading-spinner').removeClass('d-none');
            },
            complete: function() {
                $('#loading-spinner').addClass('d-none');
            },
            success: function(response) {
                $('#getModalForm').modal('hide');

                //document.getElementById("id_kendaraan").value = response.id_kendaraan;
                getDataKendaraanUpload(response.id_kendaraan);
                document.getElementById("id_kendaraan").value = response.id_kendaraan;
                document.getElementById("id_merek_kendaraan").value = response.id_merek_kendaraan;
                document.getElementById("nm_merek_kendaraan").value =response.nm_merek_kendaraan;
                document.getElementById("id_type_kendaraan").value = response.id_type_kendaraan;
                document.getElementById("nm_type_kendaraan").value = response.nm_type_kendaraan;
                document.getElementById("nm_kendaraan").value = response.nm_kendaraan;
                document.getElementById("plat_no_kendaraan").value = response.plat_no_kendaraan;
                document.getElementById("daya_angkut_orang").value = response.daya_angkut_orang;
                document.getElementById("daya_angkut_barang").value = response.daya_angkut_barang;
                document.getElementById("thn_pembuatan").value = response.thn_pembuatan;
                document.getElementById("no_rangka").value = response.no_rangka;
                document.getElementById("no_mesin").value = response.no_mesin;
                document.getElementById("file_kir").value = response.file_kir;
                document.getElementById("file_stnk").value = response.file_stnk;
                document.getElementById("warna_tnkb").value = response.warna_tnkb;
                document.getElementById("bahan_bakar").value = response.bahan_bakar;
                document.getElementById("nmr_faktur_jual_beli").value = response.nmr_faktur_jual_beli;
                document.getElementById("tgl_faktur_jual_beli").value = response.tgl_faktur_jual_beli;
               // document.getElementById("id_biodata").value = response.id_biodata;

            },
            error: function(xhr, ajaxOptons, throwError) {
                alert(xhr.status + '\n' + throwError);
            }
        });
    });




     // DELETE
     $(document).on('click', '.formDelete', function(e){
        e.preventDefault();
        var url = $(this).attr('action');
        
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang sudah dihapus tidak dapat dikembalikan !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data'
        }).then((result) => {
                if (result.value) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: "json", 
                    beforeSend: function() {
                        $('#loading-spinner').removeClass('d-none');
                    },
                    complete: function() {
                        $('#loading-spinner').addClass('d-none');
                    },
                    success: function(response) {
                        if (response.success) {
                            if(response.action=='destroyMappingMengangkut'){
                                Swal.fire('Berhasil', response.success, 'success').then((result) => {  
                                    myTable.ajax.reload(); 
                                    myTable2.ajax.reload(); 
                                })
                            } else if(response.action=='destroyBatalProses_dataPermohonan'){
                                Swal.fire('Berhasil', response.success, 'success').then((result) => {  
                                    window.location.href=response.route;
                                })
                            } else if(response.action=='upload'){
                                Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                                    $('#getModalForm').modal('hide');
                                    upload();
                                })
                            } else if(response.action=='uploadkendaraan'){
                                Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                                    $('#getModalForm2').modal('hide');
                                    upload();
                                })
                            } else {
                            Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                                    myTable.ajax.reload(); 
                            })
                        }
                        } else if (response.error) {
                            Swal.fire('Gagal', response.error, 'warning');
                        }
                    },
                    error: function(xhr, ajaxOptons, throwError) {
                    if (xhr.status == 423) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = ''; 
                        Swal.fire('Gagal', errors, 'warning');
                    } else {
                        alert(xhr.status + '\n' + throwError);
                    }
                 }
                });
            }
        });
    });


// ambil data

 // DELETE
 $(document).on('click', '.formPilih', function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    
    Swal.fire({
        title: 'Apakah Anda Yakin ?', 
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, pilih'
    }).then((result) => {
            if (result.value) {
            $.ajax({
                url: url,
                type: 'POST',
                data: $(this).serialize(),
                dataType: "json", 
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) { 
                    if (response.success) {
                        
                            Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                                if(response.action=='storeMappingMengangkut'){
                                    $('#getModalForm2').modal('hide');
                                    myTable.ajax.reload();
                                    myTable2.ajax.reload(); 
                                } else if(response.action=="validasiPermohonan_dataPermohonan"){ 
                                    window.location.href=response.route;
                                } else if(response.action=="validasiSelesai_dataPermohonan"){
                                    $('#getModalForm').modal('hide');
                                    ShowDataKartuPengawas();
                                    cekAksiKartuPengawas();
                                } else {
                                    myTable.ajax.reload();
                                } 
                             }) 
                    } else if (response.error) {
                        Swal.fire('Gagal', response.error, 'warning');
                    }
                },
                error: function(xhr, ajaxOptons, throwError) {
                    alert(xhr.status + '\n' + throwError);
                }
            });
        }
    }); 
    
});

// HAPUS DATA 
$(document).on('click', '#tombol-hapus', function(e) {
    e.preventDefault();
    var url = $(this).data('url'); 
    Swal.fire({
        title: 'Apakah Anda Yakin ',
        text: "Data Akan dihapus ! ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "DELETE",
                url: url, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                beforeSend: function() {
                    $('#loading-spinner').removeClass('d-none');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Berhasil', response.success, 'success').then((result) => {
                           if(response.myReload=='userdataakses_destroy'){
                                myTables.ajax.reload(); 
                                myTable.ajax.reload(); 
                            } else {
                                myTable.ajax.reload();
                            }
                        })
                    } else if (response.error) {
                        Swal.fire('Gagal', response.error, 'warning');
                    }
                },
                error: function(xhr, ajaxOptons, throwError) {
                    alert(xhr.status + '\n' + throwError);
                }
            }); 
        }
    }) 
 });

 
     // HAPUS DATA 
    // $(document).on('click', '#tombol-hapus', function(e) {
    //     e.preventDefault();
    //     var url = $(this).data('url'); 
    //     Swal.fire({
    //         title: 'Apakah Anda Yakin ',
    //         text: "Data Akan dihapus ! ",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, Hapus!'
    //     }).then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 type: "DELETE",
    //                 url: url, 
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 dataType: "json",
    //                 beforeSend: function() {
    //                     $('#loading-spinner').removeClass('d-none');
    //                 },
    //                 complete: function() {
    //                     $('#loading-spinner').addClass('d-none');
    //                 },
    //                 success: function(response) {
    //                     if (response.success) {
    //                         Swal.fire('Berhasil', response.success, 'success').then((result) => {
    //                             if(response.myReload =='slideShowData'){
    //                                 slideShowData();
    //                             } else {
    //                                 myTable.ajax.reload();
    //                             }
    //                         })
    //                     } else if (response.error) {
    //                         Swal.fire('Gagal', response.error, 'warning');
    //                     }
    //                 },
    //                 error: function(xhr, ajaxOptons, throwError) {
    //                     alert(xhr.status + '\n' + throwError);
    //                 }
    //             });

    //         }
    //     })


    // });

   
    
    
});
  

