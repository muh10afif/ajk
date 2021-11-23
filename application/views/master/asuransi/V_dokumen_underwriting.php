<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul"  class="font-weight-bold">Tambah Data</h4>
            </div>
            <form id="form_dok_udw" autocomplete="off" method="post">
                <input type="hidden" name="id_dok_udw" id="id_dok_udw">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6 offset-md-2">
                        <div class="form-group row">
                            <label for="nama_dok_udw" class="col-sm-4 col-form-label text-right">Nama Dokumen</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" style="font-size: 14px;" name="nama_dok_udw" id="nama_dok_udw" placeholder="Masukkan Nama Dokumen">
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_dok_udw">Simpan</button>
                        <button class="btn btn-danger mt-1" id="batal_dok_udw" type="button" hidden>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_dok_udw">Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold">Dokumen Underwriting</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_dok_udw" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Dokumen</th>
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

        // 19-02-2021
        $('#tambah_dok_udw').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#form_dok_udw').trigger('reset');
            $('#aksi').val('Tambah');
            $('#batal_dok_udw').attr('hidden', true);

        })
        
        // 04-02-2021
        var tabel_dok_udw = $('#tabel_dok_udw').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_master/tampil_dok_udw",
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
        $('#simpan_dok_udw').on('click', function () {

            var form_dok_udw    = $('#form_dok_udw').serialize();
            var nama_dok_udw    = $('#nama_dok_udw').val();

            if (nama_dok_udw == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Nama Dokumen harus terisi !',
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
                            url     : "simpan_data_dok_udw",
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
                            data    : form_dok_udw,
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

                                    $('#modal_dok_udw').modal('hide');
                                    
                                    swal({
                                        title               : "Berhasil",
                                        text                : 'Data berhasil disimpan',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });    
                    
                                    tabel_dok_udw.ajax.reload(null,false);        
                                    
                                    $('#form_dok_udw').trigger("reset");
                    
                                    $('#aksi').val('Tambah');

                                    $('.f_tambah').slideToggle('fast', function() {
                                        if ($(this).is(':visible')) {
                                            $('#status_toggle').val(1);          
                                        } else {  
                                            $('#status_toggle').val(0);            
                                        }        
                                    });

                                    $('#tambah_dok_udw').attr('hidden', false);

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

        $('#batal_dok_udw').on('click', function () {

            $('#form_dok_udw').trigger("reset");
            $('#batal_dok_udw').attr('hidden', true);

            $('#aksi').val('Tambah');
            $('.hapus').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_dok_udw').attr('hidden', false);
        })

        // edit data bpr
        $('#tabel_dok_udw').on('click', '.edit', function () {

            var id_dok_udw      = $(this).data('id');
            var jenis_dok_udw   = $(this).attr('jenis_dokumen');

            $('.hapus').attr('hidden', true);
            $('#tambah_dok_udw').attr('hidden', true);
            var sts = $('#status_toggle').val();
                    
            $('#id_dok_udw').val(id_dok_udw);

            $('#nama_dok_udw').val(jenis_dok_udw);

            $('#aksi').val('Ubah');

            $('#batal_dok_udw').removeAttr('hidden');

            $('#nama_dok_udw').attr('autofocus', true);

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

        // hapus bpr
        $('#tabel_dok_udw').on('click', '.hapus', function () {

            var id_dok_udw      = $(this).data('id');
            var jenis_dok_udw   = $(this).attr('jenis_dokumen');

            var sts             = $('#status_toggle').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data '+jenis_dok_udw+'?',
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
                        url         : "simpan_data_dok_udw",
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
                        data        : {aksi:'Hapus', id_dok_udw:id_dok_udw},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_dok_udw.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus Data',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 
                                
                                $('#form_dok_udw').trigger("reset");

                                $('#aksi').val('Tambah');

                                $('#batal_dok_udw').attr('hidden', true);

                                $('.hapus').removeAttr('hidden');

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