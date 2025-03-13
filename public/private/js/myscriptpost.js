
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


    }); 