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

</style>
<div class="row f_tiga">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item" style="color: #02a4af">List Debitur Tertanggung</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Debitur Tertanggung</li>
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
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: -40px; margin-top: -20px;">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Nama BPR</label>
                            <div class="col-sm-6 mt-2">
                                <span class="font-weight-bold t_nama_bpr">: <?= $nama_bpr ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Nomor SPK</label>
                            <div class="col-sm-6 mt-2">
                                <span class="font-weight-bold t_nomor_pks">: <?= $nomor_pks ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
            
        <div class="card">
            <div class="card-header p-3">
                <h4 class="font-weight-bold">Detail Data Tertanggung</h4>
            </div>
            <div class="card-body table-responsive ">
                <div class="row p-2">
                    <div class="col-md-12">
                        <h4 class="font-weight-bold">Data Tertanggung</h4>
                    </div>
                </div>
                <div class="form-group row list_tambah_debitur p-2">
                    <label for="nik" class="col-sm-3 col-form-label font-weight-bold">Debitur</label>
                    <div class="col-sm-7 font-weight-bold mt-2">
                        : <?= $ptg['nama_lengkap'] ?>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" name="st_debitur" id="st_debitur" value="tambah" hidden>
                        <button type="button" class="btn btn-sm btn-block m-0" style="background-color: #02a4af; color:white;" id="detail_debitur" data-id="<?= $ptg['id_debitur'] ?>">Detail Debitur</button>
                    </div>
                </div>

                <!-- data asuransi -->
                <div class="col-md-12">
                    <h4 class="font-weight-bold">Data Asuransi</h4>
                    
                    <div class="form-group row">
                        <label for="id_jenis_kredit" class="col-sm-3 col-form-label font-weight-bold">Jenis Kredit</label>
                        <div class="col-sm-9 font-weight-bold mt-2">
                            : <?= $crp['jenis_kredit'] ?> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_produk" class="col-sm-3 col-form-label font-weight-bold">Jenis Produk</label>
                        <div class="col-sm-9 font-weight-bold mt-2">
                            : <?= $crp['jenis_produk'] ?> 
                        </div>
                    </div>  
                    <div class="row mt-3 nav_awal_klausal">
                        <div class="col-md-3 nav_klausal">
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
                        <div class="col-md-9">
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

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Uang Pertanggungan</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: Rp. <?= number_format($dr['uang_ptg'],0,'.','.') ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Bunga</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: <?= $dr['bunga'] ?>%</span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Tanggal Akad</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: <?= date("d-M-Y", strtotime($dr['tgl_akad'])) ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Periode Awal Asuransi</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: <?= date("d-M-Y", strtotime($dr['periode_asuransi_awal'])) ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Periode Akhir Asuransi</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: <?= date("d-M-Y", strtotime($dr['periode_asuransi_akhir'])) ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Premi</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: Rp. <?= number_format($dr['premi'],0,'.','.') ?></span>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Masa Asuransi</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: <?= $dr['masa_asuransi'] ?> Tahun</span>
                                                    </div>
                                                </div>
                                                    
                                                <div class="form-group row">
                                                    <label class="col-sm-5 col-form-label">Status Cash</label>
                                                    <div class="col-sm-7 mt-1">
                                                        <span class="font-weight-bold t_sts_udw">: <?= $dr['status_cash'] ?> <?= ($dr['id_status_cash'] == 2) ? "(".$dr['status_underwriting'].")" : '' ?></span>
                                                    </div>
                                                </div>
                                                
                                                <?php if ($dr['id_status_cash'] == 2): 
                                                    
                                                    $dcbc = $this->M_tanggungan->cari_dokumen_cbc($dr['id_resiko_ptg'])->result_array();

                                                    $dtmb = $this->M_tanggungan->cari_dokumen_tambahan($dr['id_resiko_ptg'])->result_array();

                                                    ?>

                                                    <!-- <div class="form-group row dokumen_cbc">
                                                        <label class="col-sm-5 col-form-label">Dokumen CBC</label>
                                                        <div class="col-sm-7 dok_cbc">
                                                            <?php foreach ($dcbc as $d): ?>

                                                                <label class="col-form-label"><?= $d['jenis_dokumen'] ?></label>
                                                                <input type="file" name="<?= $d['jenis_dokumen'] ?>_<?= $id_tjenis1.$id_jj ?>_<?= $d['id_dokumen_cbc'] ?>" class="form-control mt-2">
                                                            
                                                            <?php endforeach; ?>

                                                        </div>
                                                    </div> -->

                                                    <table class="table table-bordered table-striped mb-2" width="100%" cellspacing="0">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th width="5%">No</th>
                                                                <th width="40%">Nama Dokumen</th>
                                                                <th width="10%">File</th>
                                                                <th width="10%">Validasi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $n=1; foreach ($dcbc as $d): ?>
                                                                <tr>
                                                                    <td align="center"><?= $n++ ?>.</td>
                                                                    <td><?= ucwords($d['jenis_dokumen']) ?></td>
                                                                    <td align="center">
                                                                        <?php if ($d['dokumen'] != null) : ?>
                                                                            <a href="<?= base_url("C_pertanggungan/download_dokumen_cbc/".$d['id_dokumen_cbc']) ?>"><i class='fa fa-file-text-o fa-2x'></i></a>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td align="center"><?= ($d['flag_validasi'] == 1) ? 'Tervalidasi' : '' ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                    <?php if (!empty($dtmb)) : ?>

                                                    <span class="font-weight-bold mb-1">Dokumen Tambahan</span>

                                                    <table class="table table-bordered table-striped mt-2" width="100%" cellspacing="0">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th width="5%">No</th>
                                                                <th width="40%">Nama Dokumen</th>
                                                                <th width="10%">File</th>
                                                                <th width="10%">Validasi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $n=1; foreach ($dtmb as $d): ?>
                                                                <tr>
                                                                    <td align="center"><?= $n++ ?>.</td>
                                                                    <td><?= ucwords($d['nama_dokumen']) ?></td>
                                                                    <td align="center">
                                                                        <?php if ($d['dokumen'] != null) : ?>
                                                                            <a href="<?= base_url("C_pertanggungan/download_dokumen_tambahan/".$d['id_dokumen_tambahan']) ?>"><i class='fa fa-file-text-o fa-2x'></i></a>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td align="center"><?= ($d['flag_validasi'] == 1) ? 'Tervalidasi' : '' ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>

                                                    <?php endif; ?>
                                                    
                                                <?php else: ?>

                                                    <div class="form-group row covernote">
                                                        <label class="col-sm-5 col-form-label">Covernote</label>
                                                        <div class="col-sm-7 mt-1">
                                                            <button class="btn btn-primary">Cetak Covernote</button>
                                                        </div>
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
                <!-- akhir data asuransi -->
                <br> 
                <!-- data kesehatan -->
                <div class="col-md-12">
                    <h4 class="font-weight-bold">Data Kesehatan</h4>
                    <div class="form-group row">
                        <label for="tinggi_badan" class="col-sm-5 col-form-label font-weight-bold">Tinggi Badan</label>
                        <div class="col-sm-3 font-weight-bold mt-2">
                            : <?= $ptg['tinggi_badan'] ?> cm 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berat_badan" class="col-sm-5 col-form-label font-weight-bold">Berat Badan</label>
                        <div class="col-sm-3 font-weight-bold mt-2">
                            : <?= $ptg['berat_badan'] ?> kg 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanya_kesehatan_1" class="col-sm-5 col-form-label font-weight-bold">Apakah Dalam 5 tahun terakhir Anda pernah dioperasi/dirawat di Rumah Sakit atau dalam masa pengobatan/perawatan yang membutuhkan obat-obatan dalam masa yang lama? Jika "YA", jelaskan! </label>
                        <div class="col-sm-7">

                            <div class="row">
                                <div class="col-md-2 font-weight-bold mt-2">
                                    : <?= ($ptg['tanya_kesehatan_1_sts'] == 1) ? 'Ya' : 'Tidak' ?> 
                                </div>
                                <?php if ($ptg['tanya_kesehatan_1_sts'] == 1) : ?>
                                    <div class="col-md-10 t_satu mt-2 font-weight-bold">
                                        Keterangan : <?= $ptg['tanya_kesehatan_1'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanya_kesehatan_2" class="col-sm-5 col-form-label font-weight-bold">Apakah Anda pernah atau sedang menderita penyakit atau pernah diberitahu atau dalam konsultasi perawatan/pengobatan/pengawasan/medis: jantung/nyeri dada, tekanan darah tinggi, stroke, tumor/benjolan. </label>
                        <div class="col-sm-7">

                            <div class="row">
                                <div class="col-md-2 font-weight-bold mt-2">
                                    : <?= ($ptg['tanya_kesehatan_2_sts'] == 1) ? 'Ya' : 'Tidak' ?> 
                                </div>
                                <?php if ($ptg['tanya_kesehatan_2_sts'] == 1) : ?>
                                    <div class="col-md-10 mt-2 font-weight-bold">
                                        Keterangan : <?= $ptg['tanya_kesehatan_2'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanya_kesehatan_3" class="col-sm-5 col-form-label font-weight-bold">Apakah anda sedang atau dianjurkan atau pernah mengalami konsultasi/rawat inap/operasi/biopsi/pemerikasaan laboratorium/EKG/Tream III/Echocandiogragraphy/USG/CT Scan/MRI/papsmear/Mamografi</label>
                        <div class="col-sm-7">

                            <div class="row">
                                <div class="col-md-2 font-weight-bold mt-2">
                                    : <?= ($ptg['tanya_kesehatan_3_sts'] == 1) ? 'Ya' : 'Tidak' ?> 
                                </div>
                                <?php if ($ptg['tanya_kesehatan_3_sts'] == 1) : ?>
                                    <div class="col-md-10 mt-2 font-weight-bold">
                                        Keterangan : <?= $ptg['tanya_kesehatan_3'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-5 col-form-label font-weight-bold">Khusus untuk wanita, Apakah anda sedang hamil?</label>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-md-2 font-weight-bold mt-2">
                                    : <?= ucwords($ptg['tanya_hamil']) ?> 
                                </div>
                                <?php if ($ptg['tanya_hamil'] == 'ya') : ?>
                                    <div class="col-md-10 j_anak mt-1" style="display: none;">
                                        <div class="row">
                                            <label for="ket3" class="col-sm-4 col-form-label font-weight-bold text-right">Kehamilan Anak ke- </label>
                                            <div class="col-sm-3">
                                                : <?= $ptg['hamil_anak_ke'] ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir data kesehatan -->
                <br>
                <!-- dokumen -->
                
                <div class="col-md-12">
                    <h4 class="font-weight-bold">Dokumen</h4>
                    <table class="table table-bordered table-striped tabel_dok_ptg" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="40%">Nama Dokumen</th>
                                <th width="10%">File</th>
                                <th width="10%">Validasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach ($dokumen_ptg as $d): ?>
                                <tr>
                                    <td align="center"><?= $no++ ?>.</td>
                                    <td><?= ucwords($d['nama_dokumen']) ?></td>
                                    <td align="center">
                                        <?php if ($d['dokumen'] != null) : ?>
                                            <a href="<?= base_url("C_pertanggungan/download_dokumen_ptg/".$d['id_dokumen']) ?>"><i class='fa fa-file-text-o fa-2x'></i></a>
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td align="center"><?= ($d['flag_validasi'] == 1) ? 'Tervalidasi' : 'Belum Tervalidasi' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- akhir dokumen -->

            </div>

        </div>

    </div>
    
</div>

<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content f_detail">
            
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // 29-03-2021
        $('#detail_debitur').on('click', function () {
            
            var id_debitur = $(this).data('id');

            $.ajax({
                url         : "<?= base_url() ?>C_pertanggungan/form_detail_debitur",
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
                data        : {id_debitur:id_debitur},
                success     : function (data) {

                    swal.close();
                    $('.f_detail').html(data);
                    $('#modal_detail').modal('show');

                },
                error       : function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }
            })

            return false;

        })
        
    })

</script>