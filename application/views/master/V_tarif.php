<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_spk">Tambah Klausal</button>

                <h4 id="judul" class="font-weight-bold">Data Klausal</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_klausal" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Nama Klausal</th>
                            <th width="10%">Detail</th>
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

        var tabel_klausal = $('#tabel_klausal').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>tampil_data_klausal",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }],
            "scrollX"           : true
        })
        
    })

</script>