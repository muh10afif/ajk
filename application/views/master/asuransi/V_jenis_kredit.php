<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3"><h4 id="judul"  class="font-weight-bold">Tambah Data</h4></div>
            <form id="form_jenis_kredit" autocomplete="off">
                <input type="hidden" name="id_jenis_kredit" id="id_jenis_kredit">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6 offset-md-2">
                        <div class="form-group row">
                            <label for="nama_jenis_kredit" class="col-sm-4 col-form-label text-right">Jenis Kredit</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_jenis_kredit" id="nama_jenis_kredit" placeholder="Masukkan Jenis Kredit">
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_jenis_kredit">Simpan</button>
                        <button class="btn btn-danger mt-1" id="batal_jenis_kredit" type="button" hidden>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_jenis_kredit">Tambah Data</button>
                <h4 id="judul" class="font-weight-bold">Master Data Jenis Kredit</h4></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_jenis_kredit" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Jenis Kredit</th>
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
        $('#tambah_jenis_kredit').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#form_jenis_kredit').trigger('reset');
            $('#aksi').val('Tambah');
            $('#batal_jenis_kredit').attr('hidden', true);

        })

        // 30-04-2020

            // menampilkan list jenis_kredit
                var tabel_list_jenis_kredit = $('#tabel_master_jenis_kredit').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "tampil_data_jenis_kredit",
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

            // aksi simpan data jenis_kredit
                $('#simpan_jenis_kredit').on('click', function () {

                    var form_jenis_kredit = $('#form_jenis_kredit').serialize();
                    var nama_jenis_kredit = $('#nama_jenis_kredit').val();

                    if (nama_jenis_kredit == '') {
                        swal({
                            title               : "Peringatan",
                            text                : 'Nama jenis kredit harus terisi !',
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
                                    url     : "simpan_data_jenis_kredit",
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
                                    data    : form_jenis_kredit,
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
                        
                                        tabel_list_jenis_kredit.ajax.reload(null,false);        
                                        
                                        $('#form_jenis_kredit').trigger("reset");

                                        $('#batal_jenis_kredit').attr('hidden', true);

                                        $('.hapus-jenis_kredit').removeAttr('hidden');
                        
                                        $('#aksi').val('Tambah');

                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });

                                        $('#tambah_jenis_kredit').attr('hidden', false);
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

            // aksi batal jenis_kredit
                $('#batal_jenis_kredit').on('click', function () {

                    $('#form_jenis_kredit').trigger("reset");
                    $('#batal_jenis_kredit').attr('hidden', true);

                    $('#aksi').val('Tambah');
                    $('.hapus-jenis_kredit').removeAttr('hidden');

                    $('.f_tambah').slideToggle('fast', function() {
                        if ($(this).is(':visible')) {
                            $('#status_toggle').val(1);          
                        } else {  
                            $('#status_toggle').val(0);            
                        }        
                    });

                    $('#tambah_jenis_kredit').attr('hidden', false);
                })

            // edit data jenis_kredit
                $('#tabel_master_jenis_kredit').on('click', '.edit-jenis_kredit', function () {

                    $('.hapus-jenis_kredit').attr('hidden', true);
                    $('#tambah_jenis_kredit').attr('hidden', true);

                    var sts = $('#status_toggle').val();
                    
                    var id_jenis_kredit  = $(this).data('id');

                    $.ajax({
                        url         : "ambil_data_jenis_kredit/"+id_jenis_kredit,
                        type        : "GET",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        dataType    : "JSON",
                        success     : function(data)
                        {
                            swal.close();
                            
                            $('#id_jenis_kredit').val(data.id_jenis_kredit);
                            $('#nama_jenis_kredit').val(data.jenis_kredit);

                            $('#aksi').val('Ubah');
                            $('#batal_jenis_kredit').removeAttr('hidden');

                            $('#nama_jenis_kredit').attr('autofocus', true);

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

                            return false;
                
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    })

                    return false;

                })

            // hapus jenis_kredit
                $('#tabel_master_jenis_kredit').on('click', '.hapus-jenis_kredit', function () {
                    
                    var id_jenis_kredit     = $(this).data('id');
                    var sts                 = $('#status_toggle').val();

                    var nama                = $(this).attr('nama');

                    swal({
                        title       : 'Konfirmasi',
                        text        : 'Yakin akan hapus data '+nama+' ?',
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
                                url         : "simpan_data_jenis_kredit",
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
                                data        : {aksi:'Hapus', id_jenis_kredit:id_jenis_kredit},
                                dataType    : "JSON",
                                success     : function (data) {

                                        tabel_list_jenis_kredit.ajax.reload(null,false);   

                                        swal({
                                            title               : 'Hapus Data',
                                            text                : 'Data Berhasil Dihapus',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        }); 

                                            
                                        
                                        $('#form_jenis_kredit').trigger("reset");

                                        $('#aksi').val('Tambah');

                                        $('#batal_jenis_kredit').attr('hidden', true);

                                        $('.hapus-jenis_kredit').removeAttr('hidden');

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
                                    text                : 'Anda membatalkan hapus jenis kredit',
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