<style>
    @media (min-width: 1200px) {
    .modal {
            width: 50%; 
            left: 25%;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_user">Tambah Data</button>

                <h4 id="judul" class="font-weight-bold">Register User</h4>
            </div>
            <div class="card-body table-responsive">

                <div class="form-group d-flex justify-content-center">
                    <label for="no_spk" class="col-sm-2 col-form-label">Level User</label>
                    <div class="col-sm-4">
                        <select name="level" id="level" data-allow-clear="true" placeholder="Pilih">
                            <option value=""></option>
                            <?php foreach ($level as $l): ?>
                                <option value="<?= $l['id_level'] ?>"><?= ucwords($l['level']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" id="gif_1" width="30%" hidden>
                </div>
                <table class="table table-bordered table-hover" id="tabel_register" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>PIC</th>
                            <th>Nama Instansi</th>
                            <th>Level User</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_user" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #02a4af">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form id="form_user" autocomplete="off">
            <input type="hidden" name="id_user" id="id_user">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="form-group row p-2">
                    <label for="nama_bpr" class="col-sm-3 col-form-label">Level User</label>
                    <div class="col-sm-9">
                        <select name="level_user" id="level_user" data-allow-clear="true" placeholder="Pilih">
                            <option value=""></option>
                            <?php foreach ($level_2 as $l): ?>
                                <option value="<?= $l['id_level'] ?>"><?= ucwords($l['level']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row p-2">
                    <label for="bpr_asuransi" class="col-sm-3 col-form-label t_nama">Nama BPR/Asuransi</label>
                    <div class="col-sm-9 gif" hidden>
                        <div class="row d-flex justify-content-center" >
                            <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="30%">
                        </div>
                    </div>
                    <div class="col-sm-9 nama_bpr_asuransi">
                        <select name="bpr_asuransi" id="bpr_asuransi"  data-allow-clear="true" placeholder="Pilih">
                            
                        </select>
                    </div>
                </div>

                <div class="form-group row p-2">
                    <label for="kontak" class="col-sm-3 col-form-label">Nama PIC</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" style="font-size: 14px;" name="nama_pic" id="nama_pic" placeholder="Masukkan Nama PIC">
                    </div>
                </div>
                <div class="form-group row p-2">
                    <label for="kontak" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" style="font-size: 14px;" name="username" id="username" placeholder="Masukkan Username">
                    </div>
                </div>
                  <div class="form-group row p-2">
                      <label for="kontak" class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                          <input type="password" class="form-control" style="font-size: 14px;" name="password" id="password" placeholder="Masukkan Password">
                      </div>
                  </div>
                  <div class="form-group row p-2 status" hidden>
                      <label for="status" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0" selected>Non Aktif</option>
                        </select>
                      </div>
                  </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn text-white" style="background-color: #02a4af" id="simpan_user">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        var tabel_register  = $('#tabel_register').DataTable({
            "processing"    : true,
            "ajax"              : {
                "url"   : "C_register_user/tampil_data_use",
                "type"  : "POST",
                "data"  : function (data) {
                            data.level = $('#level').val();
                        }
            },
            stateSave       : true,
            "order"         : [[ 0, 'asc']],
            "columnDefs"     : [{
                "targets"       : [0,6],
                "orderable"     : false
            }, {
                "targets"       : [0,5,6],
                "className"     : "text-center"
            }]
        });

        // 03-02-2021
        $('#tambah_user').on('click', function () {

            $('#modal_user').modal('show');

            $('#level_user').val('').trigger("change");

            $('#aksi').val('Tambah');

        })

        // $.ajax({
        //   type:"GET",
        //   url : "C_register_user/leveldata",
        //   contentType:"application/json",
        //   dataType: "json",
        //   success:function(res) {
        //     let isi = '<option data-display="level">- Level User -</option>';
        //     for (var i = 0; i < res.length; i++) {
        //       isi = isi+'<option value="'+res[i]['id_level']+'">'+res[i]['level']+'</option>';
        //     }
        //     $("#level_user").html(isi);
        //     $("#level").html(isi);
        //   }
        // });

        // $.ajax({
        //   type:"GET",
        //   url : "C_register_user/bprdata",
        //   contentType:"application/json",
        //   dataType: "json",
        //   success:function(res) {
        //     let isi = '<option data-display="bpr">- BPR -</option>';
        //     for (var i = 0; i < res.length; i++) {
        //       isi = isi+'<option value="'+res[i]['id_bpr']+'">'+res[i]['nama_bpr']+'</option>';
        //     }
        //     $("#bpr_asuransi").html(isi);
        //   }
        // });

        // 07-02-2021
        $('#level').on('change', function () {

            tabel_register.ajax.reload(null, false);

        })

        // 10-02-2021
        $('#level_user').on('change', function () {

            var level       = $(this).find(":selected").text();
            var id_level    = $(this).val();
            var aksi        = $('#aksi').val();

            if (level == '') {
                level = 'BPR/Asuransi';
            }

            $('.t_nama').text('Nama '+level);

            $('.nama_bpr_asuransi').attr('hidden', true);
            $('.gif').attr('hidden', false);

            // ambil umkm
            $.ajax({
                url     : "C_register_user/ambil_bpr_asuransi",
                method  : "POST",
                data    : {id_level:id_level},
                dataType: "JSON",
                success : function (data) {

                    $('.nama_bpr_asuransi').attr('hidden', false);
                    $('.gif').attr('hidden', true);

                    $('#bpr_asuransi').html(data.option);
                }
            })

            return false;
            
        })

        $("#simpan_user").click(function () {
            let form_user   = $("#form_user").serialize();
            var level_user  = $("#level_user").val();
            var bpr_asuransi= $("#bpr_asuransi").val();
            var nama_pic    = $("#nama_pic").val();
            var username    = $("#username").val();
            var password    = $("#password").val();
            var aksi        = $("#aksi").val();

            if (aksi == 'Ubah') {
                if (password == '') {
                    password = 'a';
                }
            }

            if (level_user == "" || bpr_asuransi == "" || nama_pic == "" || username == "" || password == "") {

                swal({
                    title               : "Peringatan",
                    text                : 'Lengkapi semua data!',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
                });
                
                return false;
                
            } else {
                swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan kirim data',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-warning mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "C_register_user/simpan_data_user",
                            type    : "POST",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data    : form_user,
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_user').modal('hide');

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });

                                tabel_register.ajax.reload(null,false);

                                $('#form_user').trigger("reset");

                                $('#aksi').val('Tambah');

                            }
                        })

                        return false;
                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                            title               : "Batal",
                            text                : 'Anda membatalkan simpan data',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        });

                    }
                });
            }
        });

        $("#tabel_register").on('click','.edit', function () {

            var level_user  = $(this).attr('level_user');
            var nama_pic    = $(this).attr('nama_pic');
            var username    = $(this).attr('username');
            var password    = $(this).attr('password');

            $('#modal_user').modal('show');

            $('#id_asu').val(data[0]['id_user']);

            $('#reg_usern').val(data[0]['username']);

            $('#nama_pic').val(data[0]['nama_lengkap']);
            $('#emaill').val(data[0]['email']);
            $('#kntak').val(data[0]['kontak']);

            $('#aksi').val('Ubah');
            
        });

        $('#tabel_register').on('click', '.hapus', function () {

            var id_user = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "C_register_user/simpan_data_user",
                        method      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {aksi:'Hapus', id_user:id_user},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_register.ajax.reload(null,false);

                                swal({
                                    title               : 'Hapus User',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });

                                $('#form_user').trigger("reset");
                                $('#level_user').val('').trigger("change");

                                $('#aksi').val('Tambah');

                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus Bpr',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        });
                }
            })

        })

    })

</script>
