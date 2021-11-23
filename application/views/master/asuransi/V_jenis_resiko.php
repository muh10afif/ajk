<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3"><h4 id="judul"  class="font-weight-bold">Tambah Data</h4></div>
            <form id="form_jenis_resiko" autocomplete="off">
                <input type="hidden" name="id_jenis_resiko" id="id_jenis_resiko">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="nama_jenis_resiko" class="col-sm-4 col-form-label text-right">Jenis Resiko</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_jenis_resiko" id="nama_jenis_resiko" placeholder="Masukkan Jenis Resiko">
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="tampil_otomatis" class="col-sm-4 col-form-label text-right">Tampil Otomatis</label>
                            <div class="col-sm-8">
                                <select name="tampil_otomatis" id="tampil_otomatis">
                                    <option value="0" selected>Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_jenis_resiko">Simpan</button>
                        <button class="btn btn-danger mt-1" id="batal_jenis_resiko" type="button" hidden>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_jenis_resiko">Tambah Data</button>
                <h4 id="judul" class="font-weight-bold">Master Data Jenis Resiko</h4></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_jenis_resiko" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Jenis Resiko</th>
                            <th width="20%">Tampil Otomatis</th>
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
        $('#tambah_jenis_resiko').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#form_jenis_resiko').trigger('reset');
            $('#aksi').val('Tambah');
            $('#batal_jenis_resiko').attr('hidden', true);

        })

        // 30-04-2020

            // menampilkan list jenis_resiko
                var tabel_list_jenis_resiko = $('#tabel_master_jenis_resiko').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "tampil_data_jenis_resiko",
                        "type"  : "POST"
                    },

                        "columnDefs"        : [{
                            "targets"   : [0,3],
                            "orderable" : false
                        }, {
                            'targets'   : [0,2,3],
                            'className' : 'text-center',
                        }]

                })

            // aksi simpan data jenis_resiko
                $('#simpan_jenis_resiko').on('click', function () {

                    var form_jenis_resiko = $('#form_jenis_resiko').serialize();
                    var nama_jenis_resiko = $('#nama_jenis_resiko').val();

                    if (nama_jenis_resiko == '') {
                        swal({
                            title               : "Peringatan",
                            text                : 'Nama jenis Resiko harus terisi !',
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
                                    url     : "simpan_data_jenis_resiko",
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
                                    data    : form_jenis_resiko,
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
                        
                                        tabel_list_jenis_resiko.ajax.reload(null,false);        
                                        
                                        $('#form_jenis_resiko').trigger("reset");

                                        $('#batal_jenis_resiko').attr('hidden', true);

                                        $('.hapus-jenis_resiko').removeAttr('hidden');
                        
                                        $('#aksi').val('Tambah');

                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });

                                        $('#tambah_jenis_resiko').attr('hidden', false);
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

            // aksi batal jenis_resiko
                $('#batal_jenis_resiko').on('click', function () {

                    $('#form_jenis_resiko').trigger("reset");
                    $('#batal_jenis_resiko').attr('hidden', true);

                    $('#aksi').val('Tambah');
                    $('.hapus-jenis_resiko').removeAttr('hidden');

                    $('.f_tambah').slideToggle('fast', function() {
                        if ($(this).is(':visible')) {
                            $('#status_toggle').val(1);          
                        } else {  
                            $('#status_toggle').val(0);            
                        }        
                    });

                    $('#tambah_jenis_resiko').attr('hidden', false);
                })

            // edit data jenis_resiko
                $('#tabel_master_jenis_resiko').on('click', '.edit', function () {

                    $('.hapus-jenis_resiko').attr('hidden', true);
                    $('#tambah_jenis_resiko').attr('hidden', true);

                    var sts = $('#status_toggle').val();
                    
                    var id_jenis_resiko  = $(this).data('id');
                    var jenis_resiko     = $(this).attr('jenis_resiko');
                    var sts_tampil       = $(this).attr('tampil_otomatis');

                    $('#id_jenis_resiko').val(id_jenis_resiko);
                    $('#nama_jenis_resiko').val(jenis_resiko);
                    $('#tampil_otomatis').val(sts_tampil).trigger('change');

                    $('#aksi').val('Ubah');
                    $('#batal_jenis_resiko').removeAttr('hidden');

                    $('#nama_jenis_resiko').attr('autofocus', true);

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

            // hapus jenis_resiko
                $('#tabel_master_jenis_resiko').on('click', '.hapus', function () {
                    
                    var id_jenis_resiko     = $(this).data('id');
                    var jenis_resiko        = $(this).attr('jenis_resiko');
                    var sts                 = $('#status_toggle').val();

                    swal({
                        title       : 'Konfirmasi',
                        text        : 'Yakin akan hapus resiko '+jenis_resiko+'?',
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
                                url         : "simpan_data_jenis_resiko",
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
                                data        : {aksi:'Hapus', id_jenis_resiko:id_jenis_resiko},
                                dataType    : "JSON",
                                success     : function (data) {

                                        tabel_list_jenis_resiko.ajax.reload(null,false);   

                                        swal({
                                            title               : 'Hapus Data',
                                            text                : 'Data Berhasil Dihapus',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        }); 

                                        $('#form_jenis_resiko').trigger("reset");

                                        $('#aksi').val('Tambah');

                                        $('#batal_jenis_resiko').attr('hidden', true);

                                        $('.hapus-jenis_resiko').removeAttr('hidden');

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
                                    text                : 'Anda membatalkan hapus jenis resiko',
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