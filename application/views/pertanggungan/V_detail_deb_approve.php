<div class="row f_satu">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Terbit Polish</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Debitur Tertanggung</li>
            </ol>
        </nav>
    </div>

    <input type="hidden" name="id_pks" class="id_pks" value="<?= $id_pks ?>">
    <input type="hidden" name="id_bpr" class="id_bpr" value="<?= $id_bpr ?>">
    <input type="hidden" name="nama_bpr" class="nama_bpr" value="<?= $nama_bpr ?>">
    <input type="hidden" name="nomor_pks" class="nomor_pks" value="<?= $nomor_pks ?>">

    <div class="col-md-3">
        <a href="<?= base_url('C_pertanggungan/terbit_polis') ?>">
            <button class="btn mb-3 float-right kembali_dua" style="background-color: #02a4af; color:white;" type="submit"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
        </a>
        
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul" class="font-weight-bold">Detail Debitur Polish</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_detail" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Kode Tertanggung</th>
                            <th width="20%">Nama Tertanggung</th>
                            <th width="20%">Certified Number</th>
                            <th width="20%">Uang Pertanggungan</th>
                            <th width="20%">Premi</th>
                            <th width="20%">Status Cash</th>
                            <th width="20%">Jenis Tanggung</th>
                            <th width="20%">Jenis Resiko</th>
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

    $(document).ready(function () {

        // 30-03-2021
        var tabel_detail = $('#tabel_detail').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_detail_debitur_approve",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_pks = $('.id_pks').val();
                    data.id_bpr = $('.id_bpr').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,7],
                "orderable" : false
            }, {
                'targets'   : [0,7],
                'className' : 'text-center',
            }],

        })
        
    })

</script>