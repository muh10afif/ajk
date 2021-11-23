<style>
    .field-icon {
        float: right;
        margin-left: -40px;
        margin-right: 10px;
        margin-top: 5px;
        position: relative;
        z-index: 2;
    }
</style>
<div class="modal-header bg-warning text-white">
    <h5 class="modal-title font-weight-bold" id="judul_modal">Register User <?= ucwords($level) ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
    </button>
</div>

<div class="modal-body table-responsive">

    <form id="form_user" autocomplete="off">
    <div class="card">
        <div class="card-body row p-3">
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="nama_lengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" style="font-size: 14px;" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                    </div>  
                </div>
                <div class="form-group row mt-2">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" style="font-size: 14px;" name="email" id="email" placeholder="Masukkan Nama Lengkap">
                    </div>
                </div>  
                <div class="form-group row mt-2">
                    <label for="kontak" class="col-sm-4 col-form-label">Kontak</label>
                    <div class="col-sm-8">
                        <input type="kontak" class="form-control" style="font-size: 14px;" name="kontak" id="kontak" placeholder="Masukkan Kontak">
                    </div>
                </div>  
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="username" class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" style="font-size: 14px;" name="username" id="username" placeholder="Masukkan Username">
                    </div>  
                </div>
                <div class="form-group row mt-2">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" style="font-size: 14px;" name="password" id="password" placeholder="Masukkan Password">
                        <input type="hidden" name="password_lama" id="password_lama">
                        <span toggle="#password" class="mdi mdi-eye field-icon toggle-password"></span>
                        <mark class="mark_pass">Harap Catat Pasword Anda!!</mark>
                    </div>
                </div>  
            </div>
            <div class="col-md-12"><hr>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-warning mr-3" id="simpan_user" type="button">Simpan</button>
                    <button class="btn btn-secondary" id="batal_user" type="button" hidden>Batal</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-bordered table-hover mt-2 tabel_user" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama Lengkap</th>
                        <th width="20%">Email</th>
                        <th width="20%">Kontak</th>
                        <th width="20%">Username</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>

</div>
    
<div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
</div>
<!-- 
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/datatable/datatables.css"/>

<script type="text/javascript" src="<?= base_url() ?>assets/datatable/datatables.js"></script> -->

<script>

    $(document).ready(function () {

        // muncul password
        $(".toggle-password").click(function() {

            $(this).toggleClass("mdi-eye mdi-eye-off");

            var input = $($(this).attr("toggle"));

            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }

        });

    })

</script>