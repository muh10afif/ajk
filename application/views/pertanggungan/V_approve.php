<div class="row f_tiga">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item" style="color: #02a4af">Detail Debitur Tertanggung</li>
                <li class="breadcrumb-item active" aria-current="page">Approve</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <form action="<?= base_url('C_pertanggungan/lihat_debitur_ptg') ?>" method="POST">
            <input type="hidden" name="id_pks" value="<?= $id_pks ?>">
            <input type="hidden" name="id_bpr" value="<?= $id_bpr ?>">
            <input type="hidden" name="nama_bpr" class="nama_bpr" value="<?= $nama_bpr ?>">
            <input type="hidden" name="nomor_pks" class="nomor_pks" value="<?= $nomor_pks ?>">
            <input type="hidden" name="kode_ptg" class="kode_ptg" value="<?= $kode_ptg ?>">
            <button class="btn mb-3 float-right kembali_dua" style="background-color: #02a4af; color:white;" type="submit"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
        </form>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-sm-6 col-form-label">Kode Tertanggung</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold">: <?= $kode_ptg ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label class="col-sm-6 col-form-label">Nama Debitur</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold">: <?= $nama_deb ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped tabel_tertanggung_as" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="">Jenis Produk</th>
                            <th width="">Jenis Tanggung</th>
                            <th width="">Jenis Resiko</th>
                            <th width="">Uang Pertanggungan</th>
                            <th width="">Status Cash</th>
                            <th width="">Status Polish</th>
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

