<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card">
            <div class="card-header p-3"><h4 id="judul"  class="font-weight-bold">Tambah Data</h4></div>
            <form id="form_kota_kab" autocomplete="off">
                <input type="hidden" name="id_kota_kab" id="id_kota_kab">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label for="negara" class="col-sm-5 col-form-label text-right">Negara</label>
                            <label class="col-sm-7 col-form-label font-weight-bold text-left">: Indonesia</label>
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label for="provinsi" class="col-sm-4 col-form-label text-right">Provinsi</label>
                            <div class="col-sm-8">
                                <select name="provinsi" id="provinsi" class="form-control" placeholder="Pilih Provinsi">
                                    <?php foreach ($provinsi as $k): ?>
                                        <option value="<?= $k['id_provinsi'] ?>"><?= $k['nama_provinsi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label for="nama_kota_kab" class="col-sm-4 col-form-label text-right">Kota / Kab</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" style="font-size: 14px;" name="nama_kota_kab" id="nama_kota_kab" placeholder="Masukkan Nama Kota / Kab">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-warning mt-1 mr-3" id="simpan_kota_kab">Simpan</button>
                    <button class="btn btn-danger mt-1" id="batal_kota_kab" type="button" hidden>Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_kota_kab">Tambah Data</button>             
                <h4 id="judul" class="font-weight-bold">Master Data Kota / Kabupaten</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" id="tabel_master_kota_kab" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                        <th width="5%">No</th>
                            <th width="20%">Provinsi</th>
                            <th width="20%">Kota / Kabupaten</th>
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
        $('#tambah_kota_kab').on('click', function () {

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

            // menampilkan list kota_kab
                var tabel_list_kota_kab = $('#tabel_master_kota_kab').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "tampil_data_kota_kab",
                        "type"  : "POST"
                    },

                        "columnDefs"        : [{
                            "targets"   : [0,3],
                            "orderable" : false
                        }, {
                            'targets'   : [0,3],
                            'className' : 'text-center',
                        }]

                })

            // aksi simpan data kota_kab
                $('#simpan_kota_kab').on('click', function () {

                    var form_kota_kab = $('#form_kota_kab').serialize();
                    var nama_kota_kab = $('#nama_kota_kab').val();
                    var provinsi      = $('#provinsi').val();

                    if (provinsi == null) {
                        swal({
                            title               : "Peringatan",
                            text                : 'Provinsi harus terisi !',
                            buttonsStyling      : false,
                            type                : 'warning',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;
                    } else if (nama_kota_kab == '') {
                        swal({
                            title               : "Peringatan",
                            text                : 'Nama kota/kab harus terisi !',
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
                                    url     : "simpan_data_kota_kab",
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
                                    data    : form_kota_kab,
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
                        
                                        tabel_list_kota_kab.ajax.reload(null,false);        
                                        
                                        $('#form_kota_kab').trigger("reset");

                                        $('#provinsi').select2('val', ' ');

                                        $('#batal_kota_kab').attr('hidden', true);

                                        $('.hapus-kota-kab').removeAttr('hidden');
                        
                                        $('#aksi').val('Tambah');

                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });

                                        $('#tambah_kota_kab').attr('hidden', false);
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

            // aksi batal kota_kab
                $('#batal_kota_kab').on('click', function () {

                    $('#form_kota_kab').trigger("reset");

                    $('#provinsi').select2('val', ' ');
                    $('#batal_kota_kab').attr('hidden', true);

                    $('#aksi').val('Tambah');
                    $('.hapus-kota-kab').removeAttr('hidden');

                    $('.f_tambah').slideToggle('fast', function() {
                        if ($(this).is(':visible')) {
                            $('#status_toggle').val(1);          
                        } else {  
                            $('#status_toggle').val(0);            
                        }        
                    });

                    $('#tambah_kota_kab').attr('hidden', false);
                })

            // edit data kota_kab
                $('#tabel_master_kota_kab').on('click', '.edit-kota-kab', function () {

                    $('.hapus-kota-kab').attr('hidden', true);
                    $('#tambah_kota_kab').attr('hidden', true);

                    var sts = $('#status_toggle').val();
                    
                    var id_kota_kab  = $(this).data('id');

                    $.ajax({
                        url         : "ambil_data_kota_kab/"+id_kota_kab,
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
                            
                            $('#id_kota_kab').val(data.id_kota_kab);
                            $('#provinsi').val(data.id_provinsi).trigger('change');
                            $('#nama_kota_kab').val(data.nama_kota_kab);

                            $('#aksi').val('Ubah');
                            $('#batal_kota_kab').removeAttr('hidden');

                            $('#nama_kota_kab').attr('autofocus', true);

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

            // hapus kota_kab
                $('#tabel_master_kota_kab').on('click', '.hapus-kota-kab', function () {
                    
                    var id_kota_kab = $(this).data('id');
                    var sts         = $('#status_toggle').val();
                    var nama        = $(this).attr('nama');

                    swal({
                        title       : 'Konfirmasi',
                        text        : 'Yakin akan hapus kota/kab '+nama+' ?',
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
                                url         : "simpan_data_kota_kab",
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
                                data        : {aksi:'Hapus', id_kota_kab:id_kota_kab},
                                dataType    : "JSON",
                                success     : function (data) {

                                        tabel_list_kota_kab.ajax.reload(null,false);   

                                        swal({
                                            title               : 'Hapus kota/kab',
                                            text                : 'Data Berhasil Dihapus',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        }); 

                                            
                                        
                                        $('#form_kota_kab').trigger("reset");

                                        $('#aksi').val('Tambah');

                                        $('#batal_kota_kab').attr('hidden', true);

                                        $('.hapus-kota-kab').removeAttr('hidden');

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

    })

</script>