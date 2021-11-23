<style>
    input[type=checkbox] {
        transform: scale(1.4);
    }
</style>
<div class="row">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Tertanggung</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Debitur Tertanggung</li>
            </ol>
        </nav>
    </div>

    <?php $id_level = $this->session->userdata('id_level'); ?>

    <div class="col-md-3">
        <a href="<?= base_url('C_pertanggungan') ?>"><button class="btn mb-3 float-right kembali_satu" style="background-color: #02a4af; color:white;" type="button"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button></a>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <?php if ($id_level == 1 || $id_level == 3) : ?>
                    <form action="<?= base_url('C_pertanggungan/tambah_data_ptg') ?>" method="POST">
                        <input type="hidden" name="id_pks" class="id_pks" value="<?= $id_pks ?>">
                        <input type="hidden" name="id_bpr" class="id_bpr" value="<?= $id_bpr ?>">
                        <input type="hidden" name="nama_bpr" class="nama_bpr" value="<?= $nama_bpr ?>">
                        <input type="hidden" name="nomor_pks" class="nomor_pks" value="<?= $nomor_pks ?>">
                        <button type="submit" class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_pertanggungan">Tambah Data</button>
                    </form>
                <?php else : ?>
                    <input type="hidden" name="id_pks" class="id_pks" value="<?= $id_pks ?>">
                    <input type="hidden" name="id_bpr" class="id_bpr" value="<?= $id_bpr ?>">
                <?php endif; ?>
                <h4 class="font-weight-bold">Debitur Tertanggung</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-sm-6 col-form-label">Nama BPR</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold t_nama_bpr">: <?= $nama_bpr ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-sm-6 col-form-label">Nomor PKS</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold t_nomor_pks">: <?= $nomor_pks ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-sm-6 col-form-label">Total Tertanggung</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold t_total_tertanggung">:</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-sm-6 col-form-label">Total Pertanggungan</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold t_total_pertertanggungan">:</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body table-responsive">
                <?php if ($id_level == 4) : ?>

                    <table class="table table-bordered table-striped tabel_tertanggung_as" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="">Kode Tertanggung</th>
                                <th width="">Nama Tertanggung</th>
                                <th width="">Total Pertanggungan</th>
                                <th width="">Jenis Tanggung</th>
                                <th width="">Jenis Resiko</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                <?php else : ?>
                    <table class="table table-bordered table-striped tabel_tertanggung" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="">Kode Tertanggung</th>
                                <th width="">Nama Tertanggung</th>
                                <th width="">Total Pertanggungan</th>
                                <th width="">Status Tertanggung</th>
                                <th width="">Forward Asuransi</th>
                                <th width="">Dokumen</th>
                                <!-- <th width="">Jenis Resiko</th> -->
                                <!-- <th width="">Status</th> -->
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // menampilkan tabel_tertanggung
        var tabel_tertanggung = $('.tabel_tertanggung').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_data_debitur",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_pks = $('.id_pks').val();
                    data.id_bpr = $('.id_bpr').val();
                },
                "dataSrc": function (json) {
                    $(".t_total_tertanggung").text(": "+json.total_tertanggung+" Debitur"); 
                    $(".t_total_pertertanggungan").text(": "+json.total_pertertanggungan); 
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,4,5,6,7],
                "orderable" : false
            }, {
                'targets'   : [0,4,5,6,7],
                'className' : 'text-center',
            }],
            // "scrollX"           : false,
            //"bDestroy"          : true,
            "initComplete": function (settings, json) {  
                $(".tabel_tertanggung").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },

        })

        var tabel_tertanggung_as = $('.tabel_tertanggung_as').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_data_debitur_as",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_pks = $('.id_pks').val();
                    data.id_bpr = $('.id_bpr').val();
                },
                "dataSrc": function (json) {
                    $(".t_total_tertanggung").text(": "+json.total_tertanggung+" Debitur"); 
                    $(".t_total_pertertanggungan").text(": "+json.total_pertertanggungan); 
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,6],
                "orderable" : false
            }, {
                'targets'   : [0,6],
                'className' : 'text-center',
            }],
            // "scrollX"           : false,
            //"bDestroy"          : true,
            "initComplete": function (settings, json) {  
                $(".tabel_tertanggung").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },

        })

        var tabel_dok_ptg  = $('.tabel_dok_ptg').DataTable({
            "processing"    : true,
            "ajax"          : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_dokumen_ptg",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_ptg = $('#id_ptg').val();
                }
            },
            stateSave       : true,
            "order"         : [[ 0, 'asc' ]],
            "paging"        : false,
            "info"          : false,
            "searching"     : false,
            "columnDefs"     : [{
                "targets"       : [0,1,2,3,4],
                "orderable"     : false
            }, {
                "targets"       : [2,3,4],
                "className"     : "text-center"
            }]
        });

        // 23-03-2021
        $('.tabel_tertanggung').on('click', '.dokumen', function () {

            var id_ptg = $(this).data('id');

            var url = "<?= base_url('C_pertanggungan/kelengkapan_dokumen/') ?>"+id_ptg;

            window.location.href = url;

        })

        // 23-03-2021
        $('.tabel_tertanggung').on('click', '.forward-asuransi', function () {

            var id_ptg  = $(this).data('id');
            var isi     = $(this).attr('isi');
            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan forward asuransi?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Kirim',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url     : "<?= base_url() ?>C_pertanggungan/ubah_forward_asuransi",
                        method  : "POST",
                        data    : {id_ptg:id_ptg, isi:isi},
                        success : function () {

                            tabel_tertanggung.ajax.reload(null, false);
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil dikirimkan ke Asuransi',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            });
                            
                        }
                    })

                    return false;
                    
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan forward asuransi',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })
            

        })

        // 29-03-2021
        $('.tabel_tertanggung').on('click', '.hapus-tanggungan', function () {
                
            var id_tanggungan       = $(this).data('id');
            var kode_tertanggung    = $(this).attr('kode_tertanggung');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data',
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
                        url         : "<?= base_url() ?>C_pertanggungan/hapus_tanggungan",
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
                        data        : {id_tanggungan:id_tanggungan, kode_tertanggung:kode_tertanggung},
                        dataType    : "JSON",
                        success     : function (data) {

                            tabel_tertanggung.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus data',
                                text                : 'Data Tanggungan Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 

                            
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
                            text                : 'Anda membatalkan hapus data tertanggung',
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