<style>

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #eb5905;
        background-color: #eb5905;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #eb5905;
        border-color: #eb5905 #eb5905 #eb5905;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #eb5905;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #eb5905;
    }
    .nav-tabs {
        border-bottom: 3px solid #eb5905;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

</style>
<div class="row">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Klausul Asuransi</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Klausul Asuransi</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <a href="<?= base_url('C_pks') ?>">
            <button class="btn mb-3 float-right kembali_dua" style="background-color: #02a4af; color:white;" type="button"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
        </a>
    </div>
    <div class="col-md-12">
        <div class="card">

            <div class="card-header p-3">
                <!-- <a href="<?= base_url('C_pks/klausal_asuransi') ?>"><button class="btn float-right text-white" style="background-color: #02a4af">Kembali</button></a> -->

                <h4 id="judul" class="font-weight-bold">Tambah Klausal Asuransi</h4>
            </div>

            <form action="simpan_klausul_data" method="post" autocomplete="off" enctype="multipart/form-data">

            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-10">

                        <div class="form-group row">
                            <label for="sel_asuransi" class="col-sm-3 col-form-label">Nama Asuransi</label>
                            <div class="col-sm-9">
                                <select name="sel_asuransi" id="sel_asuransi" data-allow-clear="true" placeholder="Pilih Asuransi">
                                    <option value=""></option>
                                    <?php foreach ($asuransi as $a): ?>
                                        <option value="<?= $a['id_asuransi'] ?>" email="<?= $a['email'] ?>" no_telepon="<?= $a['no_telepon'] ?>" alamat="<?= $a['alamat'] ?>"><?= $a['nama_asuransi'] ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-9 offset-md-3 notes">
                                <small class="text-danger">Harap pilih nama asuransi dahulu!</small>
                            </div> -->
                        </div>
                        <div class="form-group row">
                            <label for="jenis_produk" class="col-sm-3 col-form-label">Jenis Produk</label>
                            <div class="col-sm-9 gif" hidden>
                                <div class="row d-flex justify-content-center" >
                                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="20%">
                                </div>
                            </div>
                            <div class="col-sm-9 nm_jenis_produk">
                                <select name="jenis_produk" id="jenis_produk" data-allow-clear="true" placeholder="Pilih Jenis Produk" disabled>
                                    <!-- <option value=""></option>
                                    <?php foreach ($jenis_produk as $p): ?>
                                        <option value="<?= $p['id_jenis_produk'] ?>"><?= $p['jenis_produk'] ?></option>
                                    <?php endforeach;?> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_ptg" class="col-sm-3 col-form-label">Jenis Pertanggungan</label>
                            <div class="col-sm-9 mt-2 c_jenis_ptg1">
                                <?php foreach ($jenis_tanggung as $jt): ?>

                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" id="<?= strtolower($jt['jenis_tanggung']) ?>" name="jenis_ptg[]" class="custom-control-input c_jp" value="<?= $jt['id_jenis_tanggung'] ?>" disabled>
                                        <label class="custom-control-label" for="<?= strtolower($jt['jenis_tanggung']) ?>"><?= $jt['jenis_tanggung'] ?></label>
                                    </div>

                                <?php endforeach;?>
                                <!-- <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="ut" name="jenis_ptg[]" class="custom-control-input c_jp" value="ut" disabled>
                                    <label class="custom-control-label" for="ut">UT</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="um" name="jenis_ptg[]" class="custom-control-input c_jp" value="um" disabled>
                                    <label class="custom-control-label" for="um">UM</label>
                                </div> -->
                            </div>
                            <div class="col-sm-9 mt-2 c_jenis_ptg2" hidden>
                                <span>: UT</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_resiko" class="col-sm-3 col-form-label">Jenis Resiko</label>
                            <div class="col-sm-9">
                                <select name="jenis_resiko[]" id="jenis_resiko" data-allow-clear="true" placeholder="  Pilih Jenis Resiko" multiple="" disabled>
                                    <?php foreach ($jenis_resiko_1 as $r): ?>
                                        <option value="<?= $r['id_jenis_resiko'] ?>"><?= $r['jenis_resiko'] ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="email" name="email" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">No Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" style="font-size: 14px;" id="no_telepon" name="no_telepon" class="form-control" placeholde disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="font-size: 14px;" name="alamat" id="alamat" cols="30" rows="2" disabled></textarea>
                            </div>
                        </div> -->

                        </div>
                </div>
                <div class="row mt-3 nav_awal_klausal">
                    <div class="col-md-1 mb-3 nav_klausal">
                        <ul class="nav nav-pills flex-column text-center" id="myTab" role="tablist">
                            <?php foreach ($jenis_tanggung as $t):
                                // $tjenis = strtolower($t['jenis_tanggung']);
                                $tjenis = $t['id_jenis_tanggung'];
                            ?>
                                <li class="nav-item nav_jenis nav_<?= $tjenis ?>" hidden>
                                    <a class="nav-link jenis_aktif jenis_aktif_<?= $tjenis ?>" id="nav<?= $tjenis ?>tab" data-toggle="tab" href="#nav<?= $tjenis ?>" role="tab" aria-controls="nav<?= $tjenis ?>" aria-selected="true" style="font-size: 17px;"><?= strtoupper($t['jenis_tanggung']) ?></a>
                                </li>
                            <?php endforeach; ?>

                            <!-- <li class="nav-item nav_ut" hidden>
                                <a class="nav-link nl_aktif_ut" id="navUT-tab" data-toggle="tab" href="#navUT" role="tab" aria-controls="navUT" aria-selected="true" style="font-size: 17px;">UT</a>
                            </li>
                            <li class="nav-item nav_um" hidden>
                                <a class="nav-link nl_aktif_um" id="navUM-tab" data-toggle="tab" href="#navUM" role="tab" aria-controls="navUM" aria-selected="false" style="font-size: 17px;">UM</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="col-md-11">
                        <div class="tab-content" id="myTab1">
                            <?php foreach ($jenis_tanggung as $tt):
                                // $tjenis1    = strtolower($tt['jenis_tanggung']);
                                $tjenis1    = $tt['id_jenis_tanggung'];
                                $id_tjenis1 = $tt['id_jenis_tanggung'];
                            ?>

                                <div class="tab-pane fade jenis_tab tab_<?= $tjenis1 ?>" id="nav<?= $tjenis1 ?>" role="tabpanel" aria-labelledby="nav<?= $tjenis1 ?>tab">
                                
                                    <ul class="nav nav-tabs d-flex justify-content-center" id="myTab<?= $id_tjenis1 ?>" role="tablist">
                                        <?php $a=1; foreach ($jenis_resiko as $j): ?>
                                            <li class="nav-item nav_resiko <?= $tjenis1 ?>_resiko <?= $tjenis1 ?>_resiko_<?= $j['id_jenis_resiko'] ?>" role="presentation" hidden>
                                                <a class="nav-link font-weight-bold resiko_aktif <?= $tjenis1 ?>_nav_resiko" id="rsk_<?= $tjenis1 ?>_resiko<?= $j['id_jenis_resiko'] ?>_tab" data-toggle="tab" href="#rsk_<?= $tjenis1 ?>_resiko<?= $j['id_jenis_resiko'] ?>" role="tab" aria-controls="resiko" style="font-size: 17px;"><?= $j['jenis_resiko'] ?></a>
                                            </li>
                                        <?php $a++; endforeach; ?>
                                    </ul>

                                    <div class="tab-content" id="myTabContent1">

                                        <?php $a1=1; foreach ($jenis_resiko as $jj):
                                            $id_jj = $jj['id_jenis_resiko'];    
                                        ?>
                                            
                                            <div class="tab-pane fade resiko_tab <?= $tjenis1 ?>_resiko_tab <?= $tjenis1 ?>_resiko_tab<?= $id_jj ?>  p-3" id="rsk_<?= $tjenis1 ?>_resiko<?= $id_jj ?>" role="tabpanel" aria-labelledby="<?= $tjenis1 ?>_resiko<?= $id_jj ?>_tab">
                                                
                                                <h4 class="font-weight-bold">Syarat Pertanggungan</h4>
                                                <div class="form-group row">
                                                    <label for="nama_pks_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">PKS</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" style="font-size: 14px;" name="nama_pks_<?= $id_tjenis1.$id_jj ?>" id="nama_pks_<?= $id_tjenis1.$id_jj ?>" class="form-control" placeholder="Masukkan Nomor PKS">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="file" style="font-size: 14px;" name="pks_file_<?= $id_tjenis1.$id_jj ?>" id="pks_file_<?= $id_tjenis1.$id_jj ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="no_polis_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Polis Induk</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" style="font-size: 14px;" name="no_polis_<?= $id_tjenis1.$id_jj ?>" id="no_polis_<?= $id_tjenis1.$id_jj ?>" class="form-control" placeholder="Masukkan Nomor Polis Induk">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="file" style="font-size: 14px;" name="no_polis_file_<?= $id_tjenis1.$id_jj ?>" id="no_polis_file_<?= $id_tjenis1.$id_jj ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="maksimal_plafond_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Maksimal Plafond</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" style="font-size: 14px;" id="maksimal_plafond_<?= $id_tjenis1.$id_jj ?>" name="maksimal_plafond_<?= $id_tjenis1.$id_jj ?>" class="form-control separator" placeholder="Masukkan Maksimal Plafond">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="x_plus_n_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Batas Usia Jatuh Tempo</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group mb-3">
                                                            <input type="text" style="font-size: 14px;" id="x_plus_n_<?= $id_tjenis1.$id_jj ?>" name="x_plus_n_<?= $id_tjenis1.$id_jj ?>" class="form-control angka" placeholder="Masukkan Batas Usia">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">Tahun</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="free_cover_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Free Cover</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" style="font-size: 14px;" id="free_cover_<?= $id_tjenis1.$id_jj ?>" name="free_cover_<?= $id_tjenis1.$id_jj ?>" class="form-control separator" placeholder="Masukkan Free Cover">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="tenor_maksimal_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Tenor Maksimal</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group mb-3">
                                                            <input type="text" style="font-size: 14px;" id="tenor_maksimal_<?= $id_tjenis1.$id_jj ?>" name="tenor_maksimal_<?= $id_tjenis1.$id_jj ?>" class="form-control angka" placeholder="Masukkan Tenor Maksimal">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">Tahun</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="brokerage_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Brokerage</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" style="font-size: 14px;" id="brokerage_<?= $id_tjenis1.$id_jj ?>" name="brokerage_<?= $id_tjenis1.$id_jj ?>" class="form-control separator" placeholder="Masukkan Brokerage">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="legalitas_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Legalitas</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" style="font-size: 14px;" name="legalitas_<?= $id_tjenis1.$id_jj ?>" id="legalitas_<?= $id_tjenis1.$id_jj ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="compro_file_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label">Company Profile</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" style="font-size: 14px;" name="compro_file_<?= $id_tjenis1.$id_jj ?>" id="compro_file_<?= $id_tjenis1.$id_jj ?>" class="form-control">
                                                    </div>
                                                </div>

                                                <h4 class="font-weight-bold mb-3">Underwriting</h4>

                                                <table class="table table-light table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th rowspan="2">UP / Plafond</th>
                                                            <?php $b=1; foreach ($usia_masuk as $m): ?>
                                                                <th align="center"><?= $b ?></th>
                                                            <?php $b++; endforeach; ?>
                                                        </tr>
                                                        <tr>
                                                            <?php foreach ($usia_masuk as $m): ?>
                                                                <th><?= $m['usia_masuk'] ?></th>
                                                            <?php endforeach; ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i=1; foreach ($plafond as $m): ?>
                                                        <tr>
                                                            <td><?= $m['plafond'] ?></td>
                                                            <td>
                                                                <select name="sel_status_1_<?= $id_tjenis1.$id_jj ?>[]" class="sel_isi_udw" plafond="<?= $i ?>" usia_masuk="1" idd="<?= $id_tjenis1.$id_jj ?>" data-allow-clear="true" placeholder="Pilih Status">
                                                                
                                                                </select>
                                                                <input type="hidden" name="input_<?= $i ?>_1_<?= $id_tjenis1.$id_jj ?>" class="input_<?= $i ?>_1_<?= $id_tjenis1.$id_jj ?>">
                                                            </td>
                                                            <td>
                                                                <select name="sel_status_2_<?= $id_tjenis1.$id_jj ?>[]" class="sel_isi_udw" plafond="<?= $i ?>" usia_masuk="2" idd="<?= $id_tjenis1.$id_jj ?>" data-allow-clear="true" placeholder="Pilih Status">
                                                                
                                                                </select>
                                                                <input type="hidden" name="input_<?= $i ?>_2_<?= $id_tjenis1.$id_jj ?>" class="input_<?= $i ?>_2_<?= $id_tjenis1.$id_jj ?>">
                                                            </td>
                                                            <td>
                                                                <select name="sel_status_3_<?= $id_tjenis1.$id_jj ?>[]" class="sel_isi_udw" plafond="<?= $i ?>" usia_masuk="3" idd="<?= $id_tjenis1.$id_jj ?>" data-allow-clear="true" placeholder="Pilih Status">
                                                                
                                                                </select>
                                                                <input type="hidden" name="input_<?= $i ?>_3_<?= $id_tjenis1.$id_jj ?>" class="input_<?= $i ?>_3_<?= $id_tjenis1.$id_jj ?>">
                                                            </td>
                                                        </tr>
                                                        <?php $i++; endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <table class="table table-light table-bordered tabel_status_dok" width="50%">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Status</th>
                                                            <th>Jenis Dokumen</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                    </tbody>
                                                </table>

                                                <h4 class="font-weight-bold mt-3 mb-3">Tarif Asuransi</h4>

                                                <div class="row">
            
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-3 control-label col-form-label">Upload File</label>
                                                            <div class="col-sm-3">
                                                                <input type="file" style="font-size: 14px;" id="excdata_<?= $id_tjenis1.$id_jj ?>" onchange="nmfile(this.value, '<?= $id_tjenis1.$id_jj ?>')" name="excdata_<?= $id_tjenis1.$id_jj ?>" hidden>
                                                                <a href="javascript:void(0)" onclick="$('#excdata_<?= $id_tjenis1.$id_jj ?>').click()" class="btn btn-primary">
                                                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                                                    <span class="value-digit">Upload</span>
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <input type="text" style="font-size: 14px;" id="namefile_<?= $id_tjenis1.$id_jj ?>" name="namefile_<?= $id_tjenis1.$id_jj ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <a href="<?= base_url('excel/format_tarif_asuransi.xlsx') ?>"><button type="button" class="btn btn-warning btn-sm float-right">Download Format</button></a>
                                                    </div>
                                                    
                                                </div>

                                                <div class="form-group row">
                                                    <table class="table table-bordered table-hover" id="exceltable_<?= $id_tjenis1.$id_jj ?>" width="100%" cellspacing="0"></table>
                                                </div>
                                                
                                            </div>

                                        <?php $a1++; endforeach; ?>

                                    </div>

                                </div>

                            <?php endforeach ?>

                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" id="simpan_klausal" disabled>Simpan</button>
            </div>

            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js"></script>
<script type="text/javascript">

    function nmfile(nmf, id_j) {
        let last = nmf.split("\\");
        $('#namefile_'+id_j).val(last[last.length-1]);
        $('#exceltable_'+id_j).html('');

        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;
        /*Checks whether the file is a valid excel file*/
        //  if (regex.test($("#excdata").val().toLowerCase())) {
            var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/
            if ($("#excdata_"+id_j).val().toLowerCase().indexOf(".xlsx") > 0) {
                xlsxflag = true;
            }
            /*Checks whether the browser supports HTML5*/
            if (typeof (FileReader) != "undefined") {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var data = e.target.result;
                    /*Converts the excel data in to object*/
                    if (xlsxflag) {
                        var workbook = XLSX.read(data, { type: 'binary' });
                    }
                    else {
                        var workbook = XLS.read(data, { type: 'binary' });
                    }
                    /*Gets all the sheetnames of excel in to a variable*/
                    var sheet_name_list = workbook.SheetNames;

                    var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/
                    sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/
                        /*Convert the cell value to Json*/
                        if (xlsxflag) {
                            var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);
                        }
                        else {
                            var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);
                        }
                        if (exceljson.length > 0 && cnt == 0) {
                            BindTable(exceljson, '#exceltable_'+id_j);
                            cnt++;
                        }
                    });
                    $('#exceltable_'+id_j).show();
                }
                if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/
                    reader.readAsArrayBuffer($("#excdata_"+id_j)[0].files[0]);
                }
                else {
                    reader.readAsBinaryString($("#excdata_"+id_j)[0].files[0]);
                }
            }
            else {
                alert("Sorry! Your browser does not support HTML5!");
            }
        //  }
        //  else {
        //      alert("Please upload a valid Excel file!");
        //  }
    }

    function BindTable(jsondata, tableid) {/*Function used to convert the JSON array to Html Table*/
        var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/
        for (var i = 0; i < jsondata.length; i++) {
            var row$ = $('<tr/>');
            for (var colIndex = 0; colIndex < columns.length; colIndex++) {
                var cellValue = jsondata[i][columns[colIndex]];
                if (cellValue == null)
                    cellValue = "";
                row$.append($('<td/>').html(cellValue));
            }
            $(tableid).append(row$);
        }
    }

    function BindTableHeader(jsondata, tableid) {/*Function used to get all column names from JSON and bind the html table header*/
        var columnSet = [];
        var headerTr$ = $('<tr/>');
        for (var i = 0; i < jsondata.length; i++) {
            var rowHash = jsondata[i];
            for (var key in rowHash) {
                if (rowHash.hasOwnProperty(key)) {
                    if ($.inArray(key, columnSet) == -1) {/*Adding each unique column names to a variable array*/
                        columnSet.push(key);
                        headerTr$.append($('<th/>').html(key));
                    }
                }
            }
        }
        $(tableid).append(headerTr$);
        return columnSet;
    }
    
