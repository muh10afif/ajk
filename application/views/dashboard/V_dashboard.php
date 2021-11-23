<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">50</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-monitor mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Data BPR</h5>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-white bg-success shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">100</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-monitor-multiple mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Data Debitur</h5>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-white bg-danger shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">10</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-monitor-multiple mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Data Tertanggung</h5>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">20</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-monitor-multiple mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Data User</h5>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-1 mb-3">
    <div class="col-md-5">
      <hr style="border: 1.2px solid black; margin-top: 25px;">
    </div>
    <div class="col-md-2 text-center">
        <h4 class="mt-2"><b>AJK</b></h4>
    </div>
    <div class="col-md-5">
      <hr style="border: 1.2px solid black; margin-top: 25px;">
    </div>
</div>
<!-- filter -->
<div class="row mt-3 mb-4">
    <div class="col-md-12">
        <div class="card shadow">
        <div class="card-header p-3">
            <h4 class="font-weight-bold">Filter Periode</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2 offset-md-2 text-center">
                        <span class="font-weight-bold">Periode</span>
                    </div>
                    <div class="col-md-5">
                        <div class="input-daterange input-group">
                            <input type="text" class="form-control datepicker2 text-center" name="start" id="start" placeholder="Awal Periode" style="font-size: 14px;" readonly required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary b-0 text-white">s / d</span>
                            </div>
                            <input type="text" class="form-control datepicker2 text-center" name="end" id="end" placeholder="Akhir Periode" style="font-size: 14px;" readonly required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-sm btn-success mr-2" id="tampilkan" type="button">Tampilkan</button>
            <button class="btn btn-sm btn-secondary" id="reset" type="button">Reset</button>
        </div>
        </div>
    </div>
</div>
<!-- Akhir Filter -->
<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-success shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">12</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-arrow-right-drop-circle mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">SPAJK</h5>
            </div>
            <div class="progress progress-md mt-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-danger shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">20</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-close-circle mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Deklarasi</h5>
            </div>
            <div class="progress progress-md mt-3">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-warning shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">25</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-clock-alert mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Terbit Polis</h5>
            </div>
            <div class="progress progress-md mt-3">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card text-primary shadow">
            <div class="card-body">
            <div class="d-flex justify-content-between pb-2 align-items-center">
                <h2 class="font-weight-semibold mb-0">30</h2>
                <div class="icon-holder">
                    <i class="mdi mdi-checkbox-multiple-marked-circle mdi-36px" style="font-size: 25px;"></i>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h5 class="font-weight-semibold mb-0">Bayar Premi</h5>
            </div>
            <div class="progress progress-md mt-3">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </div>
        </div>
    </div>
</div>