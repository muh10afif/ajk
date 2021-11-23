<style>

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #eb5905;
        background-color: #eb5905;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #eb5905;
        border-color: #eb5905 #eb5905 #eb5905;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #eb5905;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #eb5905;
    }
    .nav-tabs {
        border-bottom: 3px solid #eb5905;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

    input[type=checkbox] {
        transform: scale(1.4);
    }

</style>

<div class="row f_tiga">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item" style="color: #02a4af">Detail Debitur Tertanggung</li>
                <li class="breadcrumb-item active" aria-current="page">Kelengkapan Dokumen</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <form action="<?= base_url('C_pertanggungan/lihat_debitur_ptg') ?>" method="POST">
            <input type="hidden" name="id_pks" value="<?= $id_pks ?>">
            <input type="hidden" name="id_bpr" value="<?= $id_bpr ?>">
            <input type="hidden" name="nama_bpr" class="nama_bpr" value="<?= $nama_bpr ?>">
            <input type="hidden" name="nomor_pks" class="nomor_pks" value="<?= $nomor_pks ?>">
            <button class="btn mb-3 float-right kembali_dua" style="background-color: #02a4af; color:white;" type="submit"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
        </form>
    </div>

    <div class="col-md-12">
        
        <form id="form_dokumen_cbc" action="<?= base_url('C_pertanggungan/simpan_validasi_dok') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="card">
                <div class="card-body table-responsive">
                    <?php if ($lengkap_dok == 1 || $lengkap_dok == 5) : ?>
                        <?php if ($valid_dok == 1) : ?>
                            <div class="alert alert-success">
                                <strong>Sukses!</strong> Semua dokumen telah tervalidasi.
                            </div>
                        <?php else : ?>
                            <div class="alert alert-warning">
                                <strong>Harap lakukan validasi!</strong> Semua dokumen telah terupload.
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($lengkap_dok == 4 || $lengkap_dok == 5) {
                        $dis = 'disabled';
                    } else {
                        $dis = '';
                    } ?>

                    <input type="hidden" name="id_ptg" id="id_ptg" value="<?= $id_ptg ?>">
                    <h4 class="font-weight-bold mb-3 mt-0">Dokumen Tertanggung</h4>
                    <table class="table table-bordered table-striped tabel_dok_ptg aksi_hapus" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="40%">Nama Dokumen</th>
                                <th width="20%">Aksi</th>
                                <th width="10%">File</th>
                                <th width="10%">Validasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <h4 class="font-weight-bold mb-3 mt-3">Dokumen CBC</h4>
                    <div class="row mt-3 nav_awal_klausal">
                        <div class="col-md-2 nav_klausal">
                            <ul class="nav nav-pills flex-column text-center" id="myTab" role="tablist">
                                <?php $it=0; foreach ($jenis_ptg as $t):
                                    // $tjenis = strtolower($t['jenis_tanggung']);
                                    $tjenis = $t['id_jenis_tanggung'];
                                ?>
                                    <li class="nav-item nav_jenis nav_<?= $tjenis ?>">
                                        <a class="nav-link jenis_aktif jenis_aktif_<?= $tjenis ?> <?= ($it == 0) ? 'active' : '' ?>" id="nav<?= $tjenis ?>tab" data-toggle="tab" href="#nav<?= $tjenis ?>" role="tab" aria-controls="nav<?= $tjenis ?>" aria-selected="true" style="font-size: 17px;"><?= strtoupper($t['jenis_tanggung']) ?></a>
                                    </li>
                                <?php $it++; endforeach; ?>
                            </ul>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content" id="myTab1">
                                <?php $iit=0; foreach ($jenis_ptg as $tt):
                                    // $tjenis1    = strtolower($tt['jenis_tanggung']);
                                    $tjenis1    = $tt['id_jenis_tanggung'];
                                    $id_tjenis1 = $tt['id_jenis_tanggung'];
                                    ?>

                                    <div class="tab-pane fade <?= ($iit == 0) ? 'show active' : '' ?> jenis_tab tab_<?= $tjenis1 ?>" id="nav<?= $tjenis1 ?>" role="tabpanel" aria-labelledby="nav<?= $tjenis1 ?>tab">
                                    
                                        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab<?= $id_tjenis1 ?>" role="tablist">
                                            <?php $a=1; foreach ($jenis_resiko as $j): ?>
                                                <li class="nav-item nav_resiko <?= $tjenis1 ?>_resiko <?= $tjenis1 ?>_resiko_<?= $j['id_jenis_resiko'] ?>" role="presentation">
                                                    <a class="nav-link font-weight-bold resiko_aktif <?= $tjenis1 ?>_nav_resiko <?= ($a == 1) ? 'active' : '' ?>" id="rsk_<?= $tjenis1 ?>_resiko<?= $j['id_jenis_resiko'] ?>_tab" data-toggle="tab" href="#rsk_<?= $tjenis1 ?>_resiko<?= $j['id_jenis_resiko'] ?>" role="tab" aria-controls="resiko" style="font-size: 17px;"><?= $j['jenis_resiko'] ?></a>
                                                </li>
                                            <?php $a++; endforeach; ?>
                                        </ul>

                                        <div class="tab-content" id="myTabContent1">

                                            <?php $a1=1; foreach ($jenis_resiko as $jj):
                                                $id_jj = $jj['id_jenis_resiko'];    
                                            ?>
                                                
                                                <div class="tab-pane fade <?= ($a1 == 1) ? 'show active' : '' ?> resiko_tab <?= $tjenis1 ?>_resiko_tab <?= $tjenis1 ?>_resiko_tab<?= $id_jj ?>  p-3" id="rsk_<?= $tjenis1 ?>_resiko<?= $id_jj ?>" role="tabpanel" aria-labelledby="<?= $tjenis1 ?>_resiko<?= $id_jj ?>_tab">

                                                <?php

                                                $dr = $this->M_tanggungan->cari_tr_jenis_resiko($kd_ptg, $id_tjenis1, $id_jj)->row_array();
                                                
                                                ?>

                                                <?php $idjr = $id_tjenis1.$id_jj; if ($dr['id_status_cash'] == 2): 
                                                    
                                                    $dcbc = $this->M_tanggungan->cari_dokumen_cbc($dr['id_resiko_ptg'])->result_array();

                                                    $dtmb = $this->M_tanggungan->cari_dokumen_tambahan($dr['id_resiko_ptg'])->result_array();

                                                    ?>

                                                    <div class="form-group row dokumen_cbc">
                                                        <div class="col-sm-12">
                                                            <table class="table table-bordered table-striped tabel_cbc aksi_hapus" width="100%" cellspacing="0">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th width="5%">No</th>
                                                                        <th width="30%">Nama Dokumen</th>
                                                                        <th width="10%">Aksi</th>
                                                                        <th width="10%">File</th>
                                                                        <th width="10%">Validasi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no=1; foreach ($dcbc as $d): 
                                                                        
                                                                        if ($d['flag_validasi'] == 1) {
                                                                            $ck = 'checked';
                                                                        } else {
                                                                            $ck = '';
                                                                        }
                                                        
                                                                        if ($d['dokumen'] == null) {
                                                                            $hd = 'hidden';
                                                                        } else {
                                                                            $hd = '';
                                                                        }

                                                                        ?>
                                                                    <tr>
                                                                        <td align="center"><?= $no++ ?>.</td>
                                                                        <td><?= $d['jenis_dokumen'] ?></td>
                                                                        <td align='center'><button type='button' class='btn btn-primary btn-sm mr-2 upload' data-id='<?= $d['id_dokumen_cbc'] ?>' jenis_dok='<?= ucwords($d['jenis_dokumen'])?>' <?= $dis ?>>Upload</button><button type='button' class='btn btn-danger btn-sm mr-2 remove' data-id='<?= $d['id_dokumen_cbc'] ?>' jenis_dok='<?= ucwords($d['jenis_dokumen']) ?>' status_jenis_dok='cbc' <?= $hd ?> <?= $dis ?>>Remove</button></td>
                                                                        <td align='center'><a href="<?= base_url() ?>C_pertanggungan/download_dokumen_cbc/<?= $d['id_dokumen_cbc'] ?>"><i class='fa fa-file-text-o fa-2x' <?= $hd ?>></i></a></td>
                                                                        <td align='center'><input type='checkbox' name='cbc[]' value='<?= $d['id_dokumen_cbc'] ?>' <?= $ck ?> <?= $hd ?> <?= $dis ?>></td>
                                                                    </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if (!empty($dtmb)) : ?>
                                                        <div class="form-group row dokumen_tambahan">
                                                            <div class="col-sm-12">
                                                                Dokumen Tambahan
                                                                <table class="table table-bordered table-striped tabel_tambahan aksi_hapus" width="100%" cellspacing="0">
                                                                    <thead class="thead-light">
                                                                        <tr>
                                                                            <th width="5%">No</th>
                                                                            <th width="30%">Nama Dokumen</th>
                                                                            <th width="10%">Aksi</th>
                                                                            <th width="10%">File</th>
                                                                            <th width="10%">Validasi</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $n=1; foreach ($dtmb as $e): 
                                                                            
                                                                            if ($e['flag_validasi'] == 1) {
                                                                                $cke = 'checked';
                                                                            } else {
                                                                                $cke = '';
                                                                            }
                                                            
                                                                            if ($e['dokumen'] == null) {
                                                                                $hde = 'hidden';
                                                                            } else {
                                                                                $hde = '';
                                                                            }

                                                                            ?>
                                                                        <tr>
                                                                            <td align="center"><?= $n++ ?>.</td>
                                                                            <td><?= $e['nama_dokumen'] ?></td>
                                                                            <td align='center'><button type='button' class='btn btn-primary btn-sm mr-2 upload' data-id='<?= $e['id_dokumen_tambahan'] ?>' jenis_dok='<?= ucwords($e['nama_dokumen'])?>'>Upload</button><button type='button' class='btn btn-danger btn-sm mr-2 remove' data-id='<?= $e['id_dokumen_tambahan'] ?>' jenis_dok='<?= ucwords($e['nama_dokumen']) ?>' status_jenis_dok='tambahan' <?= $hde ?>>Remove</button></td>
                                                                            <td align='center'><a href="<?= base_url() ?>C_pertanggungan/download_dokumen_tambahan/<?= $e['id_dokumen_tambahan'] ?>"><i class='fa fa-file-text-o fa-2x' <?= $hde ?>></i></a></td>
                                                                            <td align='center'><input type='checkbox' name='tambahan[]' value='<?= $e['id_dokumen_tambahan'] ?>' <?= $cke ?> <?= $hde ?> ></td>
                                                                        </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                <?php else: ?>

                                                    <div class="form-group row">
                                                        <h5 class="col-sm-12 font-weight-bold text-center">STATUS CAC (No Document)</h5>
                                                    </div>
                                                    
                                                <?php endif; ?>
                                                
                                                    
                                                </div>

                                            <?php $a1++; endforeach; ?>

                                        </div>

                                    </div>

                                <?php $iit++; endforeach;?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="simpan" class="btn text-white float-right mr-2" style="background-color: #02a4af" id="simpan_dok_cbc">Simpan Validasi</button>
                    <!-- <button type="button" name="forward" class="btn text-white float-right mr-2" style="background-color: #eb5905">Forward Asuransi</button> -->
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal_upload" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header text-white" style="background-color: #02a4af">
            <h5 class="modal-title font-weight-bold" id="judul_modal">Upload Dokumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
            </button>
        </div>
            <form id="form_dokumen" action="<?= base_url('C_pertanggungan/upload_dokumen_ptg') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id_dok" id="id_dok">
                <input type="hidden" name="status_jenis_dok" id="status_jenis_dok">
                <input type="hidden" name="id_ptg" value="<?= $id_ptg ?>">
                <input type="hidden" name="halaman" value="upload">
                <div class="modal-body">
                    <div class="">
                        <div class="col-md-12 p-3">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Jenis Dokumen</label>
                                <div class="col-sm-8 mt-2">
                                    <span class="font-weight-bold t_jenis_dok">:</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Upload</label>
                                <div class="col-sm-8 mt-2">
                                    <input type="file" name="upload_dok" id="upload_dok" class="form-control"> 
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #02a4af">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        
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
            // "order"         : [[ 0, '' ]],
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
        $('.tabel_dok_ptg').on('click', '.upload', function () {

            var id_dok      = $(this).data('id');
            var jenis_dok   = $(this).attr('jenis_dok');

            $('#id_dok').val(id_dok);
            $('#status_jenis_dok').val('ptg');
            $('.t_jenis_dok').text(jenis_dok);

            $('#modal_upload').modal('show');

        })

        // 23-03-2021
        $('.tabel_cbc').on('click', '.upload', function () {

            var id_dok      = $(this).data('id');
            var jenis_dok   = $(this).attr('jenis_dok');

            $('#id_dok').val(id_dok);
            $('#status_jenis_dok').val('cbc');
            $('.t_jenis_dok').text(jenis_dok);

            $('#modal_upload').modal('show');

        })

        // 26-03-2021
        $('.tabel_tambahan').on('click', '.upload', function () {

            var id_dok      = $(this).data('id');
            var jenis_dok   = $(this).attr('jenis_dok');

            $('#id_dok').val(id_dok);
            $('#status_jenis_dok').val('tambahan');
            $('.t_jenis_dok').text(jenis_dok);

            $('#modal_upload').modal('show');

        })

        // 23-03-2021
        $('.aksi_hapus').on('click', '.remove', function () {

            var id_dok              = $(this).data('id');
            var jenis_dok           = $(this).attr('jenis_dok');
            var status_jenis_dok    = $(this).attr('status_jenis_dok');
            var id_ptg              = $('#id_ptg').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus dokumen '+jenis_dok+'?',
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
                    url         : "<?= base_url() ?>C_pertanggungan/hapus_dokumen",
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
                    data        : {id_dok:id_dok, status_jenis_dok:status_jenis_dok, id_ptg:id_ptg},
                    dataType    : "JSON",
                    success     : function (data) {

                        window.location = "<?= base_url() ?>C_pertanggungan/kelengkapan_dokumen/"+id_ptg;

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
                            text                : 'Anda membatalkan hapus dokumen',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        });
                }

            });

        })

    })

</script>