<style>
    @media (min-width: 1200px) {
    .modal {
            width: 50%; 
            left: 25%;
        }
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right text-white" style="background-color: #02a4af" id="tambah_bpr" data-toggle="modal" data-target="#modal_bpr">Tambah Data</button>
            
                <h4 id="judul" class="font-weight-bold">Master Data BPR</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_bpr" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama BPR</th>
                            <th width="20%">Email</th>
                            <th width="20%">Kontak</th>
                            <th width="20%">Alamat</th>
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
<div class="modal fade" id="modal_bpr" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #02a4af">
        <h5 class="modal-title font-weight-bold" id="judul_modal">Tambah Data BPR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
        </button>
      </div>
        <form id="form_bpr" autocomplete="off">
            <input type="hidden" name="id_bpr" id="id_bpr">
            <input type="hidden" name="aksi" id="aksi" value="Tambah">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="nama_bpr" class="col-sm-3 col-form-label">Nama BPR</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="nama_bpr" id="nama_bpr" placeholder="Masukkan Nama BPR">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" style="font-size: 14px;" name="email" id="email" placeholder="Masukkan Tanggal Email">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="kontak" class="col-sm-3 col-form-label">Kontak</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="kontak" id="kontak" placeholder="Masukkan No Kontak">
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" style="font-size: 14px;" name="alamat" id="alamat" placeholder="Masukkan Nama Alamat" rows="3"></textarea>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label nomor_text">Nomor SPK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nomor_spk" id="nomor_spk" style="font-size: 14px;" placeholder="Masukkan Nomor SPK">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kontak" class="col-sm-3 col-form-label">No. Surat Penawaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" style="font-size: 14px;" name="no_surat_penawaran" id="no_surat_penawaran" placeholder="Masukkan Nomor Surat Penawaran">
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn text-white" style="background-color: #02a4af" id="simpan_bpr">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_spk" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content isi_modal">
      
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        // 05-04-2020

            $('.tabel_detail_spk').DataTable();

            // menampilkan list bpr
            var tabel_bpr = $('#tabel_bpr').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "tampil_data_bpr",
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
            $('#tambah_bpr').on('click', function () {
                $('#form_bpr').trigger('reset');
                $('#aksi').val('Tambah');
                $('#modal_bpr').modal('show');
            })

            // aksi simpan data bpr
            $('#simpan_bpr').on('click', function () {

                var form_bpr    = $('#form_bpr').serialize();
                var nama_bpr    = $('#nama_bpr').val();

                if (nama_bpr == '') {

                    swal({
                        title               : "Peringatan",
                        text                : 'Nama Bpr harus terisi !',
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
                                url     : "simpan_data_bpr",
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
                                data    : form_bpr,
                                dataType: "JSON",
                                success : function (data) {

                                    $('#modal_bpr').modal('hide');
                                    
                                    swal({
                                        title               : "Berhasil",
                                        text                : 'Data berhasil disimpan',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });    
                    
                                    tabel_bpr.ajax.reload(null,false);        
                                    
                                    $('#form_bpr').trigger("reset");
                    
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

            // edit data bpr
            $('#tabel_bpr').on('click', '.edit-bpr', function () {

                var id_bpr  = $(this).data('id');

                $.ajax({
                    url         : "ambil_data_bpr/"+id_bpr,
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

                        $('#modal_bpr').modal('show');
                        
                        $('#id_bpr').val(data.id_bpr);

                        $('#nama_bpr').val(data.nama_bpr);
                        $('#email').val(data.email);
                        $('#kontak').val(data.kontak);
                        $('#alamat').val(data.alamat);

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

            // hapus bpr
            $('#tabel_bpr').on('click', '.hapus-bpr', function () {

                var id_bpr = $(this).data('id');
            
                var nama   = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus data '+nama+' ?',
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
                            url         : "simpan_data_bpr",
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
                            data        : {aksi:'Hapus', id_bpr:id_bpr},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_bpr.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus Bpr',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_bpr').trigger("reset");

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
                                text                : 'Anda membatalkan hapus Bpr',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 
                    }
                })

            })

            // menampilkan spk bpr
            $('#tabel_bpr').on('click', '.detail-spk-bpr', function () {
                
                $('#modal_spk').modal('show');

                var id_bpr = $(this).data('id');

                $.ajax({
                    url     : "ambil_detail_spk",
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
                    data    : {id_bpr:id_bpr},
                    success : function (data) {

                        swal.close();

                        $('.isi_modal').html(data);
                        
                        $('#modal_spk').modal('show');

                    }
                })

            })
        
    })

</script>