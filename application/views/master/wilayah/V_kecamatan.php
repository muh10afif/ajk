<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3"><h4 id="judul"  class="font-weight-bold">Tambah Data</h4></div>
            <form id="form_kecamatan" autocomplete="off">
                <input type="hidden" name="id_kecamatan" id="id_kecamatan">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="negara" class="col-sm-3 col-form-label text-left">Negara</label>
                            <label for="negara" class="col-sm-9 col-form-label text-left font-weight-bold">: Indonesia</label>
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="provinsi" class="col-sm-3 col-form-label text-left">Provinsi</label>
                            <div class="col-sm-9">
                                <select name="provinsi" id="provinsi" class="form-control" placeholder="Pilih Provinsi">
                                    <?php foreach ($provinsi as $k): ?>
                                        <option value="<?= $k['id_provinsi'] ?>"><?= $k['nama_provinsi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="kota_kab" class="col-sm-3 col-form-label text-left">Kota / Kabupaten</label>
                            <div class="col-sm-9">
                                <select name="kota_kab" id="kota_kab" class="form-control" placeholder="Pilih Kota / Kabupaten">
                                </select>
                                <div id="loading_kota_kab" style="margin-top: 0px;"  align='left'>
                                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                </div>
                            </div>
                        </div>  
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="kecamatan" class="col-sm-3 col-form-label text-left">Kecamatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" style="font-size: 14px;" name="kecamatan" id="kecamatan" placeholder="Masukkan Nama Kecamatan">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_kecamatan">Simpan</button>
                    <button class="btn btn-danger mt-1" id="batal_kecamatan" type="button" hidden>Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_kec">Tambah Data</button>  
                <h4 id="judul" class="font-weight-bold">Master Data Kecamatan</h4></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_kecamatan" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Provinsi</th>
                            <th width="20%">Kota / Kabupaten</th>
                            <th width="20%">Kecamatan</th>
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

<input type="hidden" name="id_kota_kab_edit" id="id_kota_kab_edit">

<script>

    $(document).ready(function() {

        // 20-02-2021
        $('#tambah_kec').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })

        // 29-04-2020

            $('#provinsi').select2('val', ' ');

            // menampilkan list kecamatan
                var tabel_list_kecamatan = $('#tabel_master_kecamatan').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "tampil_data_kecamatan",
                        "type"  : "POST"
                    },

                        "columnDefs"        : [{
                            "targets"   : [0,4],
                            "orderable" : false
                        }, {
                            'targets'   : [0,4],
                            'className' : 'text-center',
                        }]

                })

            // aksi simpan data kecamatan
                $('#simpan_kecamatan').on('click', function () {

                    var form_kecamatan = $('#form_kecamatan').serialize();
                    var nama_kecamatan = $('#nama_kecamatan').val();
                    var kota_kab       = $('#kota_kab').val();

                    if (kota_kab == null) {
                        swal({
                            title               : "Peringatan",
                            text                : 'Kota/Kab harus terisi !',
                            buttonsStyling      : false,
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;
                    } else if (nama_kecamatan == '') {
                        swal({
                            title               : "Peringatan",
                            text                : 'Nama Kecamatan harus terisi !',
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
                                    url     : "simpan_data_kecamatan",
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
                                    data    : form_kecamatan,
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
                        
                                        tabel_list_kecamatan.ajax.reload(null,false);        
                                        
                                        $('#form_kecamatan').trigger("reset");

                                        $('#provinsi').select2('val', ' ');

                                        $('#batal_kecamatan').attr('hidden', true);

                                        $('.hapus-kecamatan').removeAttr('hidden');
                        
                                        $('#aksi').val('Tambah');

                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });

                                        $('#tambah_kec').attr('hidden', false);
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

            // aksi batal kecamatan
                $('#batal_kecamatan').on('click', function () {

                    $('#form_kecamatan').trigger("reset");

                    $('#provinsi').select2('val', ' ');
                    $('#batal_kecamatan').attr('hidden', true);

                    $('#aksi').val('Tambah');
                    $('.hapus-kecamatan').removeAttr('hidden');

                    $('.f_tambah').slideToggle('fast', function() {
                        if ($(this).is(':visible')) {
                            $('#status_toggle').val(1);          
                        } else {  
                            $('#status_toggle').val(0);            
                        }        
                    });

                    $('#tambah_kec').attr('hidden', false);
                })

            // edit data kecamatan
                $('#tabel_master_kecamatan').on('click', '.edit-kecamatan', function () {

                    $('.hapus-kecamatan').attr('hidden', true);
                    $('#tambah_kec').attr('hidden', true);

                    var sts = $('#status_toggle').val();
                    
                    var id_kecamatan  = $(this).data('id');

                    $.ajax({
                        url         : "ambil_data_kecamatan/"+id_kecamatan,
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

                            $('#id_kecamatan').val(data.id_kecamatan);
                            $('#provinsi').val(data[0].id_provinsi).trigger('change');
                            $('#kecamatan').val(data.nama_kecamatan);

                            $('#aksi').val('Ubah');
                            $('#batal_kecamatan').removeAttr('hidden');

                            $('#nama_kecamatan').attr('autofocus', true);
                            
                            $('#kota_kab').next('.select2-container').hide();
                            $('#loading_kota_kab').show();
                            
                            $('#id_kota_kab_edit').val(data.id_kota_kab);

                            var id_kota_kab = $('#id_kota_kab_edit').val();
                            var id_provinsi = data[0].id_provinsi;

                            $.ajax({
                                url     : "ambil_option_kota_kab",
                                type    : "POST",
                                data    : {id_provinsi:id_provinsi, id_kota_kab:id_kota_kab},
                                dataType: "JSON",
                                success : function (data) {
                                    
                                    $('#kota_kab').html(data.kab_kota);

                                    $('#id_kota_kab_edit').val('');

                                    // $('#kota_kab').val(id_kota_kab).trigger('change');

                                }
                            })

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
                
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    })

                    return false;

                })

            // hapus kecamatan
                $('#tabel_master_kecamatan').on('click', '.hapus-kecamatan', function () {
                    
                    var id_kecamatan    = $(this).data('id');
                    var sts             = $('#status_toggle').val();
                    
                    var nama            = $(this).attr('nama');

                    swal({
                        title       : 'Konfirmasi',
                        text        : 'Yakin akan hapus kecamatan '+nama+' ?',
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
                                url         : "simpan_data_kecamatan",
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
                                data        : {aksi:'Hapus', id_kecamatan:id_kecamatan},
                                dataType    : "JSON",
                                success     : function (data) {

                                        tabel_list_kecamatan.ajax.reload(null,false);   

                                        swal({
                                            title               : 'Hapus kecamatan',
                                            text                : 'Data Berhasil Dihapus',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        }); 

                                            
                                        
                                        $('#form_kecamatan').trigger("reset");

                                        $('#provinsi').select2('val', ' ');

                                        $('#aksi').val('Tambah');

                                        $('#batal_kecamatan').attr('hidden', true);

                                        $('.hapus-kecamatan').removeAttr('hidden');

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
                                    text                : 'Anda membatalkan hapus kota/kab',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    type                : 'error',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 
                        }
                    })

                })

                $('#loading_kota_kab').hide();

            // aksi menampilkan kota/kab sesuai provinsi
                $('#provinsi').on('change', function () {

                    var id_provinsi = $(this).val();
                    var id_kota_kab = $('#id_kota_kab_edit').val();
                    var aksi        = $('#aksi').val();

                    console.log('ss '+id_kota_kab);
                    
                    $('#kota_kab').next('.select2-container').hide();
                    $('#loading_kota_kab').show();

                    $.ajax({
                        url     : "ambil_option_kota_kab",
                        type    : "POST",
                        data    : {id_provinsi:id_provinsi, id_kota_kab:id_kota_kab},
                        dataType: "JSON",
                        success : function (data) {
                            
                            $('#loading_kota_kab').hide();
                            $('#kota_kab').next('.select2-container').show();
                            $('#kota_kab').html(data.kab_kota);

                            // if (aksi == 'Tambah') {
                            //     $('#kota_kab').select2('val', ' ');
                            // }
                        }
                    })
                    
                })

    })

</script>