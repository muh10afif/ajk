<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul"  class="font-weight-bold">Tambah Data</h4>
            </div>
            <form id="form_status_udw" method="post" autocomplete="off">
                <input type="hidden" name="id_status_udw" id="id_status_udw">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6 offset-md-2">
                        <div class="form-group row">
                            <label for="status_udw" class="col-sm-4 col-form-label text-right">Status Underwriting</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" style="font-size: 14px;" name="status_udw" id="status_udw" placeholder="Masukkan Status">
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_status_udw">Simpan</button>
                        <button class="btn btn-danger mt-1" id="batal_status_udw" type="button" hidden>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_status_udw">Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold">Status Underwriting</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_status_udw" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Status Underwriting</th>
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

<script>

    $(document).ready(function () {

        // 21-02-2021
        $('#tambah_status_udw').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#form_status_udw').trigger('reset');
            $('#aksi').val('Tambah');
            $('#batal_status_udw').attr('hidden', true);

        })
        
        // 05-02-2021
        var tabel_status_udw = $('#tabel_status_udw').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_master/tampil_status_udw",
                "type"  : "POST"
            },

            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            }]

        })

        // aksi simpan data bpr
        $('#simpan_status_udw').on('click', function () {

            var form_status_udw    = $('#form_status_udw').serialize();
            var nama_status_udw    = $('#status_udw').val();

            if (nama_status_udw == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Status harus terisi !',
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
                            url     : "simpan_data_status_udw",
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
                            data    : form_status_udw,
                            dataType: "JSON",
                            success : function (data) {

                                if (data.status == 'ada') {

                                    swal({
                                        title               : "Gagal",
                                        text                : 'Data sudah ada, harap ganti',
                                        buttonsStyling      : false,
                                        type                : 'error',
                                        showConfirmButton   : false,
                                        timer               : 5000
                                    }); 
                                    
                                } else {

                                    $('#modal_status_udw').modal('hide');
                                    
                                    swal({
                                        title               : "Berhasil",
                                        text                : 'Data berhasil disimpan',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });    
                    
                                    tabel_status_udw.ajax.reload(null,false);        
                                    
                                    $('#form_status_udw').trigger("reset");
                    
                                    $('#aksi').val('Tambah');

                                    $('.f_tambah').slideToggle('fast', function() {
                                        if ($(this).is(':visible')) {
                                            $('#status_toggle').val(1);          
                                        } else {  
                                            $('#status_toggle').val(0);            
                                        }        
                                    });

                                    $('#tambah_status_udw').attr('hidden', false);

                                }
                                
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
                })

                return false;

            }

        })

        $('#batal_status_udw').on('click', function () {

            $('#form_status_udw').trigger("reset");
            $('#batal_status_udw').attr('hidden', true);

            $('#aksi').val('Tambah');
            $('.hapus').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_status_udw').attr('hidden', false);

        })

        // edit data bpr
        $('#tabel_status_udw').on('click', '.edit', function () {

            var id_status_udw      = $(this).data('id');
            var nama_status_udw   = $(this).attr('status');

            $('.hapus').attr('hidden', true);
            $('#tambah_status_udw').attr('hidden', true);
            var sts = $('#status_toggle').val();
                    
            $('#id_status_udw').val(id_status_udw);

            $('#status_udw').val(nama_status_udw);

            $('#aksi').val('Ubah');
            $('#batal_status_udw').removeAttr('hidden');

            $('#status_udw').attr('autofocus', true);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 0) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }

        })

        // hapus
        $('#tabel_status_udw').on('click', '.hapus', function () {

            var id_status_udw       = $(this).data('id');
            var nama_status_udw     = $(this).attr('status');

            var sts                 = $('#status_toggle').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data '+nama_status_udw+'?',
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
                        url         : "simpan_data_status_udw",
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
                        data        : {aksi:'Hapus', id_status_udw:id_status_udw},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_status_udw.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus Data',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                
                                $('#form_status_udw').trigger("reset");

                                $('#aksi').val('Tambah');

                                if (sts == 1) {
                                    $('.f_tambah').slideToggle('fast', function() {
                                        if ($(this).is(':visible')) {
                                            $('#status_toggle').val(1);          
                                        } else {  
                                            $('#status_toggle').val(0);            
                                        }        
                                    });  
                                }
                            
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
                            text                : 'Anda membatalkan hapus data',
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