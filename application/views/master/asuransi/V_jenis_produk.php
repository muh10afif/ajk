<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3"><h4 id="judul"  class="font-weight-bold">Tambah Data</h4></div>
            <form id="form_jenis_produk" autocomplete="off">
                <input type="hidden" name="id_jenis_produk" id="id_jenis_produk">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6 offset-md-2">
                        <div class="form-group row">
                            <label for="nama_jenis_produk" class="col-sm-4 col-form-label text-right">Jenis Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" style="font-size: 14px;" name="nama_jenis_produk" id="nama_jenis_produk" placeholder="Masukkan Jenis Produk">
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_jenis_produk">Simpan</button>
                        <button class="btn btn-danger mt-1" id="batal_jenis_produk" type="button" hidden>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_jenis_produk">Tambah Data</button>
                <h4 id="judul" class="font-weight-bold">Master Data Jenis Produk</h4></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_jenis_produk" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Jenis Produk</th>
                            <th width="5%">Aksi</th>
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

    $(document).ready(function() {

        // 21-02-2021
        $('#tambah_jenis_produk').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#form_jenis_produk').trigger('reset');
            $('#aksi').val('Tambah');
            $('#batal_jenis_produk').attr('hidden', true);

        })

        // 30-04-2020

            // menampilkan list jenis_produk
                var tabel_list_jenis_produk = $('#tabel_master_jenis_produk').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "tampil_data_jenis_produk",
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

            // aksi simpan data jenis_produk
                $('#simpan_jenis_produk').on('click', function () {

                    var form_jenis_produk = $('#form_jenis_produk').serialize();
                    var nama_jenis_produk = $('#nama_jenis_produk').val();

                    if (nama_jenis_produk == '') {
                        swal({
                            title               : "Peringatan",
                            text                : 'Nama jenis produk harus terisi !',
                            buttonsStyling      : false,
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;
                    } else {

                        swal({
                            title       : 'Konfirmasi',
                            text        : 'Yakin akan kirim data?',
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
                                    url     : "simpan_data_jenis_produk",
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
                                    data    : form_jenis_produk,
                                    dataType: "JSON",
                                    success : function (data) {
                                        
                                        swal({
                                            title               : "Berhasil",
                                            text                : 'Data berhasil disimpan',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        });    
                        
                                        tabel_list_jenis_produk.ajax.reload(null,false);        
                                        
                                        $('#form_jenis_produk').trigger("reset");

                                        $('#batal_jenis_produk').attr('hidden', true);

                                        $('.hapus-jenis_produk').removeAttr('hidden');
                        
                                        $('#aksi').val('Tambah');

                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });

                                        $('#tambah_jenis_produk').attr('hidden', false);
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

            // aksi batal jenis_produk
                $('#batal_jenis_produk').on('click', function () {

                    $('#form_jenis_produk').trigger("reset");
                    $('#batal_jenis_produk').attr('hidden', true);

                    $('#aksi').val('Tambah');
                    $('.hapus-jenis_produk').removeAttr('hidden');

                    $('.f_tambah').slideToggle('fast', function() {
                        if ($(this).is(':visible')) {
                            $('#status_toggle').val(1);          
                        } else {  
                            $('#status_toggle').val(0);            
                        }        
                    });

                    $('#tambah_jenis_produk').attr('hidden', false);
                })

            // edit data jenis_produk
                $('#tabel_master_jenis_produk').on('click', '.edit', function () {

                    $('.hapus-jenis_produk').attr('hidden', true);
                    $('#tambah_jenis_produk').attr('hidden', true);

                    var sts = $('#status_toggle').val();
                    
                    var id_jenis_produk  = $(this).data('id');
                    var jenis_produk     = $(this).attr('jenis_produk');

                    $('#id_jenis_produk').val(id_jenis_produk);
                    $('#nama_jenis_produk').val(jenis_produk);

                    $('#aksi').val('Ubah');
                    $('#batal_jenis_produk').removeAttr('hidden');

                    $('#nama_jenis_produk').attr('autofocus', true);

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

            // hapus jenis_produk
                $('#tabel_master_jenis_produk').on('click', '.hapus', function () {
                    
                    var id_jenis_produk     = $(this).data('id');
                    var jenis_produk        = $(this).attr('jenis_produk');
                    var sts                 = $('#status_toggle').val();

                    swal({
                        title       : 'Konfirmasi',
                        text        : 'Yakin akan hapus produk '+jenis_produk+'?',
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
                                url         : "simpan_data_jenis_produk",
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
                                data        : {aksi:'Hapus', id_jenis_produk:id_jenis_produk},
                                dataType    : "JSON",
                                success     : function (data) {

                                        tabel_list_jenis_produk.ajax.reload(null,false);   

                                        swal({
                                            title               : 'Hapus Data',
                                            text                : 'Data Berhasil Dihapus',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        }); 

                                        $('#form_jenis_produk').trigger("reset");

                                        $('#aksi').val('Tambah');

                                        $('#batal_jenis_produk').attr('hidden', true);

                                        $('.hapus-jenis_produk').removeAttr('hidden');

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
                                    text                : 'Anda membatalkan hapus jenis produk',
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