<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <a href="tambah_pks" class="btn float-right text-white" style="background-color: #02a4af" id="tambah_bpr">Tambah Data</a>
                <h4 id="judul" class="font-weight-bold">PKS BPR</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-striped" id="tabel_pks" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nomor SPK</th>
                            <th width="20%">Nomor Penawaran</th>
                            <th width="20%">Nama BPR</th>
                            <th width="20%">Nama Asuransi</th>
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

<div id="modal_pks" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Tambah SPK BPR</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Nomor SPK</label>
                    <div class="col-sm-9">
                        <input type="text" style="font-size: 14px;" id="no_spk" name="no_spk" class="form-control" placeholder="Masukkan No SPK">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Nama BPR</label>
                    <div class="col-sm-9">
                        <input type="text" style="font-size: 14px;" id="nama_bpr" name="nama_bpr" class="form-control" placeholder="Masukkan Nama BPR">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Nomor Penawaran</label>
                    <div class="col-sm-9">
                        <input type="text" style="font-size: 14px;" id="no_penawaran" name="no_penawaran" class="form-control" placeholder="Masukkan Nomor Penawaran">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Dokumen Penawaran</label>
                    <div class="col-sm-9">
                        <input type="file" style="font-size: 14px;" id="dok_penawaran" name="dok_penawaran" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" style="font-size: 14px;" id="email" name="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Kontak</label>
                    <div class="col-sm-9">
                        <input type="text" style="font-size: 14px;" id="kontak" name="kontak" class="form-control" placeholder="Masukkan Kontak">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_spk" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <textarea type="text" style="font-size: 14px;" id="kontak" name="kontak" class="form-control" placeholder="Masukkan Alamat" cols="10" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn text-white" style="background-color: #02a4af" id="simpan_pks">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#tambah_pks').on('click', function () {

            $('#modal_pks').modal('show');

        })

        var tabel_pks = $('#tabel_pks').DataTable({
          "processing"    : true,
          "ajax"              : {
              "url"   : "<?= base_url() ?>C_pks/tampil_data_pks",
              "type"  : "POST"
          },
          stateSave       : true,
          "order"         : [[ 0, 'asc']],
          "columnDefs"     : [{
              "targets"       : [0,5],
              "orderable"     : false
          }, {
              "targets"       : [0,5],
              "className"     : "text-center"
          }]

        });

        // 01-04-2021
        $('#tabel_pks').on('click', '.hapus', function () {

            var id_pks = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data pks?',
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
                        url         : "<?= base_url() ?>C_pks/hapus_pks",
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
                        data        : {id_pks:id_pks},
                        dataType    : "JSON",
                        success     : function (data) {

                            tabel_pks.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus data',
                                text                : 'Data PKS Berhasil Dihapus',
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
                            text                : 'Anda membatalkan hapus data pks',
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
