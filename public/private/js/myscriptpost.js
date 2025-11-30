
     $(document).ready(function() {

        // form upload
        $('.formDataMultipart').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                //type: "POST",
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                
                beforeSend: function() {
                    $('#tombolSave').prop('disabled', true);
                    $('#tombolSave').html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function() {
                    $('#tombolSave').prop('disabled', false);
                    $('#tombolSave').html("<i class='feather icon-play mr-25'></i> <span class='d-sm-inline'>SIMPAN</span>");
                },
                success: function(response) {
                    if (response.success) {

                        Swal.fire('Berhasil', response.success, 'success').then((result) => {
                            //window.location.reload(); 
                            $('#modalFormData').modal('hide');
                            if(response.myReload =='slideShowData'){
                                slideShowData();
                            } else if(response.myReload =='href'){
                                window.location.href=response.route;
                            } else if(response.action=='upload'){
                                $('#getModalForm').modal('hide');
                                upload();
                            } else if(response.action=='uploadkendaraan'){
                                $('#getModalForm2').modal('hide');
                                upload();
                            } else {
                                myTable.ajax.reload();
                            }
                        })  
                    } 
                },
                error: function(xhr, ajaxOptons, throwError) {

                    if (xhr.status >= 500) {
                        // alert(xhr.status + '\n' + throwError);
                        Swal.fire('Error', xhr.status + '\n' + throwError, 'error');
                    } 
                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorList += '\n - ' + errors[key] + '</br>';
                            }
                        }
                        Swal.fire('Gagal', errorList, 'warning');
                    }
                }
            });
            return false;
        });

          // form upload
          $('.formDataKirim').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#tombolSave').prop('disabled', true);
                    $('#tombolSave').html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function() {
                    $('#tombolSave').prop('disabled', false);
                    $('#tombolSave').html("<i class='feather icon-play mr-25'></i> <span class='d-sm-inline'>KIRIM PERMOHONAN</span>");

                },
                success: function(response) {

                    if (response.success) {
                        Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                            if(response.action=='storePengajuanPermohonan'){
                                window.location.href=response.route;
                            } else {
                                $('#getModalForm').modal('hide');
                                 myTable.ajax.reload();
                            }
                        })  
                    }

                },
                error: function(xhr, ajaxOptons, throwError) {
                    if (xhr.status >= 500) {
                        // alert(xhr.status + '\n' + throwError);
                        Swal.fire('Error', xhr.status + '\n' + throwError, 'error');
                    }

                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorList += '\n - ' + errors[key] + '</br>';
                            }
                        }
                        Swal.fire('Gagal', errorList, 'warning');
                    } else if (xhr.status == 423) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = ''; 
                        Swal.fire('Gagal', errors, 'warning');
                    }
                }
            });
            return false;
        });

        // form tanpa upload 1
        $('.formData').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#tombolSave').prop('disabled', true);
                    $('#tombolSave').html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function() {
                    $('#tombolSave').prop('disabled', false);
                    $('#tombolSave').html("<i class='feather icon-play mr-25'></i> <span class='d-sm-inline'>SIMPAN</span>");

                },
                success: function(response) {

                    if (response.success) {
                        Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                            if(response.action=='show'){
                                $('#getModalForm').modal('hide');
                                show();
                                upload();
                            } else if(response.action=="storeInputKartu_dataPermohonan"){
                                $('#getModalForm').modal('hide');
                                ShowDataKartuPengawas();
                                cekAksiKartuPengawas();
                            } else if(response.action=="validasiSelesai_dataPermohonan"){
                                $('#getModalForm').modal('hide');
                                ShowDataKartuPengawas();
                                cekAksiKartuPengawas();
                            } else if(response.myReload=="PIC"){
                                $('#getModalForm').modal('hide');
                                reload(); 
                            } else {
                                $('#getModalForm').modal('hide'); //masalahnya saat closes ni
                                 
                               myTable.ajax.reload();
                                 tombolProses();
                            }
                        })  
                    }

                },
                error: function(xhr, ajaxOptons, throwError) {
                    if (xhr.status >= 500) {
                        // alert(xhr.status + '\n' + throwError);
                        Swal.fire('Error', xhr.status + '\n' + throwError, 'error');
                    }

                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorList += '\n - ' + errors[key] + '</br>';
                            }
                        }
                        Swal.fire('Gagal', errorList, 'warning');
                    } else if (xhr.status == 423) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = ''; 
                        Swal.fire('Gagal', errors, 'warning');
                    } else if (xhr.status === 419) {
                        Swal.fire('Session Expired', 'Session telah kadaluarsa, silakan refresh halaman.', 'warning');
                    }
                }
            });
            return false;
        });

        // form tanpa upload 2
        $('.formData2').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#tombolSave2').prop('disabled', true);
                    $('#tombolSave2').html("<i class='fa fa-spin fa-spinner'></i>");
                },
                complete: function() {
                    $('#tombolSave2').prop('disabled', false);
                    $('#tombolSave2').html("<i class='feather icon-play mr-25'></i> <span class='d-sm-inline'>SIMPAN</span>");

                },
                success: function(response) {

                    if (response.success) {
                        Swal.fire('Berhasil', response.success, 'success').then((result) => { 
                            if(response.action=='show'){
                                $('#getModalForm2').modal('hide');
                                show();
                            } else {
                                $('#getModalForm2').modal('hide');
                                myTable.ajax.reload();
                            }
                        })  
                    }

                },
                error: function(xhr, ajaxOptons, throwError) {
                    if (xhr.status >= 500) {
                        // alert(xhr.status + '\n' + throwError);
                        Swal.fire('Error', xhr.status + '\n' + throwError, 'error');
                    }

                    if (xhr.status == 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorList += '\n - ' + errors[key] + '</br>';
                            }
                        }
                        Swal.fire('Gagal', errorList, 'warning');
                    } else if (xhr.status == 423) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = ''; 
                        Swal.fire('Gagal', errors, 'warning');
                    }
                }
            });
            return false;
        });

 
        $('.formActData').submit(function(e) {
            e.preventDefault();
            var $form = $(this);
            var $btn = $form.find('#tombolActSave');
        
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize(),
                dataType: "json",
        
                beforeSend: function () {
                    // Cek apakah tombol punya class untuk loading
                    if ($btn.hasClass('tombolReset') || $btn.hasClass('tombolLogin') || $btn.hasClass('tombolRegister')) {
                        if (!$btn.data('original-text')) {
                            $btn.data('original-text', $btn.html());
                        }
                        $btn.prop('disabled', true);
                        $btn.html('<i class="fa fa-spinner fa-spin fs-5 me-1"></i> Loading...');
                    }
                },
        
                complete: function () {
                    if ($btn.hasClass('tombolReset') || $btn.hasClass('tombolLogin') || $btn.hasClass('tombolRegister')) {
                        $btn.prop('disabled', false);
                        $btn.html($btn.data('original-text'));
                    }
                },
        
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Berhasil', response.message, 'success').then(() => {
                            if (response.action === 'register_success') {
                                window.location.href = response.route;
                            } else if(response.action ==='hide_resetpassword'){  
                                $('#getModalForm').modal('hide');
                             } else if(response.action ==='reset_success'){  
                                window.location.href = response.route;
                            } 
                        });
                    } else if (response.error) {
                        Swal.fire('Gagal', response.message, 'error').then(() => {
                            if (response.action === 'register_success') {
                                window.location.href = response.route;
                            }
                        });
                    }
                },
        
                error: function(xhr, ajaxOptions, thrownError) {
                    if (xhr.status >= 500) {
                        Swal.fire('Error Server', xhr.status + '\n' + thrownError, 'error');
                    }
                
                    else if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        var errorList = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorList += `- ${errors[key]}<br>`;
                            }
                        }
                        Swal.fire('Gagal', errorList, 'warning');
                    }
                
                    else if (xhr.status === 400 || xhr.status === 423) {
                        var message = xhr.responseJSON.message || 'Permintaan tidak valid.';
                        Swal.fire('Gagal', message, 'error');
                    }
                
                    else if (xhr.status === 404) {
                        Swal.fire('Gagal', 'Endpoint tidak ditemukan. Cek URL.', 'error');
                    }
                
                    else if (xhr.status === 419) {
                        Swal.fire('Session Expired', 'Session telah kadaluarsa, silakan refresh halaman.', 'warning');
                    }
                
                    else {
                        Swal.fire('Gagal', 'Terjadi kesalahan yang tidak diketahui.', 'error');
                    }
                }
                
            });
        
            return false;
        });
        
        

    }); 