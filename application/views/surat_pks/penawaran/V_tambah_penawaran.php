<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">

                <a href="<?= base_url('C_pks/penawaran') ?>"><button class="btn float-right text-white" style="background-color: #02a4af">Kembali</button></a>

                <h4 id="judul" class="font-weight-bold">Tambah Penawaran</h4>
                
            </div>
            <div class="card-body table-responsive">

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">

                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Nomor Penawaran</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="no_penawaran" name="no_penawaran" class="form-control" value="<?= $kode ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Nama BPR</label>
                            <div class="col-sm-9">
                                <select data-allow-clear="true" name="nama_bpr" id="nama_bpr" placeholder="Pilih BPR">
                                    <option value=""></option>
                                    <?php foreach ($bpr as $b): ?>
                                        <option value="<?= $b['id_bpr'] ?>"><?= $b['nama_bpr'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Asuransi</label>
                            <div class="col-sm-9">
                                <select data-allow-clear="true" name="nama_asuransi" id="nama_asuransi" placeholder="Pilih Asuransi">
                                    <?php foreach ($asuransi as $a): ?>
                                        <option value="<?= $a['id_asuransi'] ?>"><?= $a['nama_asuransi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Kode Klausal Asuransi</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-9">
                                        <select data-allow-clear="true" name="kode_klausul" id="kode_klausul" placeholder="Pilih Kode Klausul" disabled>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary mt-1" id="lihat_klausul" disabled>Lihat Klausul</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="button" class="btn btn-primary" style="background-color: #02a4af" id="simpan_penawaran">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_lihat" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content f_lihat">
      
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        $('#nama_asuransi').val('').trigger('change');

        // 03-02-2021
        $('#lihat_klausul').on('click', function () {

            var kode_klausul = $('#kode_klausul').val();

            $.ajax({

                url         : "<?= base_url() ?>C_pks/lihat_klausul",
                method      : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data        : {kode_klausul:kode_klausul},
                success     : function (data) {

                    swal.close();

                    $('.f_lihat').html(data);
                    $('#modal_lihat').modal('show');
                    
                }
            })
            
            return false;
        })

        // 08-02-2021
        $('#nama_asuransi').on('change', function () {

            var id_asuransi = $(this).val();

            $.ajax({

                url         : "<?= base_url() ?>C_pks/tampil_sel_klausul",
                method      : "POST",
                data        : {id_asuransi:id_asuransi},
                dataType    : "JSON",
                success     : function (data) {

                    $('#kode_klausul').html(data.option);

                    if (id_asuransi == '') {
                        $('#kode_klausul').attr('disabled', true);
                    } else {
                        $('#kode_klausul').attr('disabled', false);
                    }
                    $('#lihat_klausul').attr('disabled', true);
                }

                
            })

            return false;
            
        })

        // 08-02-2021
        $('#kode_klausul').on('change', function () {
            
            var id_klausul = $(this).val();

            if (id_klausul == '') {

                $('#lihat_klausul').attr('disabled', true);
                
            } else {
                $('#lihat_klausul').attr('disabled', false);
            }
            
        })

        // 08-02-2021
        $('#simpan_penawaran').on('click', function () {
            
            var no_penawaran    = $('#no_penawaran').val();
            var nama_bpr        = $('#nama_bpr').val();
            var nama_asuransi   = $('#nama_asuransi').val();
            var kode_klausul    = $('#kode_klausul').val();

            if (nama_bpr == '' || nama_asuransi == '' || kode_klausul == null || kode_klausul == '') {

                swal({
                    title               : 'Peringatan',
                    text                : 'Harap isi semua data!',
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    type                : 'error',
                    showConfirmButton   : true,
                    timer               : 8000
                }); 

                return false;
                
            } else {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan simpan data?',
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
                            url     : "simpan_penawaran",
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
                            data    : {aksi:'Tambah', id_bpr:nama_bpr, id_asuransi:nama_asuransi, kode_klausul:kode_klausul, nomor_penawaran:no_penawaran},
                            dataType: "JSON",
                            success : function (data) {
                                    
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 5000
                                });    
                
                                window.location = 'penawaran';
                                
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
        
    })

</script>