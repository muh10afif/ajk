<style>
    @media (min-width: 1200px) {
        #modal_tambah_user {
            width: 70%; 
            left: 15%;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul" class="font-weight-bold">Register User</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_reg_user" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Nama BPR</th>
                            <th width="10%">Kelola User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td align="center"><button class="btn btn-success mr-2 tambah-user" level="manager" data-id="1">Manager</button><button class="btn btn-danger mr-2 tambah-user" level="admin" data-id="1">Admin</button></td>
                        </tr> -->
                    </tbody>
                </table>
    
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_tambah_user" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content isi_modal">
      
    </div>
  </div>
</div>

<input type="hidden" name="id_bpr" id="id_bpr">
<input type="hidden" name="level" id="level">

<script>

    $(document).ready(function () {

        // 28-01-2020
        var tabel_reg_user = $('#tabel_reg_user').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url('C_register_user/tampil_data_bpr') ?>",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            }],
            "scrollX"           : true

        })

        // 28-01-2020
        // var tabel_user = $('#tabel_user').DataTable({
        //     "processing"        : true,
        //     "serverSide"        : true,
        //     "order"             : [],
        //     "ajax"              : {
        //         "url"   : "<?= base_url('C_register_user/tampil_data_user') ?>",
        //         "type"  : "POST",
        //         "data"  : function (data) {
        //             data.level  = $('#level').val();
        //             data.id_bpr = $('#id_bpr').val();
        //         }
        //     },
        //     "columnDefs"        : [{
        //         "targets"   : [0,6],
        //         "orderable" : false
        //     }, {
        //         'targets'   : [0,6],
        //         'className' : 'text-center',
        //     }]

        // })

        // 28-04-2020 && 28-01-2021

        // menampilkan modal tambah user manager
        $('#tabel_reg_user').on('click', '.tambah_user', function () {

            var id_bpr  = $(this).attr('id_bpr');
            var level   = $(this).attr('level');

            $('#id_bpr').val(id_bpr);
            $('#level').val(level);

            var tabel_user = $('.tabel_user').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "<?= base_url('C_register_user/tampil_data_bpr') ?>",
                    "type"  : "POST",
                    "data"  : function (data) {
                        data.level  = $('#level').val();
                        data.id_bpr = $('#id_bpr').val();
                    }
                }, 
                "columnDefs"        : [{
                    "targets"   : [0],
                    "orderable" : false
                }, {
                    'targets'   : [0],
                    'className' : 'text-center',
                }],
                "bDestroy"  : true

            })

            $.ajax({
                url     : "<?= base_url() ?>C_register_user/modal_user",
                type    : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data    : {id_bpr:id_bpr, level:level},
                success : function (data) {

                    swal.close();

                    $('.isi_modal').html(data);

                    tabel_user.ajax.reload(null, false);
                    
                    $('#modal_tambah_user').modal('show');

                }
            })
            
        })
        
    })

</script>