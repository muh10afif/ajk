<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3"><h4 id="judul"  class="font-weight-bold">Tambah Data</h4></div>
            <form id="form_provinsi" autocomplete="off">
                <input type="hidden" name="id_provinsi" id="id_provinsi">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-4 offset-md-2">
                        <div class="form-group row">
                            <label for="negara" class="col-sm-4 col-form-label text-right">Negara</label>
                            <label class="col-sm-8 col-form-label font-weight-bold">: Indonesia</label>
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="nama_provinsi" class="col-sm-4 col-form-label text-right">Nama provinsi</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_provinsi" id="nama_provinsi" placeholder="Masukkan Nama provinsi">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_provinsi">Simpan</button>
                    <button class="btn btn-danger mt-1" id="batal_provinsi" type="button" hidden>Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
            <button class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_provinsi">Tambah Data</button>
            <h4 id="judul" class="font-weight-bold">Master Data Provinsi</h4></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_provinsi" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                        <th width="5%">No</th>
                            <th width="20%">Provinsi</th>
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
    $('#tambah_provinsi').on('click', function () {

        $('.f_tambah').slideToggle('fast', function() {
            if ($(this).is(':visible')) {
                $('#status_toggle').val(1);          
            } else {  
                $('#status_toggle').val(0);            
            }        
        });

    })

    // 29-04-2020

        $('#negara').select2('val', ' ');

        // menampilkan list provinsi
            var tabel_list_provinsi = $('#tabel_master_provinsi').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "tampil_data_provinsi",
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

        // aksi simpan data provinsi
            $('#simpan_provinsi').on('click', function () {

                var form_provinsi = $('#form_provinsi').serialize();
                var nama_provinsi = $('#nama_provinsi').val();

                if (nama_provinsi == '') {
                    swal({
                        title               : "Peringatan",
                        text                : 'Nama provinsi harus terisi !',
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
                                url     : "simpan_data_provinsi",
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
                                data    : form_provinsi,
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
                    
                                    tabel_list_provinsi.ajax.reload(null,false);        
                                    
                                    $('#form_provinsi').trigger("reset");

                                    $('#batal_provinsi').attr('hidden', true);

                                    $('.hapus-provinsi').removeAttr('hidden');
                    
                                    $('#aksi').val('Tambah');

                                    $('.f_tambah').slideToggle('fast', function() {
                                        if ($(this).is(':visible')) {
                                            $('#status_toggle').val(1);          
                                        } else {  
                                            $('#status_toggle').val(0);            
                                        }        
                                    });

                                    $('#tambah_provinsi').attr('hidden', false);
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

        // aksi batal provinsi
            $('#batal_provinsi').on('click', function () {

                $('#form_provinsi').trigger("reset");
                $('#batal_provinsi').attr('hidden', true);

                $('#aksi').val('Tambah');
                $('.hapus-provinsi').removeAttr('hidden');

                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });

                $('#tambah_provinsi').attr('hidden', false);
            })

        // edit data provinsi
            $('#tabel_master_provinsi').on('click', '.edit-provinsi', function () {

                $('.hapus-provinsi').attr('hidden', true);
                $('#tambah_provinsi').attr('hidden', true);

                var sts = $('#status_toggle').val();
                
                var id_provinsi  = $(this).data('id');

                $.ajax({
                    url         : "ambil_data_provinsi/"+id_provinsi,
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
                        
                        $('#id_provinsi').val(data.id_provinsi);
                        $('#nama_provinsi').val(data.nama_provinsi);

                        $('#aksi').val('Ubah');
                        $('#batal_provinsi').removeAttr('hidden');

                        $('#nama_provinsi').attr('autofocus', true);

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

        // hapus provinsi
            $('#tabel_master_provinsi').on('click', '.hapus-provinsi', function () {
                
                var id_provinsi = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus provinsi '+nama+' ?',
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
                            url         : "simpan_data_provinsi",
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
                            data        : {aksi:'Hapus', id_provinsi:id_provinsi},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_provinsi.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus provinsi',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_provinsi').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    $('#batal_provinsi').attr('hidden', true);

                                    $('.hapus-provinsi').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus provinsi',
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