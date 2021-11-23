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
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_asuransi">Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold">Data Asuransi</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_asuransi" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Asuransi</th>
                            <th width="20%">Alamat</th>
                            <th width="10%">Email</th>
                            <th width="10%">No Telepon</th>
                            <th width="10%">Singkatan</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_asu" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header text-white" style="background-color: #02a4af">
            <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data Asuransi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
            </button>
        </div>
            <form id="form_asu" autocomplete="off">
                <input type="hidden" name="id_asu" id="id_asu">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="modal-body">
                    <div class="col-md-12 p-3">
                        <div class="form-group row">
                            <label for="nama_bpr" class="col-sm-3 col-form-label">Nama Asuransi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" style="font-size: 14px;" name="nama_asu" id="nama_asu" placeholder="Masukkan Nama Asuransi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="email" id="email" placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kontak" class="col-sm-3 col-form-label">No. Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" style="font-size: 14px;" name="kontak" id="kontak" placeholder="Masukkan No Telepon">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" style="font-size: 14px;" name="alamat" id="alamat" placeholder="Masukkan Nama Alamat" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kontak" class="col-sm-3 col-form-label">Singkatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" style="font-size: 14px;" name="singkatan" id="singkatan" placeholder="Masukkan Singkatan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn text-white" style="background-color: #02a4af" id="simpan_asu">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        
        // 04-02-2021
        var tabel_asuransi = $('#tabel_asuransi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_master/tampil_data_asuransi",
                "type"  : "POST"
            },

            "columnDefs"        : [{
                "targets"   : [0,6],
                "orderable" : false
            }, {
                'targets'   : [0,6],
                'className' : 'text-center',
            }]

        })

        // 09-02-2021
        $('#tambah_asuransi').on('click', function () {
            $('#form_asu').trigger('reset');
            $('#aksi').val('Tambah');
            $('#modal_asu').modal('show');
        })

        // 09-02-2021
        $("#simpan_asu").click(function () {
            let form_asu = $("#form_asu").serialize();
            let nama_asu = $("#nama_asu").val();

            var nama_as     = $('#nama_asu').val();
            var email       = $('#email').val();
            var kontak      = $('#kontak').val();
            var alamat      = $('#alamat').val();
            var singkatan   = $('#singkatan').val();

            if (nama_asu == "" || email == "" || kontak == "" || alamat == "" || singkatan == "") {

                swal({
                    title               : "Peringatan",
                    text                : 'Harap isi semua data !',
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
                        url     : "simpan_data_asu",
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
                        data    : form_asu,
                        dataType: "JSON",
                        success : function (data) {

                            $('#modal_asu').modal('hide');

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            });

                            tabel_asuransi.ajax.reload(null,false);

                            $('#form_asu').trigger("reset");

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

        $("#tabel_asuransi").on('click','.edit-asu', function () {

            var id_asu          = $(this).data('id');
            var nama_asuransi   = $(this).attr('nama_asuransi');
            var email           = $(this).attr('email');
            var no_telepon      = $(this).attr('no_telepon');
            var alamat          = $(this).attr('alamat');
            var singkatan       = $(this).attr('singkatan');

            $('#modal_asu').modal('show');

            $('#id_asu').val(id_asu);

            $('#nama_asu').val(nama_asuransi);
            $('#email').val(email);
            $('#kontak').val(no_telepon);
            $('#alamat').val(alamat);
            $('#singkatan').val(singkatan);

            $('#aksi').val('Ubah');

        });

        $('#tabel_asuransi').on('click', '.hapus-asu', function () {
            var id_asu  = $(this).data('id');

            var nama    = $(this).attr('nama');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus '+nama+' ?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
            if (result.value) {
                $.ajax({
                url         : "simpan_data_asu",
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
                data        : {aksi:'Hapus', id_asu:id_asu},
                dataType    : "JSON",
                success     : function (data) {

                    tabel_asuransi.ajax.reload(null,false);

                    swal({
                        title               : 'Hapus Asuransi',
                        text                : 'Data Berhasil Dihapus',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'success',
                        showConfirmButton   : false,
                        timer               : 1000
                    });

                    $('#form_asu').trigger("reset");

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
                        text                : 'Anda membatalkan hapus data Asuransi',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 1000
                    });
            }
            });
        });
        
    })

</script>