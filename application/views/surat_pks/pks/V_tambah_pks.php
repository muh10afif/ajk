<div class="row">
    <div class="col-md-12">
        <form id="form_pks" method="post" action="<?=$link?>" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" id="socid" name="socid" value="<?=isset($data->id_soc)?$data->id_soc:0?>">
            <input type="hidden" id="id_pks" name="id_pks" value="<?=isset($data->id_pks)?$data->id_pks:0?>">
            <input type="hidden" id="idnopenawar" name="idnopenawar" value="<?=isset($data->id_penawaran)?$data->id_penawaran:''?>">
            <div class="card">
                <div class="card-header p-3">

                    <a href="<?= base_url('C_pks/pks') ?>"><button type="button" class="btn float-right text-white" style="background-color: #02a4af">Kembali</button></a>

                    <h4 id="judul" class="font-weight-bold">Tambah PKS BPR</h4>
                    
                </div>
                <div class="card-body table-responsive">

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-8">

                            <div class="form-group row">
                                <label for="no_pks" class="col-sm-3 col-form-label">Nomor PKS</label>
                                <div class="col-sm-9">
                                    <input type="text" style="font-size: 14px;" id="no_pks" name="no_pks" class="form-control" value="<?=isset($data->nomor_pks)?$data->nomor_pks: $kode ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_spk" class="col-sm-3 col-form-label">Nomor Penawaran</label>
                                <div class="col-sm-9">
                                    
                                    <div class="row">
                                        <div class="col-md-9">
                                            <select name="no_penawaran" id="no_penawaran" placeholder="Pilih Nomor Penawaran" data-allow-clear="true">
                                                <option value=""></option>
                                                <?php foreach ($no_penawaran as $a): 
                                                    
                                                    if (isset($data->id_soc)) {
                                                        if ($a['id_penawaran'] == $data->id_penawaran) {
                                                            $sel = 'selected';
                                                        } else {
                                                            $sel = '';
                                                        }
                                                    } else {
                                                        $sel = '';
                                                    }

                                                ?>
                                                    <option value="<?= $a['id_penawaran'] ?>" <?= $sel ?>><?= $a['nomor_penawaran'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-block btn-primary mt-1" id="lihat_detail" <?=isset($data->id_soc)?'':'disabled'?>>Lihat Detail</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_spk" class="col-sm-3 col-form-label">Dokumen Penawaran</label>
                                <div class="col-sm-2 mt-1">
                                    <input type="file" style="font-size: 14px;" id="dok_penawaran" onchange="nmfile(this.value)" name="dok_penawaran" value="<?=isset($data->dokumen)?$data->dokumen:''?>" hidden>
                                    <a href="javascript:void(0)" onclick="$('#dok_penawaran').click()" class="btn btn-primary">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span class="value-digit">Upload</span>
                                    </a>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" style="font-size: 14px;" id="namefile" name="namefile" class="form-control" value="<?=isset($data->dokumen)?$data->dokumen:''?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">SOC</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <input type="text" style="font-size: 14px;" id="soc" name="soc" class="form-control" placeholder="Masukkan SOC" value="<?=isset($data->soc)?$data->soc:''?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="font-weight-bold mt-2 mb-2">Detail SOC</h4>
                            <div class="form-group row">
                                <label for="komiage" class="col-sm-3 col-form-label">Komisi Agent</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control percent"  maxlength="6" style="font-size: 14px;" name="komiage" id="komiage" placeholder="Komisi Agent (%)" value="<?=isset($data->komisi_agent)?$data->komisi_agent.'%':''?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fepepo" class="col-sm-3 col-form-label">Feebase Pemegang Polis</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control percent"  maxlength="6" style="font-size: 14px;" name="fepepo" id="fepepo" placeholder="Feebase Pemegang Polis (%)" value="<?=isset($data->feebase)?$data->feebase.'%':''?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="overid" class="col-sm-3 col-form-label">Overiding</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control percent"  maxlength="6" style="font-size: 14px;" name="overid" id="overid" placeholder="Overiding (%)" value="<?=isset($data->overiding)?$data->overiding.'%':''?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="konebro" class="col-sm-3 col-form-label">Komisi Nett Broker</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control percent"  maxlength="6" style="font-size: 14px;" name="konebro" id="konebro" placeholder="Komisi Net Broker (%)" value="<?=isset($data->komisi_net_broker)?$data->komisi_net_broker.'%':''?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="judeso" class="col-sm-3 col-form-label">Jumlah Detail SOC</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control"  style="font-size: 14px;" name="judeso" id="judeso" placeholder="Jumlah detail SOC" value="<?=isset($data->jumlah_detail_soc)?$data->jumlah_detail_soc.'%':''?>" readonly>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="nefebro" class="col-sm-3 col-form-label">Nett Fee Broker</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" style="font-size: 14px;" name="nefebro" id="nefebro" placeholder="0" value="<?=isset($data->net_fee_broker)?$data->net_fee_broker:''?>" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" style="background-color: #02a4af" id="btn-simpan" <?=isset($data->id_soc)? '' : 'disabled' ?>>Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

    document.querySelector('#komiage').addEventListener('input', function(e) {
        let int = e.target.value.slice(0, e.target.value.length - 1);
        sendpercent(int, e);
    });
    document.querySelector('#fepepo').addEventListener('input', function(e) {
        let int = e.target.value.slice(0, e.target.value.length - 1);
        sendpercent(int, e);
    });
    document.querySelector('#overid').addEventListener('input', function(e) {
        let int = e.target.value.slice(0, e.target.value.length - 1);
        sendpercent(int, e);
    });
    document.querySelector('#konebro').addEventListener('input', function(e) {
        let int = e.target.value.slice(0, e.target.value.length - 1);
        sendpercent(int, e);
    });

    function sendpercent(int, e) {
        if (int.includes('%')) {
        e.target.value = '%';
        } else if (int.length >= 3 && int.length <= 4 && !int.includes('.')) {
        e.target.value = int.slice(0, 2) + '.' + int.slice(2, 3) + '%';
        e.target.setSelectionRange(4, 4);
        } else if (int.length >= 5 & int.length <= 6) {
        let whole = int.slice(0, 2);
        let fraction = int.slice(3, 5);
        e.target.value = whole + '.' + fraction + '%';
        } else {
        e.target.value = int + '%';
        e.target.setSelectionRange(e.target.value.length - 1, e.target.value.length - 1);
        }
        getInt(e.target.value)
    }

    function getInt(val) {
        let komiage = $('#komiage').val();
        let fepepo  = $('#fepepo').val();
        let overid  = $('#overid').val();
        let konebro = $('#konebro').val();

        let ge = komiage != '%' ? komiage.split('%'):0;
        let po = fepepo  != '%' ? fepepo.split('%'):0;
        let id = overid  != '%' ? overid.split('%'):0;
        let ro = konebro != '%' ? konebro.split('%'):0;

        let ko = ge[0] != ''?parseFloat(ge[0]):0;
        let fe = po[0] != ''?parseFloat(po[0]):0;
        let ov = id[0] != ''?parseFloat(id[0]):0;
        let kn = ro[0] != ''?parseFloat(ro[0]):0;

        $('#judeso').val(ko+fe+ov+kn+"%");
    }

    function nmfile(nmf) {
        let last = nmf.split("\\");
        $('#namefile').val(last[last.length-1]);
    }

$(document).ready(function () {

    $('#soc').on('keyup', function () {

        var isi     = $(this).val();
        var judeso  = $('#judeso').val().replace('%','');

        var jml = isi - judeso;

        if (jml < 0) {
        $('#btn-simpan').attr('disabled', true);
        
        } else {

            if (isi == judeso) {
                $('#btn-simpan').attr('disabled', true);
            } else {
                if (judeso == 0) {
                    $('#btn-simpan').attr('disabled', true);
                } else {
                    $('#btn-simpan').attr('disabled', false);
                }
            }
        }

        $('#nefebro').val(jml);
    })

    $('#komiage').on('keyup', function () {

        var isi     = $('#soc').val();
        var judeso  = $('#judeso').val().replace('%','');

        var jml = isi - judeso;

        if (jml < 0) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (judeso == 0) {
            $('#btn-simpan').attr('disabled', true);
        } else {
            $('#btn-simpan').attr('disabled', false);
        }
        }
        }

        $('#nefebro').val(jml);

    })

    $('#fepepo').on('keyup', function () {

        var isi     = $('#soc').val();
        var judeso  = $('#judeso').val().replace('%','');

        var jml = isi - judeso;

        if (jml < 0) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (judeso == 0) {
            $('#btn-simpan').attr('disabled', true);
        } else {
            $('#btn-simpan').attr('disabled', false);
        }
        }
        }

        $('#nefebro').val(jml);

    })

    $('#overid').on('keyup', function () {

        var isi     = $('#soc').val();
        var judeso  = $('#judeso').val().replace('%','');

        var jml = isi - judeso;

        if (jml < 0) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (judeso == 0) {
            $('#btn-simpan').attr('disabled', true);
        } else {
            $('#btn-simpan').attr('disabled', false);
        }
        }
        }

        $('#nefebro').val(jml);

    })

    $('#konebro').on('keyup', function () {

        var isi     = $('#soc').val();
        var judeso  = $('#judeso').val().replace('%','');

        var jml = isi - judeso;

        if (jml < 0) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (isi == judeso) {
        $('#btn-simpan').attr('disabled', true);
        } else {
        if (judeso == 0) {
            $('#btn-simpan').attr('disabled', true);
        } else {
            $('#btn-simpan').attr('disabled', false);
        }
        }
        }

        $('#nefebro').val(jml);

    })

    

    $('#btn-simpan').on('click', function () {
        var form_pks = $('#form_pks').serialize();
        var cek = form_pks.split("&");
        var y = 0;
        for (var i = 0; i < cek.length; i++) {
            let isi = cek[i].split("");
            let yo = isi[isi.length - 1];
            if (yo == "=") { y++; }
        }

        var form        = $('#form_pks')[0];
        var formData    = new FormData(form);

        var id_pks = $('#id_pks').val();

        var url = '';
        if (id_pks) {
            url = '<?= base_url() ?>C_pks/simpan_data_pks/';
        } else {
            url = '<?= base_url() ?>C_pks/edit_data_pks/'+id_pks;
        }

        if (y == 1) {
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
                        url         : url,
                        cache       : false,
                        contentType : false,
                        processData : false,
                        data        : formData,
                        type        : 'post',
                        dataType    : "JSON",
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
            
                            window.location = '<?= base_url() ?>C_pks/pks';
                            
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

        } else {
        swal({
            title               : "Peringatan",
            text                : 'Ada Data Yang tidak di Isi !',
            buttonsStyling      : false,
            type                : 'warning',
            showConfirmButton   : false,
            timer               : 1000
        });

        return false;
        }
    });
    
})

</script>