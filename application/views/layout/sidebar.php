<?php $style_1 = 'style="color: #fff; background: #eb5905;"'; 
      $style_2 = 'style="color: #eb5905; font-weight: bold; text-shadow: 1px 1px 3px white;"';
?>
<nav class="sidebar sidebar-offcanvas shadow" id="sidebar" style="position: fixed;">
    <ul class="nav">
    <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
        
        <div class="profile-image">
            <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/images/logo_face.png" alt="profile image">
            <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
            <p class="profile-name"><?= ucwords($this->session->userdata('username')); ?></p>
            <p class="designation"></p>
        </div>

        </a>
    </li>
    <!-- style="color: #fff; background: #2461AA;" -->
    <li class="nav-item nav-category mb-3 text-white">Main Menu</li>
    <li class="nav-item" style="margin-top: -10px;">
        <a class="nav-link" <?= ($menu == 'Dashboard') ? $style_1 : '' ?> href="<?= base_url('C_dashboard') ?>">
        <i class="menu-icon typcn typcn-document-text"></i>
        <span class="menu-title">Dashboard</span>
        </a>
    </li>

    <!-- master data -->

    <?php 
        $sess_level = $this->session->userdata('id_level');
     ?>

    <?php if ($sess_level == 1 || $sess_level == 4): ?>

        <?php if ($sess_level == 1) : ?>

        <li class="nav-item">
            <a class="nav-link" <?= ($menu == 'Master' || $menu == 'Master Wilayah' || $menu == 'Master Asuransi') ? $style_1 : '' ?> data-toggle="collapse" href="#master" aria-expanded="false" aria-controls="master">
                <i class="menu-icon typcn typcn-coffee"></i>
                    <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse mb-3" id="master">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" <?= ($menu == 'Master Wilayah') ? $style_1 : '' ?> data-toggle="<?= ($menu == 'Master Wilayah') ? 'collapsed' : 'collapse' ?>" href="#wilayah" aria-expanded="<?= ($menu == 'Master Wilayah') ? 'true' : 'false' ?>" aria-controls="wilayah">
                            <i class="menu-icon typcn typcn-coffee"></i>
                                <span class="menu-title mt-2">Data Wilayah</span>
                            <i class="menu-arrow mt-2" style="margin-right: 20px;"></i>
                        </a>
                        <div class="<?= ($menu == 'Master Wilayah') ? 'collapsed mt-3 mb-3 show' : 'collapse mt-3 mb-3' ?>" style="margin-left: 20px;" id="wilayah">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                <a class="nav-link active" <?= ($page == 'Negara') ? $style_2 : '' ?> href="<?= base_url('C_master/negara') ?>">Negara</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" <?= ($page == 'Provinsi') ? $style_2 : '' ?> href="<?= base_url('C_master/provinsi') ?>">Provinsi</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" <?= ($page == 'Kota/Kabupaten') ? $style_2 : '' ?> href="<?= base_url('C_master/kota_kabupaten') ?>">Kota/Kabupaten</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" <?= ($page == 'Kecamatan') ? $style_2 : '' ?> href="<?= base_url('C_master/kecamatan') ?>">Kecamatan</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?= ($menu == 'Master Asuransi') ? $style_1 : '' ?> data-toggle="<?= ($menu == 'Master Asuransi') ? 'collapsed' : 'collapse' ?>" href="#asuransi" aria-expanded="<?= ($menu == 'Master Asuransi') ? 'true' : 'false' ?>" aria-controls="asuransi">
                            <i class="menu-icon typcn typcn-coffee"></i>
                                <span class="menu-title">Keasuransian</span>
                            <i class="menu-arrow" style="margin-right: 20px;"></i>
                        </a>
                        <div class="<?= ($menu == 'Master Asuransi') ? 'collapsed mt-3 mb-3 show' : 'collapse mt-3 mb-3' ?>" style="margin-left: 20px;" id="asuransi">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" <?= ($page == 'Data Asuransi') ? $style_2 : '' ?> href="<?= base_url('C_master/data_asuransi') ?>">Data Asuransi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" <?= ($page == 'Dokumen Underwriting') ? $style_2 : '' ?> href="<?= base_url('C_master/dok_underwriting') ?>">Jenis Dokumen Underwriting</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" <?= ($page == 'Status Underwriting') ? $style_2 : '' ?> href="<?= base_url('C_master/status_underwriting') ?>">Status Underwriting</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" <?= ($page == 'Jenis kredit') ? $style_2 : '' ?> href="<?= base_url('C_master/jenis_kredit') ?>">Jenis Kredit</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" <?= ($page == 'Jenis Pertanggungan') ? $style_2 : '' ?> href="<?= base_url('C_master/jenis_pertanggungan') ?>">Jenis Pertanggungan</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" <?= ($page == 'Jenis Produk') ? $style_2 : '' ?> href="<?= base_url('C_master/jenis_produk') ?>">Jenis Produk</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" <?= ($page == 'Jenis Resiko') ? $style_2 : '' ?> href="<?= base_url('C_master/jenis_resiko') ?>">Jenis Resiko</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?= ($page == 'Bpr') ? $style_2 : '' ?> href="<?= base_url('C_master/bpr') ?>">Data BPR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?= ($page == 'Spk') ? $style_2 : '' ?> href="<?= base_url('C_master/spk') ?>" hidden>Data SPK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" <?= ($page == 'Debitur') ? $style_2 : '' ?> href="<?= base_url('C_master/debitur') ?>">Data Debitur</a>
                    </li>
                    <li class="nav-item" hidden>
                        <a class="nav-link" <?= ($page == 'Verifikator') ? $style_2 : '' ?> href="<?= base_url('C_master/verifikator') ?>">Data Verifikator</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" <?= ($menu == 'Register User') ? $style_1 : '' ?> href="<?= base_url('C_register_user') ?>">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Register User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" <?= ($menu == 'Underwriting') ? $style_1 : '' ?> href="<?= base_url('C_transaksi/underwriting') ?>">
            <i class="menu-icon typcn typcn-document-text"></i>
            <span class="menu-title">Underwriting</span>
            </a>
        </li>

        <?php endif; ?>

    <li class="nav-item">

        <a class="nav-link" <?= ($menu == 'PKS' ) ? $style_1 : '' ?> data-toggle="collapse" href="#pks" aria-expanded="<?= ($menu == 'PKS') ? 'true' : 'false' ?>" aria-controls="pks">
        <i class="menu-icon typcn typcn-coffee"></i>
        <span class="menu-title">Perjanjian Kerjasama</span> 
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse mt-3 mb-3 <?= ($page == 'Klausal' || $page == 'Tambah Klausal' || $page == 'Tambah Penawaran' || $page == 'Edit Penawaran' || $page == 'Tambah PKS' || $page == 'Edit Klausal' || $page == 'Detail Klausal') ? 'show' : '' ?>" id="pks">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link" <?= ($page == 'Klausal' || $page == 'Tambah Klausal' || $page == 'Edit Klausal' || $page == 'Detail Klausal') ? $style_2 : '' ?> href="<?= base_url('C_pks/klausal_asuransi') ?>">Klausal Asuransi</a>
                </li>
                <?php if ($sess_level == 1) : ?>
                    <li class="nav-item">
                    <a class="nav-link" <?= ($page == 'Penawaran' || $page == 'Tambah Penawaran' || $page == 'Edit Penawaran') ? $style_2 : '' ?> href="<?= base_url('C_pks/penawaran') ?>">Penawaran BPR</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" <?= ($page == 'PKS' || $page == 'Tambah PKS') ? $style_2 : '' ?> href="<?= base_url('C_pks/pks') ?>">PKS BPR</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                    <a class="nav-link" <?= ($page == 'BPR Tergabung') ? $style_2 : '' ?> href="<?= base_url('C_pks/bpr_tergabung') ?>">BPR Tergabung</a>
                    </li>
                <?php endif; ?>
                
            </ul>
        </div>
    </li>

    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" <?= ($menu == 'Pertanggungan') ? $style_1 : '' ?> data-toggle="collapse" href="#pertanggungan" aria-expanded="false" aria-controls="pertanggungan">
        <i class="menu-icon typcn typcn-coffee"></i>
        <span class="menu-title">Pertanggungan</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse mt-3 mb-3 <?= ($page == 'Pertanggungan' || $page == 'Lihat Debitur PTG' || $page == 'Tambah PTG' || $page == 'Hasil PTG' || $page == 'Kelengkapan Dokumen' || $page == 'Approve PTG' || $page == 'Detail PTG' || $page == 'Edit PTG' || $page == 'Lihat Debitur Approve') ? 'show' : '' ?>" id="pertanggungan">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                <a class="nav-link" <?= ($page == 'Pertanggungan' || $page == 'Lihat Debitur PTG' || $page == 'Tambah PTG' || $page == 'Hasil PTG' || $page == 'Kelengkapan Dokumen' || $page == 'Approve PTG' || $page == 'Detail PTG' || $page == 'Edit PTG') ? $style_2 : '' ?> href="<?= base_url('C_pertanggungan') ?>">Data Tertanggung</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" <?= ($page == 'Terbit Polish' || $page == 'Lihat Debitur Approve') ? $style_2 : '' ?> href="<?= base_url('C_pertanggungan/terbit_polis') ?>">Terbit Polis</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" <?= ($menu == 'Klaim') ? $style_1 : '' ?> data-toggle="collapse" href="#klaim" aria-expanded="false" aria-controls="klaim">
        <i class="menu-icon typcn typcn-coffee"></i>
        <span class="menu-title">Klaim</span>
        <i class="menu-arrow"></i>
        </a>
        <div class="collapse mt-3 mb-3" id="klaim">
            <ul class="nav flex-column sub-menu">
                <?php if ($sess_level == 1 || $sess_level == 3) : ?>
                    <li class="nav-item">
                        <a class="nav-link" <?= ($page == 'Pengajuan Klaim') ? $style_2 : '' ?> href="<?= base_url('C_klaim/pengajuan_klaim') ?>">Pengajuan Klaim</a>
                    </li>
                <?php endif; ?>
                
                <li class="nav-item">
                <a class="nav-link" <?= ($page == 'Data Klaim') ? $style_2 : '' ?> href="<?= base_url('C_klaim/data_klaim') ?>">Data Klaim</a>
                
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item" style="margin-top: -10px;">
        <a class="nav-link" <?= ($menu == '') ? $style_1 : '' ?> href="<?= base_url('C_monitoring_klaim') ?>">
        <i class="menu-icon typcn typcn-document-text"></i>
        <span class="menu-title">Monitoring Klaim</span>
        </a>
    </li>

    </ul>
</nav>