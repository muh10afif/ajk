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
<div class="row f_lima">

    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item" style="color: #02a4af">Detail Debitur Tertanggung</li>
                <li class="breadcrumb-item" style="color: #02a4af">Tambah Data Tertanggung</li>
                <li class="breadcrumb-item active" aria-current="page">Hasil Data Tertanggung</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-12">
        
        <form id="form_dokumen_cbc" action="<?= base_url('C_pertanggungan/simpan_dokumen_cbc') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="id_ptg" class="id_ptg" value="<?= $id_data_ptg ?>" class="form-control">
            <input type="hidden" name="kd_ptg" class="kd_ptg" value="<?= $kd_ptg ?>" class="form-control">
            <input type="hidden" name="id_pks" class="id_pks" value="<?= $id_pks ?>" class="form-control">
            <input type="hidden" name="id_bpr" class="id_bpr" value="<?= $id_bpr ?>" class="form-control">
            <input type="hidden" name="nomor_pks" class="nomor_pks" value="<?= $nomor_pks ?>" class="form-control">
            <input type="hidden" name="nama_bpr" class="nama_bpr" value="<?= $nama_bpr ?>" class="form-control">
        <div class="card">
            <div class="card-header">
                <h4 class="font-weight-bold">Data Tertanggung</h4>
            </div>
            
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama Debitur</label>
                            <div class="col-sm-9 mt-1">
                                <span class="font-weight-bold t_nama_debitur">: <?= $ptg['nama_lengkap'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9 mt-1">
                                <span class="font-weight-bold t_nik">: <?= $ptg['nik'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Usia</label>
                            <div class="col-sm-9 mt-1">
                                <span class="font-weight-bold t_usia">: <?= $ptg['usia'] ?> Tahun</span>
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

                                                        ?>

                                                        <div class="form-group row dokumen_cbc">
                                                            <label class="col-sm-5 col-form-label">Dokumen CBC</label>
                                                            <div class="col-sm-7 dok_cbc">
                                                                <?php foreach ($dcbc as $d): ?>

                                                                    <label class="col-form-label"><?= $d['jenis_dokumen'] ?></label>
                                                                    <input type="file" name="<?= $d['jenis_dokumen'] ?>_<?= $id_tjenis1.$id_jj ?>_<?= $d['id_dokumen_cbc'] ?>" class="form-control mt-2">
                                                                
                                                                <?php endforeach; ?>

                                                            </div>
                                                        </div>
                                                        
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

                </div>
            </div>
            <div class="card-footer">
                
                <button type="submit" name="kembali" class="btn btn-secondary" id="keluar_cbc">Kembali</button>
                <button type="submit" name="simpan" class="btn text-white float-right mr-2" style="background-color: #02a4af" id="simpan_dok_cbc">Simpan</button>
            </div>
        </div>
        </form>
    </div>
                                        
</div>