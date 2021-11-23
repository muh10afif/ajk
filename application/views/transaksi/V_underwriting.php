<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_udw">Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold">Underwriting</h4>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="id_asuransi" class="col-sm-3 col-form-label">Asuransi</label>
                            <div class="col-sm-9">
                                <select name="id_asuransi" id="id_asuransi" data-allow-clear="true" placeholder="Pilih Asuransi">
                                    <option value="">-</option>
                                    <?php foreach ($asuransi as $s): ?>
                                        <option value="<?= $s['id_asuransi'] ?>"><?= $s['nama_asuransi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <table class="table table-bordered table-hover" id="tabel_udw" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Asuransi</th>
                            <th width="20%">Status</th>
                            <th width="20%">Jenis Dokumen</th>
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

<!-- Modal -->
<div class="modal fade" id="modal_udw" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #02a4af">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Underwriting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form id="form_udw" method="post" autocomplete="off">
            <input type="hidden" name="id_udw" id="id_udw">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="id_asuransi_2" class="col-sm-3 col-form-label">Asuransi</label>
                        <div class="col-sm-9 f_id_asuransi">
                            <select name="id_asuransi_tambah" id="id_asuransi_tambah" data-allow-clear="true" placeholder="Pilih Asuransi">
                                <option value="">-</option>
                                <?php foreach ($asuransi as $s): ?>
                                    <option value="<?= $s['id_asuransi'] ?>"><?= $s['nama_asuransi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-9 f_asuransi" hidden></div>
                        <input type="hidden" id="e_id_asuransi">
                    </div>
                    <div class="form-group row">
                        <label for="nama_bpr" class="col-sm-3 col-form-label">Status Underwriting</label>
                        <div class="col-sm-9 gif" hidden>
                            <div class="row d-flex justify-content-center" >
                                <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="50%">
                            </div>
                        </div>
                        <div class="col-sm-9 nama_status">
                            <select name="status" id="status" data-allow-clear="true" placeholder="Pilih Status" disabled>
                                
                            </select>
                        </div>
                        <div class="col-sm-9 f_nama" hidden></div>
                        <input type="hidden" id="e_status">
                    </div>
                    <div class="form-group row">
                        <label for="nama_bpr" class="col-sm-3 col-form-label">Jenis Dokumen</label>
                        <div class="col-sm-9">
                            <select name="jenis_dokumen" id="jenis_dokumen" class="form-control select2" multiple="" disabled>
                                <?php foreach ($jenis_dok as $j): ?>
                                    <option value="<?= $j['id_dok_underwriting'] ?>"><?= $j['jenis_dokumen'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn text-white" style="background-color: #02a4af" id="simpan_udw">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        // 07-02-2021
        var tabel_udw = $('#tabel_udw').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>C_transaksi/tampil_udw",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_asuransi = $('#id_asuransi').val();
                }
            },

            "columnDefs"        : [{
                "targets"   : [0,3,4],
                "orderable" : false
            }, {
                'targets'   : [0,3,4],
                'className' : 'text-center',
            }]

        })

        // 07-02-2021
        $('#tambah_udw').on('click', function () {

            $('.f_id_asuransi').attr('hidden', false);
            $('.nama_status').attr('hidden', false);
            $('.f_asuransi').attr('hidden', true);
            $('.f_nama').attr('hidden', true);
            $('#e_id_asuransi').val('');
            $('#e_status').val('');

            $('#form_udw').trigger('reset');
            $('#id_asuransi_tambah').val('').trigger('change');
            $('#status').val('').trigger('change');
            $('#jenis_dokumen').val('').trigger('change');
            $('#aksi').val('Tambah');
            $('#modal_udw').modal('show');
        })

        // 07-02-2021
        $('#id_asuransi').on('change', function () {

            tabel_udw.ajax.reload(null, false);
            
        })

        // 07-02-2021
        $('#id_asuransi_tambah').on('change', function () {

            var id_asuransi = $(this).val();
            var aksi        = $('#aksi').val();

            $('.nama_status').attr('hidden', true);
            $('.gif').attr('hidden', false);

            // ambil umkm
            $.ajax({
                url     : "<?= base_url() ?>C_transaksi/ambil_status_udw",
                method  : "POST",
                data    : {id_asuransi:id_asuransi},
                dataType: "JSON",
                success : function (data) {

                    $('.nama_status').attr('hidden', false);
                    $('.gif').attr('hidden', true);

                    $('#status').html(data.option);

                    if (aksi == 'Tambah') {
                        if (id_asuransi == '') {
                            $('#status').attr('disabled', true);
                            $('#jenis_dokumen').attr('disabled', true);
                        } else {
                            $('#status').attr('disabled', false);
                            $('#jenis_dokumen').attr('disabled', false);
                        }   
                    }

                    
                }
            })

            return false;
            
        })

        // 07-02-2021
        $('#status').on('change', function () {

            var id_status = $(this).val();

            if (id_status == null) {
                $('#jenis_dokumen').attr('disabled', true);
            } else {
                $('#jenis_dokumen').attr('disabled', false);
            }
        })
        
        // 07-02-2021
        $('#simpan_udw').on('click', function () {

            var form_udw        = $('#form_udw').serialize();
            var aksi            = $('#aksi').val();

            var id_asuransi     = $('#id_asuransi_tambah').val();
            var status          = $('#status').val();
            var jenis_dok       = $('#jenis_dokumen').val();

            var e_id_asuransi   = $('#e_id_asuransi').val();
            var e_status        = $('#e_status').val();

            var jenis_dokumen   = JSON.stringify(jenis_dok);

            if (aksi == 'Tambah') {
                var str = id_asuransi == '' || status == null || jenis_dok.length == 0;
            } else {
                var str = jenis_dok.length == 0;
            }

            if (str) {

                swal({
                    title               : 'Peringatan',
                    text                : 'Harap isi semua data!',
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    type                : 'error',
                    showConfirmButton   : true,
                    timer               : 8000
                }); 
                
            } else {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan kirim data',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    cancelButtonClass   : "btn btn-warning mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Ya',
                    confirmButtonColor  : '#3085d6',
                    cancelButtonColor   : '#d33',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "simpan_data_udw",
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
                            data    : {aksi:aksi, status:status, jenis_dokumen:jenis_dokumen, id_asuransi_tambah:id_asuransi, e_id_asuransi:e_id_asuransi, e_status:e_status},
                            dataType: "JSON",
                            success : function (data) {

                                $('#modal_udw').modal('hide');
                                    
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_udw.ajax.reload(null,false);        
                                
                                $('#form_udw').trigger("reset");
                
                                $('#aksi').val('Tambah');
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                            title               : "Batal",
                            text                : 'Anda membatalkan simpan data',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 
                    }
                })

                return false;

            }
            
        })

        // 07-02-2021
        $('#tabel_udw').on('click', '.edit', function () {

            var id_asuransi     = $(this).attr('id_asuransi');
            var nama_asuransi   = $(this).attr('nama_asuransi');
            var id_status       = $(this).attr('id_status_udw');
            var status_udw      = $(this).attr('status_udw');

            $('#aksi').val('Ubah');
            $('#jenis_dokumen').attr('disabled', false);

            $('.f_id_asuransi').attr('hidden', true);
            $('.nama_status').attr('hidden', true);
            $('.f_asuransi').attr('hidden', false).text(': '+nama_asuransi);
            $('.f_nama').attr('hidden', false).text(': '+status_udw);
            $('#e_id_asuransi').val(id_asuransi);
            $('#e_status').val(id_status);
            $('#modal_udw').modal('show');

            // ambil umkm
            $.ajax({
                url     : "ambil_selected_jenis_dok",
                method  : "POST",
                data    : {id_asuransi:id_asuransi, id_status:id_status},
                dataType: "JSON",
                success : function (data) {
                    
                    $('#jenis_dokumen').val(data.selected).trigger('change');

                }
            })

            return false;
            
        })

        // 07-02-2021
        $('#tabel_udw').on('click', '.hapus', function () {

            var id_asuransi   = $(this).attr('id_asuransi');
            var nama_asuransi = $(this).attr('nama_asuransi');
            var id_status     = $(this).attr('id_status_udw');
            var status        = $(this).attr('status_udw');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data '+nama_asuransi+' status '+status+'?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "simpan_data_udw",
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
                        data        : {aksi:'Hapus', id_asuransi_tambah:id_asuransi, status:id_status},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_udw.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus Data',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                    
                                
                                $('#form_udw').trigger("reset");

                                $('#aksi').val('Tambah');
                            
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
                            text                : 'Anda membatalkan hapus data',
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