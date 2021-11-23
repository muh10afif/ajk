<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <a href="<?= base_url('C_pks/tambah_penawaran') ?>"><button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_penawaran">Tambah Data</button></a>
            
                <h4 id="judul" class="font-weight-bold">Penawaran BPR</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-striped" id="tabel_penawaran" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nomor Penawaran</th>
                            <th>Kode Klausul Asuransi</th>
                            <th>Nama BPR</th>
                            <th>Nama Asuransi</th>
                            <th>Status</th>
                            <th>Aksi</th>
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

        var tabel_penawaran = $('#tabel_penawaran').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_pks/tampil_penawaran",
                "type"  : "POST"
            },

            "columnDefs"        : [{
                "targets"   : [0,5,6],
                "orderable" : false
            }, {
                'targets'   : [0,5,6],
                'className' : 'text-center',
            }]

        })

        // 01-04-2021
        $('#tabel_penawaran').on('click', '.hapus', function () {

            var id_penawaran = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data penawaran?',
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
                        url         : "<?= base_url() ?>C_pks/hapus_penawaran",
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
                        data        : {id_penawaran:id_penawaran},
                        dataType    : "JSON",
                        success     : function (data) {

                            tabel_penawaran.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus data',
                                text                : 'Data Klausul Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 

                            
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
                            text                : 'Anda membatalkan hapus data penawaran',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                }
            })


            })
        
    })

</script>