<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AJK</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/demo_1/style.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/ajk logo-03.png" />
    
  </head>
  <body>
    <div class="container-scroller" mari>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
          <div class="row w-100" style="margin-top: -100px;">
            <div class="col-lg-4 mx-auto text-center">
              <img class="text-center" src="<?= base_url('assets/images/AJK logo-02.png') ?>" width="70%">
              <h2 class="text-center font-weight-bold mb-4 mt-3" style="color: black; font-family: Arial;">Asuransi Jiwa Kredit</h2>
              <div class="auto-form-wrapper">
                <form id="form_login" method="POST" autocomplete="off">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" style="font-size: 15px" id="username" name="username" class="form-control" placeholder="Username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-account mdi-18px"></i>
                        </span>
                      </div>
                      <div class="invalid-feedback mt-1 text-left">
                        Username harus di isi !
                      </div>
                      
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <div class="input-group"> 
                      <input type="password" style="font-size: 15px" id="password" name="password" class="form-control" placeholder="Password">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i style="cursor: pointer;" toggle="#password" class="mdi mdi-eye mdi-18px field-icon toggle-password"></i>
                        </span>
                      </div>
                      <div class="invalid-feedback">
                        Password harus di isi !
                      </div>
                    </div>
                  </div>
                  <div class="form-group text-center">
                    <button class="btn btn-inverse-primary btn-block submit-btn" id="login" type="submit">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/shared/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/shared/misc.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="<?php echo base_url() ?>assets/sweetalert/sweetalert2.js"></script>
    <!-- endinject -->

    <script type="text/javascript">

        function fieldReq(field) {
          $('#'+field).addClass('is-invalid');
          $('#'+field).focus();
        }

        function onInput(field) {
            $('#'+field).on('input',function(){
                $(this).removeClass('is-invalid');
            });
        }

      $(document).ready(function(){

          // var username = $('#username');
          // var password = $('#password');
          // var tombol = $('#masuk');

          // muncul password
          $(".toggle-password").click(function() {

            $(this).toggleClass("mdi-eye mdi-eye-off");

            var input = $($(this).attr("toggle"));

            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
          });

          $('#form_login').on('submit', function(){

              var username = $('#username').val();
              var password = $('#password').val();

              if (username == "" && password == "") {

                swal({
                      title               : "Peringatan",
                      text                : "Harap isi semua data !",
                      type                : "warning",
                      showConfirmButton   : false,
                      timer               : 800
                  });

                  $('#username').focus();
                  
              } else if (username == "") {

                swal({
                      title               : "Peringatan",
                      text                : "Harap isi username!",
                      type                : "warning",
                      showConfirmButton   : false,
                      timer               : 800
                  });

                  $('#username').focus();
                  
              }else if (password == "") {

                swal({
                      title               : "Peringatan",
                      text                : "Harap isi password!",
                      type                : "warning",
                      showConfirmButton   : false,
                      timer               : 800
                  });

                return false;

              }else{
                $.ajax({
                    type        : 'POST',
                    url         : 'C_login/cek_login',
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses Data',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    dataType    : 'json',
                    data        : {
                        username : username,
                        password : password
                    },
                    success: function(data){
                        console.log(data.hasil);

                        if(data.hasil == 'username tidak ditemukan'){
                            swal({
                              title             : 'Peringatan',
                              text              : "Username tidak ditemukan !",
                              type              : "error",
                              showConfirmButton : false,
                              timer             : 1000
                            });

                            $('#username').val('');
                            $('#password').val('');

                            setTimeout(() => {
                                $('#username').focus();
                            }, 1300);

                        }else if(data.hasil == 'password salah'){

                            $('#password').val('');

                            swal({
                              title             : 'Peringatan',
                              text              : "Password salah !",
                              type              : "error",
                              showConfirmButton : false,
                              timer             : 1000
                            });

                            setTimeout(() => {
                                $('#password').focus();
                            }, 1300);
                            

                        }else{ 

                            window.location = 'C_dashboard';
                            
                        }
                    }
                });
                
                return false;
              }
          });
      });

  </script>


  </body>
</html>