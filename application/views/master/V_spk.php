<style>
    @media (min-width: 1200px) {
        #modal_spk {
            width: 50%; 
            left: 25%;
        }
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_spk">Tambah Data</button>

                <h4 id="judul" class="font-weight-bold">Data SPK</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_spk" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">No SPK</th>
                            <th width="10%">Nama BPR</th>
                            <th width="10%">Tanggal Dimulai</th>
                            <th width="10%">Tanggal Berakhir</th>
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
<div class="modal fade" id="modal_spk" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #02a4af">
        <h5 class="modal-title" id="judul_modal">Tambah Data SPK</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form id="form_spk" autocomplete="off">
            <input type="hidden" name="id_spk" id="id_spk">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-10 offset-md-1">
                    <div class="form-group row">
                        <label for="no_spk" class="col-sm-3 col-form-label">Nomor SPK</label>
                        <div class="col-sm-9">
                            <input type="text" style="font-size: 14px;" id="no_spk" name="no_spk" class="form-control" placeholder="Masukkan Nomor SPK">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="id_bpr" class="col-sm-3 col-form-label">Nama BPR</label>
                        <div class="col-sm-9">
                            <select name="id_bpr" id="id_bpr" data-allow-clear="1" placeholder="Pilih Nama BPR">
                                <?php foreach ($bpr as $b): ?>
                                    <option value="<?= $b['id_bpr'] ?>"><?= $b['nama_bpr'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Dimulai</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control datepicker2" style="font-size: 14px;" name="tgl_mulai" id="tgl_mulai" placeholder="Masukkan Tanggal Dimulai" readonly>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_berakhir" class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control datepicker2" style="font-size: 14px;" name="tgl_berakhir" id="tgl_berakhir" placeholder="Masukkan Tanggal Berakhir" readonly>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn text-white" style="background-color: #02a4af" id="simpan_spk">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>

    $(document).ready(function() {

        // 05-04-2020

            // menampilkan list jabatan
            var tabel_spk = $('#tabel_spk').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "tampil_data_spk",
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

            // menampilkan modal tambah dt_in_projek
            $('#tambah_spk').on('click', function () {
                $('#form_spk').trigger('reset');
                $('#aksi').val('Tambah');
                $('#modal_spk').modal('show');
                $('#id_bpr').select2('val', ' ');
                $('#tgl_dimulai').datepicker('setDate', null);
                $('#tgl_berakhir').datepicker('setDate', null);
            })

            // aksi simpan data spk
            $('#simpan_spk').on('click', function () {

                var form_spk    = $('#form_spk').serialize();
                var no_spk      = $('#no_spk').val();
                var id_bpr      = $('#id_bpr').val();

                if (no_spk == '') {

                    swal({
                        title               : "Peringatan",
                        text                : 'Nomor SPK harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;

                } else if (id_bpr == null) {

                    swal({
                        title               : "Peringatan",
                        text                : 'BPR harus terisi !',
                        buttonsStyling      : false,
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 

                    return false;

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
                                url     : "simpan_data_spk",
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
                                data    : form_spk,
                                dataType: "JSON",
                                success : function (data) {

                                    $('#modal_spk').modal('hide');
                                    
                                    swal({
                                        title               : "Berhasil",
                                        text                : 'Data berhasil disimpan',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });    
                    
                                    tabel_spk.ajax.reload(null,false);        
                                    
                                    $('#form_spk').trigger("reset");

                                    $('#tgl_mulai').datepicker('setDate', null);
                                    $('#tgl_berakhir').datepicker('setDate', null);
                    
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

            // edit data spk
            $('#tabel_spk').on('click', '.edit-spk', function () {

                var id_spk  = $(this).data('id');

                $.ajax({
                    url         : "ambil_data_spk/"+id_spk,
                    type        : "GET",
                    beforeSend  : function () {
                        swal({
                            title   : 'Menunggu',
                            html    : 'Memproses Data',
                            onOpen  : () => {
                                swal.showLoading();
                            }
                        })
                    },
                    dataType    : "JSON",
                    success     : function(data)
                    {
                        swal.close();

                        $('#modal_spk').modal('show');
                        
                        $('#id_spk').val(data.id_spk);
                        $('#id_bpr').val(data.id_bpr).trigger('change');

                        $('#no_spk').val(data.no_spk);

                        $('#tgl_mulai').datepicker('setDate', data[0].tgl_mulai);
                        $('#tgl_berakhir').datepicker('setDate', data[0].tgl_berakhir);

                        $('#aksi').val('Ubah');

                        return false;

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                })

                return false;

            })

            // hapus spk
            $('#tabel_spk').on('click', '.hapus-spk', function () {

                var id_spk = $(this).data('id');

                console.log(id_spk);

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus data',
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
                            url         : "simpan_data_spk",
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
                            data        : {aksi:'Hapus', id_spk:id_spk},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_spk.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus SPK',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_spk').trigger("reset");

                                    $('#tgl_mulai').datepicker('setDate', data[0].tgl_mulai);
                                    $('#tgl_berakhir').datepicker('setDate', data[0].tgl_berakhir);

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
                                text                : 'Anda membatalkan hapus spk',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 
                    }
                })

            })

    });

</script>