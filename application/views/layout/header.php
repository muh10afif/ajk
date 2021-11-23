<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" style="margin-top: 0px" href="index.html">
        <img src="<?= base_url() ?>assets/images/ajk logo-01.png" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
        <img src="<?= base_url() ?>assets/images/ajk logo-03.png" alt="logo" /> </a>
        <!-- <h3 class="navbar-brand brand-logo mt-1">SIMON PRO</h3> -->
        <!-- <h3 class="avbar-brand brand-logo-mini mt-1">SIMON PRO</h3> -->
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-lg-block" style="font-size: 22px; color: #02a4af">Asuransi Jiwa Kredit</li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-xl-inline-block user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/images/logo_face.png" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                    <img class="img-md rounded-circle" src="<?= base_url() ?>assets/images/logo_face.png" alt="Profile image">
                    <p class="mb-1 mt-3 font-weight-semibold"><?= $this->session->userdata('level'); ?></p>
                    <p class="font-weight-light text-muted mb-0">Email</p>
                </div>
                <a class="dropdown-item d-flex justify-content-center" href="<?= base_url('C_login/logout') ?>">Logout<i class="dropdown-item-icon ti-power-off"></i></a>
            </div>
        </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
        </button>
    </div>
    </nav>