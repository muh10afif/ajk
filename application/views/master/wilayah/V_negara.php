<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul"  class="font-weight-bold">Tambah Data</h4>
            </div>
            <form id="form_negara" autocomplete="off">
                <input type="hidden" name="id_negara" id="id_negara">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6 offset-md-2">
                        <div class="form-group row">
                            <label for="nama_negara" class="col-sm-4 col-form-label text-right">Nama negara</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_negara" id="nama_negara" placeholder="Masukkan Nama negara">
                                <div class="valid-feedback">
                                
                                </div>
                                <div class="invalid-feedback">
                                    Harap isi nama negara!
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_negara">Simpan</button>
                        <button class="btn btn-danger mt-1" id="batal_negara" type="button" hidden>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_negara">Tambah Data</button>
                <h4 id="judul" class="font-weight-bold">Master Data Negara</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_negara" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Negara</th>
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

        // 19-02-2021
        $('#tambah_negara').on('click', function () {
            
            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });
            
        })

        // 29-04-2020

            // menampilkan list negara
                var tabel_list_negara = $('#tabel_master_negara').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "tampil_data_negara",
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

            // aksi simpan data negara
                $('#simpan_negara').on('click', function () {

                    var form_negara = $('#form_negara').serialize();
                    var nama_negara = $('#nama_negara').val();

                    if (nama_negara == '') {

                        $('#nama_negara').addClass('is-invalid');

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
                                    url     : "simpan_data_negara",
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
                                    data    : form_negara,
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
                        
                                        tabel_list_negara.ajax.reload(null,false);        
                                        
                                        $('#form_negara').trigger("reset");

                                        $('#batal_negara').attr('hidden', true);

                                        $('.hapus-negara').removeAttr('hidden');
                        
                                        $('#aksi').val('Tambah');

                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });

                                        $('#tambah_negara').attr('hidden', false);
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

            // aksi batal negara
                $('#batal_negara').on('click', function () {

                    $('#form_negara').trigger("reset");
                    $('#batal_negara').attr('hidden', true);

                    $('#aksi').val('Tambah');
                    $('.hapus-negara').removeAttr('hidden');

                    $('.f_tambah').slideToggle('fast', function() {
                        if ($(this).is(':visible')) {
                            $('#status_toggle').val(1);          
                        } else {  
                            $('#status_toggle').val(0);            
                        }        
                    });

                    $('#tambah_negara').attr('hidden', false);
                })

            // edit data negara
                $('#tabel_master_negara').on('click', '.edit-negara', function () {

                    $('.hapus-negara').attr('hidden', true);
                    $('#tambah_negara').attr('hidden', true);

                    var sts = $('#status_toggle').val();
                    
                    var id_negara  = $(this).data('id');

                    $.ajax({
                        url         : "ambil_data_negara/"+id_negara,
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
                            
                            $('#id_negara').val(data.id_negara);
                            $('#nama_negara').val(data.nama_negara);

                            $('#aksi').val('Ubah');
                            $('#batal_negara').removeAttr('hidden');

                            $('#nama_negara').attr('autofocus', true);

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

            // hapus negara
                $('#tabel_master_negara').on('click', '.hapus-negara', function () {
                    
                    var id_negara   = $(this).data('id');
                    var sts         = $('#status_toggle').val();
                    var nama        = $(this).attr('nama');

                    swal({
                        title       : 'Konfirmasi',
                        text        : 'Yakin akan hapus negara '+nama+' ?',
                        type        : 'warning',

                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-danger",
                        cancelButtonClass   : "btn btn-primary mr-3",

                        showCancelButton    : true,
                        confirmButtonText   : 'Hapus',
                        confirmButtonColor  : '#3085d6',
                        cancelButtonColor   : '#d33',
                        cancelButtonText    : 'Batal',
                        reverseButtons      : true
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url         : "simpan_data_negara",
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
                                data        : {aksi:'Hapus', id_negara:id_negara},
                                dataType    : "JSON",
                                success     : function (data) {

                                        tabel_list_negara.ajax.reload(null,false);   

                                        swal({
                                            title               : 'Hapus negara',
                                            text                : 'Data Berhasil Dihapus',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        }); 

                                            
                                        
                                        $('#form_negara').trigger("reset");

                                        $('#aksi').val('Tambah');

                                        $('#batal_negara').attr('hidden', true);

                                        $('.hapus-negara').removeAttr('hidden');

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
                                    text                : 'Anda membatalkan hapus negara',
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