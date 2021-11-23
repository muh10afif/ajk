<div class="row f_satu">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul" class="font-weight-bold">Terbit Polish</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_polish" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nomor SPK</th>
                            <th width="20%">Nama BPR</th>
                            <th width="20%">Total Polish</th>
                            <th width="10%">Aksi</th>
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
        var tabel_polish = $('#tabel_polish').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url('C_pertanggungan/tampil_polish') ?>",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            }]
        })
        
    })

</script>