</script>

<script>

    $(document).ready(function () {

        $("input, textarea").keyup(function() {
            var val = $(this).val()
            $(this).val(val.toUpperCase());
        });

        $('.sel_isi_udw').on('change', function () {

            var isi         = $(this).val();
            var plafond     = $(this).attr('plafond');
            var usia_masuk  = $(this).attr('usia_masuk');
            var idd         = $(this).attr('idd');

            var satu        = isi+'_'+plafond+'_'+usia_masuk+'_'+idd;

            if (isi == '') {
                $('.input_'+plafond+'_'+usia_masuk+'_'+idd).val('');
            } else {
                $('.input_'+plafond+'_'+usia_masuk+'_'+idd).val(satu);
            }
            
        })

        $('.tab_k').css({"display": "none"});
        
        // 07-02-2021
        $('#sel_asuransi').on('change', function () {

            var id_asuransi = $(this).val();
            var email       = $(this).find(':selected').attr('email');
            var no_telepon  = $(this).find(':selected').attr('no_telepon');
            var alamat      = $(this).find(':selected').attr('alamat');

            if (id_asuransi == '') {

                $('#email').val('');
                $('#no_telepon').val('');
                $('#alamat').val('');
                $('.notes').attr('hidden', false);

                $('.tab_k').css({"display": "none"});

                $('#myTabContent').attr("hidden", true);
                $('#simpan_klausal').attr("disabled", true);

                // 21-02-21
                $('#jenis_produk').val('').trigger('change'); 
                $('#jenis_resiko').val('').trigger('change'); 
                
                $('#jenis_produk').attr('disabled', true);
                $('.c_jp').attr('disabled', true);
                $('#jenis_resiko').attr('disabled', true);
                $('.c_jenis_ptg1').attr('hidden', false);
                $('.c_jenis_ptg2').attr('hidden', true);

                $('#um').prop('checked', false);
                $('#ut').prop('checked', false);

            } else {

                $('#email').val(email);
                $('#no_telepon').val(no_telepon);
                $('#alamat').val(alamat);
                $('.notes').attr('hidden', true);

                $('.tab_k').css({"display": ""});

                $('#myTabContent').attr("hidden", false);
                // $('#simpan_klausal').attr("disabled", false);

                tabel_status_dok.ajax.reload(null, false);

                // 21-02-21
                $('#jenis_produk').attr('disabled', false);
                $('.c_jp').attr('disabled', true);
                $('#jenis_resiko').attr('disabled', true);

                $('#um').prop('checked', false);
                $('#ut').prop('checked', false);

                $('.nm_jenis_produk').attr('hidden', true);
                $('.gif').attr('hidden', false);

                $.ajax({
                    url     : "<?= base_url('C_pks/ambil_jenis_produk') ?>",
                    method  : "POST",
                    data    : {id_asuransi:id_asuransi},
                    dataType: "JSON",
                    success : function (data) {

                        $('.nm_jenis_produk').attr('hidden', false);
                        $('.gif').attr('hidden', true);

                        $('#jenis_produk').html(data.sel_jenis_produk);
                        
                    }
                })

                return false;
                
            }
            
        })

        // 21-02-21
        $('#jenis_produk').on('change', function () {

            var isi         = $(this).val();
            var jns_resiko  = $('#jenis_resiko').val();

            if (isi == '') {

                $('.c_jp').attr('disabled', true);
                $('#jenis_resiko').attr('disabled', true);
                $('.c_jenis_ptg1').attr('hidden', false);
                $('.c_jenis_ptg2').attr('hidden', true);

                $('#um').prop('checked', false);
                $('#ut').prop('checked', false);

                $('#jenis_resiko').val('').trigger('change'); 

                $('.nav_awal_klausal').attr('hidden', true);

                $('#simpan_klausal').attr("disabled", true);

            } else {

                $('.c_jp').attr('disabled', false);
                $('.nav_awal_klausal').attr('hidden', false);

                if (isi == 3) {
                    
                    $('.c_jenis_ptg1').attr('hidden', false);
                    $('.c_jenis_ptg2').attr('hidden', true);

                    $('#um').prop('checked', true);
                    $('#ut').prop('checked', true);

                    
                } else {

                    $('.c_jenis_ptg1').attr('hidden', true);
                    $('.c_jenis_ptg2').attr('hidden', false);

                    $('#um').prop('checked', false);
                    $('#ut').prop('checked', true);

                }

                $('#jenis_resiko').attr('disabled', false);

                // navbar 1
                $('.nav_jenis').attr('hidden', true);
                $('.jenis_aktif').removeClass('active');
                $('.jenis_tab').removeClass('show active');

                // navbar 2
                $('.nav_resiko').attr('hidden', true);
                $('.resiko_aktif').removeClass('active');
                $('.resiko_tab').removeClass('show active');

                var jns_ptg     = $.map($('input[name="jenis_ptg[]"]:checked'), function(c){return c.value; })
                var jml         = jns_ptg.length;

                var jr = jns_resiko[0];
                var jn = jns_ptg[0];

                if (jns_resiko.length == 0) {
                    
                    jns_ptg.forEach(function (jns1) {

                    // navbar 1
                        // menampilkan nav 
                        $('.nav_'+jns1).attr('hidden', false);
                        // mengaktifkan hanya tab awal saja
                        $('.jenis_aktif_'+jn).addClass('active');
                        $('.tab_'+jn).addClass('show active');

                        $('.'+jns1+'_resiko_1').attr('hidden', false);
                        // mengaktifkan hanya tab awal saja
                        $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                        $('.'+jns1+'_resiko_tab1').addClass('show active');

                    })

                }

                jns_resiko.forEach(function (resiko) {

                    jns_ptg.forEach(function (jns1) {

                        // navbar 1
                            // menampilkan nav 
                            $('.nav_'+jns1).attr('hidden', false);
                            // mengaktifkan hanya tab awal saja
                            $('.jenis_aktif_'+jn).addClass('active');
                            $('.tab_'+jn).addClass('show active');

                        // navbar 2
                            // menampilkan nav 
                            // $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                            // // mengaktifkan hanya tab awal saja
                            // $('#rsk_'+jns1+'_resiko'+jr+'_tab').addClass('active');
                            // $('.'+jns1+'_resiko_tab'+jr).addClass('show active');

                            $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                            $('.'+jns1+'_resiko_1').attr('hidden', false);
                            // mengaktifkan hanya tab awal saja
                            $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                            $('.'+jns1+'_resiko_tab1').addClass('show active');
                        
                    })

                })

                if (jns_ptg.length > 0 && jns_resiko.length > 0) {

                    $('#simpan_klausal').attr("disabled", false);

                }

            }
            
        })

        $('.c_jp').on('click', function () {
            
            var jns_ptg     = $.map($('input[name="jenis_ptg[]"]:checked'), function(c){return c.value; })
            var jml         = jns_ptg.length;
            var jns_resiko  = $('#jenis_resiko').val();

            if (jml > 0) {
                $('#jenis_resiko').attr('disabled', false);
                $('.nav_awal_klausal').attr('hidden', false);

                // navbar 1
                $('.nav_jenis').attr('hidden', true);
                $('.jenis_aktif').removeClass('active');
                $('.jenis_tab').removeClass('show active');

                // navbar 2
                $('.nav_resiko').attr('hidden', true);
                $('.resiko_aktif').removeClass('active');
                $('.resiko_tab').removeClass('show active');

                // if (jns_resiko.length > 0) {

                //     $('.nav_awal_klausal').attr('hidden', false);

                //     var jr = jns_resiko[0];
                //     var jn = jns_ptg[0];

                //     jns_resiko.forEach(function (resiko) {

                //         jns_ptg.forEach(function (jns1) {

                //             // navbar 1
                //                 // menampilkan nav 
                //                 $('.nav_'+jns1).attr('hidden', false);
                //                 // mengaktifkan hanya tab awal saja
                //                 $('.jenis_aktif_'+jn).addClass('active');
                //                 $('.tab_'+jn).addClass('show active');

                //             // navbar 2
                //                 // menampilkan nav 
                //                 // $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                //                 // // mengaktifkan hanya tab awal saja
                //                 // $('#rsk_'+jns1+'_resiko'+jr+'_tab').addClass('active');
                //                 // $('.'+jns1+'_resiko_tab'+jr).addClass('show active');

                //                 $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                //                 $('.'+jns1+'_resiko_1').attr('hidden', false);
                //                 // mengaktifkan hanya tab awal saja
                //                 $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                //                 $('.'+jns1+'_resiko_tab1').addClass('show active');
                            
                //         })

                //     })
                    
                // }

                var jr = jns_resiko[0];
                var jn = jns_ptg[0];

                if (jns_resiko.length == 0) {
                    
                    jns_ptg.forEach(function (jns1) {

                    // navbar 1
                        // menampilkan nav 
                        $('.nav_'+jns1).attr('hidden', false);
                        // mengaktifkan hanya tab awal saja
                        $('.jenis_aktif_'+jn).addClass('active');
                        $('.tab_'+jn).addClass('show active');

                        $('.'+jns1+'_resiko_1').attr('hidden', false);
                        // mengaktifkan hanya tab awal saja
                        $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                        $('.'+jns1+'_resiko_tab1').addClass('show active');

                    })

                }

                jns_resiko.forEach(function (resiko) {

                    jns_ptg.forEach(function (jns1) {

                        // navbar 1
                            // menampilkan nav 
                            $('.nav_'+jns1).attr('hidden', false);
                            // mengaktifkan hanya tab awal saja
                            $('.jenis_aktif_'+jn).addClass('active');
                            $('.tab_'+jn).addClass('show active');

                        // navbar 2
                            // menampilkan nav 
                            // $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                            // // mengaktifkan hanya tab awal saja
                            // $('#rsk_'+jns1+'_resiko'+jr+'_tab').addClass('active');
                            // $('.'+jns1+'_resiko_tab'+jr).addClass('show active');

                            $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                            $('.'+jns1+'_resiko_1').attr('hidden', false);
                            // mengaktifkan hanya tab awal saja
                            $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                            $('.'+jns1+'_resiko_tab1').addClass('show active');
                        
                    })

                })

                if (jns_ptg.length > 0 && jns_resiko.length > 0) {

                    $('#simpan_klausal').attr("disabled", false);

                }
                
            } else {
                $('#jenis_resiko').attr('disabled', true);
                $('.nav_awal_klausal').attr('hidden', true);

                $('#simpan_klausal').attr("disabled", true);
            }

        })

        // 22-02-2021
        $('#jenis_resiko').on('change', function () {

            var jns_resiko  = $(this).val();
            var jns_ptg     = $.map($('input[name="jenis_ptg[]"]:checked'), function(c){return c.value; })
            var jml         = jns_ptg.length;

            $('.nav_jenis').attr('hidden', true);
            $('.jenis_aktif').removeClass('active');
            $('.jenis_tab').removeClass('show active');

            $('.nav_resiko').attr('hidden', true);
            $('.resiko_aktif').removeClass('active');
            $('.resiko_tab').removeClass('show active');

            $('#simpan_klausal').attr("disabled", true);
            
            // if (jns_resiko.length > 0) {

            //     $('.nav_awal_klausal').attr('hidden', false);

            //     var jr = jns_resiko[0];
            //     var jn = jns_ptg[0];

            //     jns_resiko.forEach(function (resiko) {

            //         jns_ptg.forEach(function (jns1) {

            //             // navbar 1
            //                 // menampilkan nav 
            //                 $('.nav_'+jns1).attr('hidden', false);
            //                 // mengaktifkan hanya tab awal saja
            //                 $('.jenis_aktif_'+jn).addClass('active');
            //                 $('.tab_'+jn).addClass('show active');

            //             // navbar 2
            //                 // menampilkan nav 
            //                 $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
            //                 $('.'+jns1+'_resiko_1').attr('hidden', false);
            //                 // mengaktifkan hanya tab awal saja
            //                 $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
            //                 $('.'+jns1+'_resiko_tab1').addClass('show active');
                        
            //         })
                    
            //     })

            //     $('#simpan_klausal').attr("disabled", false);

            // }

            var jr = jns_resiko[0];
            var jn = jns_ptg[0];
            
            if (jns_resiko.length == 0) {
                    
                jns_ptg.forEach(function (jns1) {

                // navbar 1
                    // menampilkan nav 
                    $('.nav_'+jns1).attr('hidden', false);
                    // mengaktifkan hanya tab awal saja
                    $('.jenis_aktif_'+jn).addClass('active');
                    $('.tab_'+jn).addClass('show active');

                    $('.'+jns1+'_resiko_1').attr('hidden', false);
                    // mengaktifkan hanya tab awal saja
                    $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                    $('.'+jns1+'_resiko_tab1').addClass('show active');

                })

            }

            jns_resiko.forEach(function (resiko) {

                jns_ptg.forEach(function (jns1) {

                    // navbar 1
                        // menampilkan nav 
                        $('.nav_'+jns1).attr('hidden', false);
                        // mengaktifkan hanya tab awal saja
                        $('.jenis_aktif_'+jn).addClass('active');
                        $('.tab_'+jn).addClass('show active');

                    // navbar 2
                        // menampilkan nav 
                        $('.'+jns1+'_resiko_'+resiko).attr('hidden', false);
                        $('.'+jns1+'_resiko_1').attr('hidden', false);
                        // mengaktifkan hanya tab awal saja
                        $('#rsk_'+jns1+'_resiko1_tab').addClass('active');
                        $('.'+jns1+'_resiko_tab1').addClass('show active');
                    
                })

            })

            $('#simpan_klausal').attr("disabled", false);

        })

        // 07-02-2021
        var tabel_status_dok  = $('.tabel_status_dok').DataTable({
            "processing"    : true,
            "ajax"              : {
                "url"   : "tampil_status_dok",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_asuransi = $('#sel_asuransi').val();
                },
                "dataSrc": function (json) {
                    $(".sel_isi_udw").html(json.option); 
                    return json.data;
                }
            },
            stateSave       : true,
            "bPaginate"     : false, //hide pagination
            "bFilter"       : false, //hide Search bar
            "bInfo"         : false, // hide showing entries
            "order"         : [],
            "columnDefs"     : [{
                "targets"       : [0,1],
                "orderable"     : false
            }, {
                "targets"       : [0],
                "className"     : "text-center"
            }]
        });
        
    })

</script>