<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header text-white" style="background-color: #02a4af">
            <h5 class="modal-title font-weight-bold" id="judul_modal">Detail Polish</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
            </button>
        </div>
            
            <input type="hidden" name="id_resiko_ptg" class="id_resiko_ptg">
            <div class="modal-body">
                <div class="d-flex justify-content-center p-3">
                    <div class="col-md-9">

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Kode Tertanggung</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_kode_ttg">:</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nama Debitur</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_nama_debitur">:</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Kredit</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_jenis_kredit">:</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Produk</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_jenis_produk">:</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Tertanggung</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_tertanggung">:</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Resiko</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_jenis_resiko">:</span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Uang Pertanggungan</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_uang_ptg">:</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Masa Asuransi</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_masa_asuransi">:</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Premi</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_premi">:</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Status Underwriting</label>
                            <div class="col-sm-8 mt-2">
                                <span class="font-weight-bold t_status_udw">:</span>
                            </div>
                        </div>

                        <div class="table-responsive f_cbc">
                            Dokumen CBC
                            <table class="table table-bordered table-striped tabel_dokumen" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="">Jenis Dokumen</th>
                                        <th width="10%">File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-2 f_tambahan">
                            Dokumen Tambahan
                            <table class="table table-bordered table-striped tabel_tambahan" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="">Jenis Dokumen</th>
                                        <th width="10%">File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group row mt-3">
                            <label class="col-sm-4 col-form-label mt-1">Status Approve</label>
                            <div class="col-sm-8 mt-2 f_t_approve">
                                <span class="font-weight-bold t_status_polish">:</span>
                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_approve" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header text-white" style="background-color: #02a4af">
            <h5 class="modal-title font-weight-bold" id="judul_modal">Approve Polish</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
            </button>
        </div>
            <form id="form_dokumen" action="<?= base_url('C_pertanggungan/simpan_approve') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id_ptg" value="<?= $id_ptg ?>">
                <input type="hidden" name="id_resiko_ptg" id="id_resiko_ptg">
                <div class="modal-body">
                    <div class="d-flex justify-content-center p-3">
                        <div class="col-md-9">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Kode Tertanggung</label>
                                <div class="col-sm-8 mt-2">
                                    <span class="font-weight-bold t_kode_ttg">:</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Debitur</label>
                                <div class="col-sm-8 mt-2">
                                    <span class="font-weight-bold t_nama_debitur">:</span>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-sm-4 col-form-label mt-1">Status Approve</label>
                                <div class="col-sm-8 mt-2">
                                    <select name="sel_approve" id="sel_approve" data-allow-clear="1" placeholder="Pilih Approve" required>
                                        <?php foreach ($st_approve as $s): ?>
                                            <option value="<?= $s['id_status_polish'] ?>"><?= $s['status_polish'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row f_dok_tambah" style="display: none;">
                                <label class="col-sm-4 col-form-label">Dokumen Tambahan</label>
                                <div class="col-sm-8 mt-2 f_tambah">
                                    <!-- <div class="row">
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control dok_tambahan" style="font-size: 14px;" name="dok_tambahan[]"> </div>
                                        <div class="col-sm-3 text-left">
                                            <button type="button" class="btn btn-success add_form_field">Tambah</button>
                                        </div>
                                    </div> -->
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #02a4af">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        var tabel_tertanggung_as = $('.tabel_tertanggung_as').DataTable({
            "processing"    : true,
            "ajax"          : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_approve",
                "type"  : "POST",
                "data"  : function (data) {
                    data.kode_ptg = $('.kode_ptg').val();
                }
            },
            stateSave       : true,
            "paging"        : false,
            "info"          : false,
            "searching"     : false,
            "columnDefs"     : [{
                "targets"       : [0,7],
                "orderable"     : false
            }, {
                "targets"       : [0,5,6,7],
                "className"     : "text-center"
            }]
        });

        var tabel_dokumen = $('.tabel_dokumen').DataTable({
            "processing"    : true,
            "ajax"          : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_dokumen_as",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_resiko_ptg = $('#id_resiko_ptg').val();
                }
            },
            stateSave       : true,
            "paging"        : false,
            "info"          : false,
            "searching"     : false,
            "columnDefs"     : [{
                "targets"       : [0,1,2],
                "orderable"     : false
            }, {
                "targets"       : [0],
                "className"     : "text-center"
            }]
        });

        var tabel_tambahan = $('.tabel_tambahan').DataTable({
            "processing"    : true,
            "ajax"          : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_dokumen_tambahan",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_resiko_ptg = $('#id_resiko_ptg').val();
                }
            },
            stateSave       : true,
            "paging"        : false,
            "info"          : false,
            "searching"     : false,
            "columnDefs"     : [{
                "targets"       : [0,1,2],
                "orderable"     : false
            }, {
                "targets"       : [0],
                "className"     : "text-center"
            }]
        });

        // 25-03-2021
        $('.tabel_tertanggung_as').on('click', '.konfirm', function () {

            $('#sel_approve').val('').trigger('change');
            
            var id_resiko_ptg = $(this).data('id');

            $.ajax({
                url     : "<?= base_url() ?>C_pertanggungan/tampil_detail_approve",
                method  : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data    : {id_resiko_ptg:id_resiko_ptg},
                dataType: "JSON",
                success : function (data) {

                    console.log(data);

                    swal.close();

                    $('.t_kode_ttg').text(": "+data.t_kode_ttg);
                    $('.t_nama_debitur').text(": "+data.t_nama_debitur);

                    $('#id_resiko_ptg').val(id_resiko_ptg);
                    $('#sel_approve').val(data.id_status_polish).trigger('change');

                    $('.f_tambah').html(data.html_dok_tambah);

                    $('#modal_approve').modal('show');
                }
            })
            
        })

        // 25-03-2021
        $('.tabel_tertanggung_as').on('click', '.detail', function () {

            $('.f_t_approve').attr('hidden', false);
            $('.f_approve').attr('hidden', true);

            var id_resiko_ptg = $(this).data('id');

            $.ajax({
                url     : "<?= base_url() ?>C_pertanggungan/tampil_detail_approve",
                method  : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Data',
                        onOpen  : () => {
                            swal.showLoading();
                        }
                    })
                },
                data    : {id_resiko_ptg:id_resiko_ptg},
                dataType: "JSON",
                success : function (data) {

                    swal.close();

                    $('.t_kode_ttg').text(": "+data.t_kode_ttg);
                    $('.t_nama_debitur').text(": "+data.t_nama_debitur);
                    $('.t_jenis_kredit').text(": "+data.t_jenis_kredit);
                    $('.t_jenis_produk').text(": "+data.t_jenis_produk);
                    $('.t_tertanggung').text(": "+data.t_tertanggung);
                    $('.t_jenis_resiko').text(": "+data.t_jenis_resiko);
                    $('.t_uang_ptg').text(": "+data.t_uang_ptg);
                    $('.t_masa_asuransi').text(": "+data.t_masa_asuransi+' Tahun');
                    $('.t_premi').text(": Rp. "+data.t_premi);
                    $('.t_status_udw').text(": "+data.t_status_udw);
                    $('.t_status_polish').text((data.t_status_polish == null) ? ': Belum ada aksi approve' : ": "+data.t_status_polish);

                    $('#id_resiko_ptg').val(id_resiko_ptg);

                    if (data.id_status_cash == 1) {
                        $('.f_cbc').attr('hidden', true); 
                    } else {
                        $('.f_cbc').attr('hidden', false);
                    }

                    if (data.c_dok_tmb > 0) {
                        $('.f_tambahan').attr('hidden', false);
                    } else {
                       $('.f_tambahan').attr('hidden', true); 
                    }

                    $('#modal_detail').modal('show');

                    tabel_dokumen.ajax.reload(null, false)
                    tabel_tambahan.ajax.reload(null, false)
                }
            })

            

        })

        // 25-03-2021
        $('#sel_approve').on('change', function () {

            var id = $(this).val();

            if (id == 3) {
                $('.f_dok_tambah').slideDown('fast');
                $('.dok_tambahan').prop('required', true);
            } else {
                $('.f_dok_tambah').slideUp('fast');
                $('.dok_tambahan').prop('required', false);
            }
            
        })

        // 25-03-2021
        var max_fields      = 10;
        var wrapper         = $(".f_tambah");
        var add_button      = $(".add_form_field");
    
        var x = 1;
        $(wrapper).on("click",".add_form_field", function(e){
            e.preventDefault();
            
            if(x < max_fields){
                x++;
                var bn = `<div class="row f_delete`+x+` mt-1">
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control dok_tambahan" style="font-size: 14px;" name="dok_tambahan[]"> </div>
                                        <div class="col-sm-3 text-left">
                                            <button type="button" class="btn btn-danger delete" data-id="`+x+`">Hapus</button>
                                        </div>
                                    </div>`;

                $(wrapper).append(bn);

                $('.dok_tambahan').prop('required', true);
            }
            else
            {
            alert('Maksimal 10 data inputan.')
            }
        });
            
        $(wrapper).on("click",".delete", function(e){
            var id = $(this).data('id');

            e.preventDefault(); 
            $('.f_delete'+id).remove(); 
            x--;
        })
    })

</script>