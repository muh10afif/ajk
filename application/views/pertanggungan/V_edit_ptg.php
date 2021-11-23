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
<div class="row f_tiga">
    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item" style="color: #02a4af">List Debitur Tertanggung</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data Tertanggung</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <form action="<?= base_url('C_pertanggungan/lihat_debitur_ptg') ?>" method="POST">
            <input type="hidden" name="id_pks" value="<?= $id_pks ?>">
            <input type="hidden" name="id_bpr" value="<?= $id_bpr ?>">
            <input type="hidden" name="nama_bpr" class="nama_bpr" value="<?= $nama_bpr ?>">
            <input type="hidden" name="nomor_pks" class="nomor_pks" value="<?= $nomor_pks ?>">
            <button class="btn mb-3 float-right kembali_dua" style="background-color: #02a4af; color:white;" type="submit"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
        </form>
        
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: -40px; margin-top: -20px;">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Nama BPR</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold t_nama_bpr">: <?= $nama_bpr ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-6 col-form-label">Nomor SPK</label>
                            <div class="col-sm-6 mt-1">
                                <span class="font-weight-bold t_nomor_pks">: <?= $nomor_pks ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <form id="form_tertanggung" action="<?= base_url('C_pertanggungan/simpan_edit_ptg') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="aksi_tambah_debitur" class="aksi_tambah_debitur">
            <input type="hidden" value="<?= $id_pks ?>" name="id_pks" class="id_pks">
            <input type="hidden" value="<?= $id_bpr ?>" name="id_bpr" class="id_bpr">
            <input type="hidden" value="<?= $id_asuransi ?>" name="id_asuransi" class="id_asuransi">
            <input type="hidden" value="edit" name="aksi" class="aksi">
            <input type="hidden" value="<?= $id_data_ptg ?>" name="id_ptg" class="id_ptg">
            <input type="hidden" value="<?= $kd_ptg ?>" name="kd_ptg" class="kd_ptg">
            <div class="card">
                <div class="card-header p-3">
                    <h4 class="font-weight-bold">Ubah Data Tertanggung</h4>
                </div>
                <div class="card-body table-responsive ">
                    <div class="row p-2">
                        <div class="col-md-12">
                            <h4 class="font-weight-bold">Data Tertanggung</h4>
                        </div>
                    </div>
                    <div class="form-group row list_tambah_debitur p-2">
                        <label for="nik" class="col-sm-3 col-form-label font-weight-bold">Pilih Debitur</label>
                        <div class="col-sm-7">
                            <select name="id_debitur" id="id_debitur" class="id_deb_pilih" placeholder="Pilih Debitur">
                                <option value=""></option>
                                <?php foreach ($debitur as $d): ?>
                                    <option value="<?= $d['id_debitur'] ?>" <?= ($d['id_debitur'] == $ptg['id_debitur'] ? 'selected' : '') ?>><?= $d['nama_lengkap'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="st_debitur" id="st_debitur" value="tambah" hidden>
                            <button type="button" class="btn btn-sm btn-block m-0" style="background-color: #02a4af; color:white;" id="tambah_debitur">Tambah Debitur</button>
                            <button type="button" class="btn btn-sm btn-warning btn-block m-0" id="btl_tambah_debitur"  style="display: none;">Batal</button>
                        </div>
                    </div>
                    <div id="form_tambah_debitur" style="display: none;">
                        <div class="col-md-12 p-2 mt-2">  
                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label font-weight-bold">NIK</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" style="font-size: 14px;" name="nik" id="nik" placeholder="Masukkan NIK">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="nama_lengkap" class="col-sm-3 col-form-label font-weight-bold">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" style="font-size: 14px;" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-3 col-form-label font-weight-bold">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" style="font-size: 14px;" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="jk1" name="jenis_kelamin" class="custom-control-input" value="Pria">
                                        <label class="custom-control-label" for="jk1">Pria</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="jk2" name="jenis_kelamin" class="custom-control-input" value="Wanita">
                                        <label class="custom-control-label" for="jk2">Wanita</label>
                                    </div>
                                </div>
                            </div>  
                            
                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label font-weight-bold">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control datepicker2" style="font-size: 14px;" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" readonly>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label font-weight-bold">Upload KTP</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" style="font-size: 14px;" name="ktp_nasabah" id="ktp">
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label font-weight-bold">Input data KTP </label>
                                <div class="col-sm-9">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="tidak_ktp" name="sts_ktp" class="custom-control-input" value="tidak" checked>
                                        <label class="custom-control-label" for="tidak_ktp">Tidak</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="ya_ktp" name="sts_ktp" class="custom-control-input" value="ya">
                                        <label class="custom-control-label" for="ya_ktp">Ya</label>
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group row f_ktp" style="display: none;">
                                <div class="col-md-12">
                                    <div class="card p-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label font-weight-bold">Jenis Identitas</label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="ji1" name="jenis_identitas" class="custom-control-input" value="KTP" checked>
                                                <label class="custom-control-label" for="ji1">KTP</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="ji2" name="jenis_identitas" class="custom-control-input" value="Paspor">
                                                <label class="custom-control-label" for="ji2">Paspor</label>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label for="no_identitas" class="col-sm-3 col-form-label font-weight-bold">No Identitas</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" style="font-size: 14px;" name="no_identitas" id="no_identitas" placeholder="Masukkan No Identitas">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="st1" name="status_nikah" class="custom-control-input" value="Belum Menikah">
                                                <label class="custom-control-label" for="st1">Belum Menikah</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="st2" name="status_nikah" class="custom-control-input" value="Menikah">
                                                <label class="custom-control-label" for="st2">Menikah</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="st3" name="status_nikah" class="custom-control-input" value="Janda / Duda">
                                                <label class="custom-control-label" for="st3">Janda / Duda</label>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold font-weight-bold">Warga Negara</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="wn1" name="warga_negara" class="custom-control-input" value="wni">
                                                        <label class="custom-control-label" for="wn1">WNI</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="wn2" name="warga_negara" class="custom-control-input" value="wna">
                                                        <label class="custom-control-label" for="wn2">WNA</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" style="display: none; font-size: 14px;" id="input_wna" name="negara_wna" class="form-control" placeholder="Masukkan Nama Negara">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="agama" class="col-sm-3 col-form-label font-weight-bold">Agama</label>
                                        <div class="col-sm-9">
                                            <select name="agama" id="agama" data-allow-clear="1" placeholder="Pilih Agama">
                                                <option value="islam">Islam</option>
                                                <option value="kristen">Kristen</option>
                                                <option value="hindu">Hindu</option>
                                                <option value="budha">Budha</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <!-- alamat rumah -->
                                    <div class="form-group row">
                                        <label for="alamat_rumah" class="col-sm-3 col-form-label font-weight-bold">Alamat Rumah</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <textarea name="alamat_rumah" style="font-size: 14px;" class="form-control" id="alamat_rumah" rows="10" placeholder="Masukkan Alamat"></textarea>
                                                </div>
                                                <div class="col-md-6">
                                                    <div>
                                                        <select name="id_provinsi" id="id_provinsi" data-allow-clear="1" placeholder="Pilih Provinsi">
                                                            <?php foreach ($provinsi as $k): ?>
                                                                <option value="<?= $k['id_provinsi'] ?>"><?= $k['nama_provinsi'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mt-2">
                                                        <select name="kota_kab" id="kota_kab" data-allow-clear="1" placeholder="Pilih Kota / Kab">
                                                        
                                                        </select>
                                                        <div id="loading_kota_kab" style="margin-top: 0px;"  align='left'>
                                                            <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <select name="id_kecamatan" id="id_kecamatan" data-allow-clear="1" placeholder="Pilih Kecamatan">
                                                        
                                                        </select>
                                                        <div id="loading_kecamatan" style="margin-top: 0px;"  align='left'>
                                                            <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <input type="text" id="kode_pos" name="kode_pos" class="form-control" style="font-size: 14px;" placeholder="Masukkan Kode Pos">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="alamat_korespon" class="col-sm-3 col-form-label font-weight-bold">Alamat Korespondensi</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <textarea name="alamat_korespon" style="font-size: 14px;" class="form-control" id="alamat_korespon" rows="10" placeholder="Masukkan Alamat Korespondensi"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <select name="id_provinsi_korespon" id="id_provinsi_korespon" data-allow-clear="1" placeholder="Pilih Provinsi">
                                                    <?php foreach ($provinsi as $k): ?>
                                                        <option value="<?= $k['id_provinsi'] ?>"><?= $k['nama_provinsi'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mt-2">
                                                <select name="kota_kab_korespon" id="kota_kab_korespon" data-allow-clear="1" placeholder="Pilih Kota / Kab">
                                                
                                                </select>
                                                <div id="loading_kota_kab_korespon" style="margin-top: 0px;"  align='left'>
                                                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <select name="id_kecamatan_korespon" id="id_kecamatan_korespon" data-allow-clear="1" placeholder="Pilih Kecamatan">
                                                
                                                </select>
                                                <div id="loading_kecamatan_korespon" style="margin-top: 0px;"  align='left'>
                                                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <input type="text" id="kode_pos_korespon" name="kode_pos_korespon" class="form-control" style="font-size: 14px;" placeholder="Masukkan Kode Pos">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kontak" class="col-sm-3 col-form-label font-weight-bold">Kontak</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" style="font-size: 14px;" name="kontak" id="kontak" placeholder="Masukkan Nomor Kontak">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label font-weight-bold">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" style="font-size: 14px;" name="email" id="email" placeholder="Masukkan Email">
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="pekerjaan" class="col-sm-3 col-form-label font-weight-bold">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" style="font-size: 14px;" name="pekerjaan" id="pekerjaan" placeholder="Masukkan Pekerjaan">
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <label for="bagian" class="col-sm-3 col-form-label font-weight-bold">Bagian</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" style="font-size: 14px;" name="bagian" id="bagian" placeholder="Masukkan Bagian">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="alamat_kantor" class="col-sm-3 col-form-label font-weight-bold">Alamat Kantor</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <textarea name="alamat_kantor" style="font-size: 14px;" class="form-control" id="alamat_kantor" rows="10" placeholder="Masukkan Alamat Kantor"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div>
                                                <select name="id_provinsi_kantor" id="id_provinsi_kantor" data-allow-clear="1" placeholder="Pilih Provinsi">
                                                    <?php foreach ($provinsi as $k): ?>
                                                        <option value="<?= $k['id_provinsi'] ?>"><?= $k['nama_provinsi'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mt-2">
                                                <select name="kota_kab_kantor" id="kota_kab_kantor" data-allow-clear="1" placeholder="Pilih Kota / Kab">
                                                
                                                </select>
                                                <div id="loading_kota_kab_kantor" style="margin-top: 0px;"  align='left'>
                                                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <select name="id_kecamatan_kantor" id="id_kecamatan_kantor" data-allow-clear="1" placeholder="Pilih Kecamatan">
                                                
                                                </select>
                                                <div id="loading_kecamatan_kantor" style="margin-top: 0px;"  align='left'>
                                                    <img src="<?= base_url('assets/images/ajax-loader.gif') ?>" width="100"> <small></small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <input type="text" id="kode_pos_kantor" name="kode_pos_kantor" class="form-control" style="font-size: 14px;" placeholder="Masukkan Kode Pos">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tujuan_beli_asuransi" class="col-sm-3 col-form-label font-weight-bold">Tujuan Membeli Asuransi</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" style="font-size: 14px;" name="tujuan_beli_asuransi" id="tujuan_beli_asuransi" placeholder="Masukkan Tujuan Membeli Asuransi"></textarea>
                                </div>
                            </div> 
                            <!-- sumber dana pembelian -->
                            <div class="form-group row">
                                <label for="sumber_dana_beli" class="col-sm-3 col-form-label font-weight-bold">Sumber Dana Pembelian</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="sdb1" name="sumber_dana_beli" class="custom-control-input" value="gaji">
                                                <label class="custom-control-label" for="sdb1">Gaji</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="sdb2" name="sumber_dana_beli" class="custom-control-input" value="warisan">
                                                <label class="custom-control-label" for="sdb2">Warisan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="sdb3" name="sumber_dana_beli" class="custom-control-input" value="hasil_usaha">
                                                <label class="custom-control-label" for="sdb3">Hasil Usaha</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="sdb4" name="sumber_dana_beli" class="custom-control-input" value="lainnya">
                                                <label class="custom-control-label" for="sdb4">Lainnya</label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="sdb5" name="sumber_dana_beli" class="custom-control-input" value="hasil_invest">
                                                <label class="custom-control-label" for="sdb5">Hasil Investasi</label>
                                            </div>
                                            <div class="mt-3">
                                                <input type="text" style="font-size: 14px; display: none;" id="sdb_lainnya" name="sdb_lainnya" class="form-control" placeholder="Sumber Dana Lainnya">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>  
                            <!-- / sumber dana pembelian -->
                            <div class="form-group row">
                                <label for="penghasilan_tahun" class="col-sm-3 col-form-label font-weight-bold">Penghasilan / Tahun</label>
                                <div class="col-sm-9">
                                    <select name="penghasilan_tahun" id="penghasilan_tahun" data-allow-clear="1" placeholder="Pilih Range Penghasilan">
                                        
                                    </select>
                                </div>
                            </div> 
                            <!-- sumber dana penghasilan -->
                            <div class="form-group row">
                                <label for="sumber_dana_penghasilan" class="col-sm-3 col-form-label font-weight-bold">Sumber Dana Penghasilan</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="sdp1" name="sumber_dana_penghasilan" class="custom-control-input" value="gaji">
                                                <label class="custom-control-label" for="sdp1">Gaji</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="sdp2" name="sumber_dana_penghasilan" class="custom-control-input" value="warisan">
                                                <label class="custom-control-label" for="sdp2">Warisan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="sdp3" name="sumber_dana_penghasilan" class="custom-control-input" value="hasil_usaha">
                                                <label class="custom-control-label" for="sdp3">Hasil Usaha</label>
                                            </div>
                                            <div class="custom-control custom-radio mt-3">
                                                <input type="radio" id="sdp4" name="sumber_dana_penghasilan" class="custom-control-input" value="lainnya">
                                                <label class="custom-control-label" for="sdp4">Lainnya</label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="sdp5" name="sumber_dana_penghasilan" class="custom-control-input" value="hasil_invest">
                                                <label class="custom-control-label" for="sdp5">Hasil Investasi</label>
                                            </div>
                                            <div class="mt-3">
                                                <input type="text" style="font-size: 14px; display: none;" id="sdp_lainnya" name="sdp_lainnya" class="form-control" placeholder="Sumber Dana Lainnya">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>  
                            <!-- / sumber dana penghasilan -->
                        </div>
                    </div>

                    <!-- menampilkan data detail debitur -->
                    <div id="form_detail_debitur">
                        <div class="col-md-12 p-2 mt-2">  
                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label font-weight-bold">NIK</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_nik">: <?= $deb['nik'] ?> </h6>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="nama_lengkap" class="col-sm-3 col-form-label font-weight-bold">Nama Lengkap</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_nama_lengkap">: <?= $deb['nama_lengkap'] ?> </h6>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Jenis Kelamin</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_jk">: <?= $deb['jenis_kelamin'] ?> </h6>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="tempat_lahir" class="col-sm-3 col-form-label font-weight-bold">Tempat Lahir</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_tempat_lahir">: <?= $deb['tempat_lahir'] ?> </h6>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label font-weight-bold">Tanggal Lahir</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_tgl_lahir">: <?= date('d-M-Y', strtotime($deb['tgl_lahir'])) ?> </h6>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Jenis Identitas</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_jns_identitas">: <?= $deb['jenis_identitas'] ?> </h6>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="no_identitas" class="col-sm-3 col-form-label font-weight-bold">No Identitas</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_no_identitas">: <?= $deb['no_identitas'] ?> </h6>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="status" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_status_nikah">: <?= $deb['status_nikah'] ?> </h6>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label font-weight-bold font-weight-bold">Warga Negara</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-3 mt-2">
                                            <h6 id="d_warga_negara">: <?= strtoupper($deb['warga_negara']) ?> </h6>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row in_negara" <?= ($deb['warga_negara'] == 'wna') ? '' : "style='display: none;'" ?> >
                                                <h6 class="font-weight-bold mt-2 col-md-3">Negara</h6>
                                                <h6 id="d_negara_wna">: <?= $deb['negara_wna'] ?> </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="agama" class="col-sm-3 col-form-label font-weight-bold">Agama</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_agama">: <?= $deb['agama'] ?> </h6>
                                </div>
                            </div> 
                            <!-- alamat rumah -->
                            <div class="form-group row">
                                <label for="alamat_rumah" class="col-sm-3 col-form-label font-weight-bold">Alamat Rumah</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-5 mt-2">
                                            <h6 id="d_alamat_rumah">: <?= $deb['alamat_rumah'] ?> </h6>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Provinsi</h6>
                                                <h6 id="d_provinsi_rumah" class="mt-2 col-md-9" align="justify">: <?= $deb['t_provinsi_rumah'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kota / Kab</h6>
                                                <h6 id="d_kota_kab_rumah" class="mt-2 col-md-9" align="justify">: <?= $deb['t_kota_kab_rumah'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kecamatan</h6>
                                                <h6 id="d_kecamatan_rumah" class="mt-2 col-md-9" align="justify">: <?= $deb['t_kecamatan_rumah'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kode Pos</h6>
                                                <h6 id="d_kode_pos_rumah" class="mt-2 col-md-9" align="justify">: <?= $deb['kode_pos_rumah'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!-- / alamat rumah -->
                            <div class="form-group row">
                                <label for="alamat_korespon" class="col-sm-3 col-form-label font-weight-bold">Alamat Korespondensi</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-5 mt-2">
                                            <h6 id="d_alamat_korespon">: <?= $deb['alamat_korespondensi'] ?> </h6>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Provinsi</h6>
                                                <h6 id="d_provinsi_korespon" class="mt-2 col-md-9" align="justify">: <?= $deb['t_provinsi_korespondensi'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kota / Kab</h6>
                                                <h6 id="d_kota_kab_korespon" class="mt-2 col-md-9" align="justify">: <?= $deb['t_kota_kab_korespondensi'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kecamatan</h6>
                                                <h6 id="d_kecamatan_korespon" class="mt-2 col-md-9" align="justify">: <?= $deb['t_kecamatan_korespondensi'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kode Pos</h6>
                                                <h6 id="d_kode_pos_korespon" class="mt-2 col-md-9" align="justify">: <?= $deb['kode_pos_korespondensi'] ?></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kontak" class="col-sm-3 col-form-label font-weight-bold">Kontak</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_kontak">: <?= $deb['kontak'] ?> </h6>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label font-weight-bold">Email</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_email">: <?= $deb['email'] ?> </h6>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="pekerjaan" class="col-sm-3 col-form-label font-weight-bold">Pekerjaan</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-5 mt-2">
                                            <h6 id="d_pekerjaan">: <?= $deb['pekerjaan'] ?> </h6>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="row">
                                                <label for="bagian" class="col-sm-3 col-form-label font-weight-bold">Bagian</label>
                                                <div class="col-sm-9 mt-2">
                                                    <h6 id="d_bagian">: <?= $deb['bagian'] ?> </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="alamat_kantor" class="col-sm-3 col-form-label font-weight-bold">Alamat Kantor</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-5 mt-2">
                                            <h6 id="d_alamat_kantor">: <?= $deb['alamat_kantor'] ?> </h6>
                                        </div>
                                        <div class="col-md-7">

                                            <div class="row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Provinsi</h6>
                                                <h6 id="d_provinsi_kantor" class="mt-2 col-md-9" align="justify">: <?= $deb['t_provinsi_kantor'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kota / Kab</h6>
                                                <h6 id="d_kota_kab_kantor" class="mt-2 col-md-9" align="justify">: <?= $deb['t_kota_kab_kantor'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kecamatan</h6>
                                                <h6 id="d_kecamatan_kantor" class="mt-2 col-md-9" align="justify">: <?= $deb['t_kecamatan_kantor'] ?></h6>
                                            </div>
                                            <div class="mt-2 row">
                                                <h6 class="font-weight-bold mt-2 col-md-3">Kode Pos</h6>
                                                <h6 id="d_kode_pos_kantor" class="mt-2 col-md-9" align="justify">: <?= $deb['kode_pos_kantor'] ?></h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="tujuan_beli_asuransi" class="col-sm-3 col-form-label font-weight-bold">Tujuan Membeli Asuransi</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_tujuan_beli_asuransi">: <?= $deb['tujuan_beli_asuransi'] ?> </h6>
                                </div>
                            </div> 
                            <!-- sumber dana pembelian -->
                            <div class="form-group row">
                                <label for="sumber_dana_beli" class="col-sm-3 col-form-label font-weight-bold">Sumber Dana Pembelian</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_sumber_dana_pembelian">: <?= $deb['sumber_dana_pembelian'] ?> </h6>
                                </div>
                            </div>  
                            <!-- / sumber dana pembelian -->
                            <div class="form-group row">
                                <label for="penghasilan_tahun" class="col-sm-3 col-form-label font-weight-bold">Penghasilan / Tahun</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_pengahasilan_per_tahun">: <?= $deb['penghasilan_per_tahun'] ?> </h6>
                                </div>
                            </div> 
                            <!-- sumber dana penghasilan -->
                            <div class="form-group row">
                                <label for="sumber_dana_penghasilan" class="col-sm-3 col-form-label font-weight-bold">Sumber Dana Penghasilan</label>
                                <div class="col-sm-9 mt-2">
                                <h6 id="d_sumber_dana_penghasilan">: <?= $deb['sumber_dana_penghasilan'] ?> </h6>
                                </div>
                            </div>  
                            <!-- / sumber dana penghasilan -->
                        </div>
                    </div> 

                    <!-- akhir menampilkan data detail debitur -->

                    <!-- data asuransi -->
                    <div class="col-md-12">
                        <h4 class="font-weight-bold">Data Asuransi</h4>
                        
                        <div class="form-group row">
                            <label for="id_jenis_kredit" class="col-sm-3 col-form-label font-weight-bold">Jenis Kredit</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_kredit" id="id_jenis_kredit" placeholder="Pilih Jenis Kredit">
                                    <option value=""></option>
                                    <?php foreach ($jns_kredit as $k): ?>
                                        <option value="<?= $k['id_jenis_kredit'] ?>" <?= ($k['id_jenis_kredit'] == $crp['id_jenis_kredit'] ? 'selected' : '') ?>><?= $k['jenis_kredit'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_produk" class="col-sm-3 col-form-label font-weight-bold">Jenis Produk</label>
                            <div class="col-sm-9">
                                <select name="id_jenis_produk" id="jenis_produk" placeholder="Pilih Jenis Produk">
                                    <option value=""></option>
                                    <?php foreach ($jenis_produk as $p): ?>
                                        <option value="<?= $p['id_jenis_produk'] ?>" <?= ($p['id_jenis_produk'] == $crp['id_jenis_produk'] ? 'selected' : '') ?>><?= $p['jenis_produk'] ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="id_jenis_tanggung" class="col-sm-3 col-form-label font-weight-bold">Jenis Pertanggungan</label>

                            <div class="col-sm-9 c_jenis_ptg1">
                                <!-- <select name="id_jenis_tanggung" id="id_jenis_tanggung" data-allow-clear="true" placeholder="Pilih Jenis Pertanggungan">
                                    <option value=""></option>
                                    <?php foreach ($jns_tanggung as $k): ?>
                                        <option value="<?= $k['id_jenis_tanggung'] ?>"><?= $k['jenis_tanggung'] ?></option>
                                    <?php endforeach; ?>
                                </select> -->
                                <?php foreach ($jns_tanggung as $jt): ?>

                                    <div class="custom-control custom-checkbox custom-control-inline">
                                        <input type="checkbox" id="<?= strtolower($jt['jenis_tanggung']) ?>" name="jenis_ptg[]" class="custom-control-input c_jp" value="<?= $jt['id_jenis_tanggung'] ?>" disabled>
                                        <label class="custom-control-label" for="<?= strtolower($jt['jenis_tanggung']) ?>"><?= $jt['jenis_tanggung'] ?></label>
                                    </div>

                                <?php endforeach;?>
                            </div>
                            <div class="col-sm-9 mt-2 c_jenis_ptg2" hidden>
                                <span>: <?= ($jml_jenis_jt == 1) ? $jenis_tanggung['jenis_tanggung'] : '' ?></span>
                                <input type="hidden" name="id_jenis_jt" id="id_jenis_jt" class="form-control" value="<?= $jml_jenis_jt ?>" nm_jenis="<?= ($jml_jenis_jt == 1) ? strtolower($jenis_tanggung['jenis_tanggung']) : '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_resiko" class="col-sm-3 col-form-label font-weight-bold">Jenis Resiko</label>
                            <div class="col-sm-9">
                                <select name="jenis_resiko[]" id="jenis_resiko" data-allow-clear="true" placeholder="  Pilih Jenis Resiko" multiple="" disabled>
                                    <?php foreach ($jenis_resiko_1 as $r): ?>
                                        <?php foreach ($jenis_resiko as $jr): ?>
                                            <option value="<?= $r['id_jenis_resiko'] ?>" <?= ($jr['id_jenis_resiko'] == $r['id_jenis_resiko']) ? 'selected' : '' ?>><?= $r['jenis_resiko'] ?></option>
                                        <?php endforeach;?>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3 nav_awal_klausal">
                            <div class="col-md-3 nav_klausal">
                                <ul class="nav nav-pills flex-column text-center" id="myTab" role="tablist">
                                    <?php foreach ($jns_tanggung as $t):
                                        // $tjenis = strtolower($t['jenis_tanggung']);
                                        $tjenis = $t['id_jenis_tanggung'];
                                    ?>
                                        <li class="nav-item nav_jenis nav_<?= $tjenis ?>" hidden>
                                            <a class="nav-link jenis_aktif jenis_aktif_<?= $tjenis ?>" id="nav<?= $tjenis ?>tab" data-toggle="tab" href="#nav<?= $tjenis ?>" role="tab" aria-controls="nav<?= $tjenis ?>" aria-selected="true" style="font-size: 17px;"><?= strtoupper($t['jenis_tanggung']) ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content" id="myTab1">
                                    <?php foreach ($jns_tanggung as $tt):
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
                                                    
                                                    $rp = $this->M_master->cari_data('tr_resiko_ptg', ['kode_tertanggung' => $kd_ptg, 'id_jenis_tanggung' => $tjenis1, 'id_jenis_resiko' => $id_jj])->row_array();
                                                ?>
                                                    
                                                    <div class="tab-pane fade resiko_tab <?= $tjenis1 ?>_resiko_tab <?= $tjenis1 ?>_resiko_tab<?= $id_jj ?>  p-3" id="rsk_<?= $tjenis1 ?>_resiko<?= $id_jj ?>" role="tabpanel" aria-labelledby="<?= $tjenis1 ?>_resiko<?= $id_jj ?>_tab">
                                                        
                                                        <div class="form-group row">
                                                            <label for="uang_pertanggungan_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label font-weight-bold">Uang Pertanggungan</label>
                                                            <div class="col-sm-9">
                                                                <div class="row">
                                                                    <div class="col-md-5">
                                                                        <input type="text" name="uang_pertanggungan_<?= $id_tjenis1.$id_jj ?>" style="font-size: 14px" id="uang_pertanggungan_<?= $id_tjenis1.$id_jj ?>" class="form-control separator" value="<?= $rp['uang_ptg'] ?>">
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <div class="row">
                                                                            <label for="bunga_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label font-weight-bold">Bunga</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="text" name="bunga_<?= $id_tjenis1.$id_jj ?>" style="font-size: 14px" id="bunga_<?= $id_tjenis1.$id_jj ?>" class="form-control angka" value="<?= $rp['bunga'] ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="masa_asuransi_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label font-weight-bold">Tanggal Akad</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <input type="text" style="font-size: 14px" name="tgl_akad_<?= $id_tjenis1.$id_jj ?>" id="tgl_akad_<?= $id_tjenis1.$id_jj ?>" id_jr = "<?= $id_tjenis1.$id_jj ?>" class="form-control datepicker2 tgl_akad" placeholder="Masukkan Tanggal Akad" aria-describedby="basic-addon2" value="<?= date("d-M-Y", strtotime($rp['tgl_akad'])) ?>" readonly>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label for="" class="col-sm-3 col-form-label font-weight-bold">Periode Asuransi</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control text-center" name="periode_asuransi_awal_<?= $id_tjenis1.$id_jj ?>" id="periode_asuransi_awal_<?= $id_tjenis1.$id_jj ?>" placeholder="Awal Periode" style="font-size: 14px;" value="<?= date("d-M-Y", strtotime($rp['periode_asuransi_awal'])) ?>" readonly required>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text bg-primary b-0 text-white">s / d</span>
                                                                    </div>
                                                                    <input type="text" class="form-control datepicker2 text-center periode_asuransi_akhir" name="periode_asuransi_akhir_<?= $id_tjenis1.$id_jj ?>" id="periode_asuransi_akhir_<?= $id_tjenis1.$id_jj ?>" id_jr="<?= $id_tjenis1.$id_jj ?>" placeholder="Akhir Periode" style="font-size: 14px;" value="<?= date("d-M-Y", strtotime($rp['periode_asuransi_akhir'])) ?>" readonly required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="masa_asuransi_<?= $id_tjenis1.$id_jj ?>" class="col-sm-3 col-form-label font-weight-bold">Masa Asuransi</label>
                                                            <div class="col-sm-9">
                                                                <div class="input-group">
                                                                    <input type="text" style="font-size: 14px" name="masa_asuransi_<?= $id_tjenis1.$id_jj ?>" id="masa_asuransi_<?= $id_tjenis1.$id_jj ?>" class="form-control" placeholder="Masukkan Masa Asuransi" value="<?= $rp['masa_asuransi'] ?>" readonly>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">Tahun</span>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                    <!-- akhir data asuransi -->
                    <br> 
                    <!-- data kesehatan -->
                    <div class="col-md-12">
                        <h4 class="font-weight-bold">Data Kesehatan</h4>
                        <div class="form-group row">
                            <label for="tinggi_badan" class="col-sm-5 col-form-label font-weight-bold">Tinggi Badan</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" style="font-size: 14px" name="tinggi_badan" id="tinggi_badan" class="form-control numeric" value="<?= $ptg['tinggi_badan'] ?>" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="berat_badan" class="col-sm-5 col-form-label font-weight-bold">Berat Badan</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" style="font-size: 14px" name="berat_badan" id="berat_badan" class="form-control numeric" value="<?= $ptg['berat_badan'] ?>" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Kg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanya_kesehatan_1" class="col-sm-5 col-form-label font-weight-bold">Apakah Dalam 5 tahun terakhir Anda pernah dioperasi/dirawat di Rumah Sakit atau dalam masa pengobatan/perawatan yang membutuhkan obat-obatan dalam masa yang lama? Jika "YA", jelaskan! </label>
                            <div class="col-sm-7">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="ty1" name="ty_1" class="custom-control-input" value="ya" <?= ($ptg['tanya_kesehatan_1_sts'] == 1) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ty1">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-2">
                                            <input type="radio" id="ty2" name="ty_1" class="custom-control-input" value="tidak" <?= ($ptg['tanya_kesehatan_1_sts'] == 0) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ty2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 t_satu" <?= ($ptg['tanya_kesehatan_1_sts'] == 0) ? 'style="display: none;"' : '' ?>>
                                        <textarea class="form-control" style="font-size: 14px;" name="tanya_kesehatan_1" id="tanya_kesehatan_1" cols="30" rows="10" placeholder="Jelaskan"><?= $ptg['tanya_kesehatan_1'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanya_kesehatan_2" class="col-sm-5 col-form-label font-weight-bold">Apakah Anda pernah atau sedang menderita penyakit atau pernah diberitahu atau dalam konsultasi perawatan/pengobatan/pengawasan/medis: jantung/nyeri dada, tekanan darah tinggi, stroke, tumor/benjolan. </label>
                            <div class="col-sm-7">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="ty1b" name="ty_2" class="custom-control-input" value="ya" <?= ($ptg['tanya_kesehatan_2_sts'] == 1) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ty1b">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-2">
                                            <input type="radio" id="ty2b" name="ty_2" class="custom-control-input" value="tidak" <?= ($ptg['tanya_kesehatan_2_sts'] == 0) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ty2b">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 t_dua" <?= ($ptg['tanya_kesehatan_2_sts'] == 0) ? 'style="display: none;"' : '' ?>>
                                        <textarea class="form-control" style="font-size: 14px;" name="tanya_kesehatan_2" id="tanya_kesehatan_2" cols="30" rows="10" placeholder="Jelaskan"><?= $ptg['tanya_kesehatan_2'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanya_kesehatan_3" class="col-sm-5 col-form-label font-weight-bold">Apakah anda sedang atau dianjurkan atau pernah mengalami konsultasi/rawat inap/operasi/biopsi/pemerikasaan laboratorium/EKG/Tream III/Echocandiogragraphy/USG/CT Scan/MRI/papsmear/Mamografi</label>
                            <div class="col-sm-7">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="ty1c" name="ty_3" class="custom-control-input" value="ya" <?= ($ptg['tanya_kesehatan_2_sts'] == 1) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ty1c">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-2">
                                            <input type="radio" id="ty2c" name="ty_3" class="custom-control-input" value="tidak" <?= ($ptg['tanya_kesehatan_2_sts'] == 0) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ty2c">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 t_tiga" <?= ($ptg['tanya_kesehatan_3_sts'] == 0) ? 'style="display: none;"' : '' ?>>
                                        <textarea class="form-control" style="font-size: 14px;" name="tanya_kesehatan_3" id="tanya_kesehatan_3" cols="30" rows="10" placeholder="Jelaskan"><?= $ptg['tanya_kesehatan_3'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">Khusus untuk wanita, Apakah anda sedang hamil?</label>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="ah1" name="tanya_hamil" class="custom-control-input" value="ya" <?= ($ptg['tanya_hamil'] == 1) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ah1">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio mt-2">
                                            <input type="radio" id="ah2" name="tanya_hamil" class="custom-control-input" value="tidak" <?= ($ptg['tanya_hamil'] == 0) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="ah2">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="col-md-10 j_anak mt-1" <?= ($ptg['tanya_hamil'] == 0) ? 'style="display: none;"' : '' ?>>
                                        <div class="row">
                                            <label for="ket3" class="col-sm-4 col-form-label font-weight-bold text-right">Kehamilan Anak ke- </label>
                                            <div class="col-sm-3">
                                                <input type="text" id="hamil_anak_ke" name="hamil_anak_ke" style="font-size: 14px;" class="form-control" value="<?= $ptg['hamil_anak_ke'] ?>" placeholder="Anak Ke-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- akhir data kesehatan -->
                    <br>
                    <!-- dokumen -->
                    
                    <!-- <div class="col-md-12">
                        <h4 class="font-weight-bold">Dokumen</h4>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label font-weight-bold">Upload SPAJK</label>
                            <div class="col-sm-9">
                                <input type="file" name="upload_spajk" style="font-size: 14px" id="upload_spajk" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label font-weight-bold">Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="file" name="kartu_keluarga" style="font-size: 14px" id="kartu_keluarga" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_spk" class="col-sm-3 col-form-label font-weight-bold">KTP Ahli Waris</label>
                            <div class="col-sm-9">
                                <input type="file" name="ktp_ahli_waris" style="font-size: 14px" id="ktp_ahli_waris" class="form-control">
                            </div>
                        </div>
                    </div> -->

                    <table class="table table-bordered table-striped tabel_dok_ptg aksi_hapus" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="40%">Nama Dokumen</th>
                                <th width="20%">Aksi</th>
                                <th width="10%">File</th>
                                <!-- <th width="10%">Validasi</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    
                    <!-- akhir dokumen -->

                </div>
            
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right" id="simpan_tertanggung1" style="background-color: #02a4af; color:white;">Simpan</button>
                    <button class="btn float-right" style="background-color: #eb5905; color:white;" id="sp_tambah_ttg" type="button" disabled hidden><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</button>
                </div>
            </div>
        </form>
    </div>
    
</div>

<div class="modal fade" id="modal_upload" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header text-white" style="background-color: #02a4af">
            <h5 class="modal-title font-weight-bold" id="judul_modal">Upload Dokumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
            </button>
        </div>
            <form id="form_dokumen" action="<?= base_url('C_pertanggungan/upload_dokumen_ptg') ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="id_dok" id="id_dok">
                <input type="hidden" name="status_jenis_dok" id="status_jenis_dok">
                <input type="hidden" name="id_ptg" value="<?= $id_data_ptg ?>">
                <input type="hidden" name="halaman" value="edit">
                <div class="modal-body">
                    <div class="">
                        <div class="col-md-12 p-3">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Jenis Dokumen</label>
                                <div class="col-sm-8 mt-2">
                                    <span class="font-weight-bold t_jenis_dok">:</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Upload</label>
                                <div class="col-sm-8 mt-2">
                                    <input type="file" name="upload_dok" id="upload_dok" class="form-control"> 
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

        sel_jenis_produk();

        var tabel_dok_ptg  = $('.tabel_dok_ptg').DataTable({
            "processing"    : true,
            "ajax"          : {
                "url"   : "<?= base_url() ?>C_pertanggungan/tampil_dokumen_ptg",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_ptg = $('.id_ptg').val();
                }
            },
            stateSave       : true,
            // "order"         : [[ 0, '' ]],
            "paging"        : false,
            "info"          : false,
            "searching"     : false,
            "columnDefs"     : [{
                "targets"       : [0,1,2,3],
                "orderable"     : false
            }, {
                "targets"       : [2,3],
                "className"     : "text-center"
            }]
        });

        $('.tabel_dok_ptg').on('click', '.upload', function () {

            var id_dok      = $(this).data('id');
            var jenis_dok   = $(this).attr('jenis_dok');

            $('#id_dok').val(id_dok);
            $('#status_jenis_dok').val('ptg');
            $('.t_jenis_dok').text(jenis_dok);

            $('#modal_upload').modal('show');

        })

        $('.aksi_hapus').on('click', '.remove', function () {

            var id_dok              = $(this).data('id');
            var jenis_dok           = $(this).attr('jenis_dok');
            var status_jenis_dok    = $(this).attr('status_jenis_dok');
            var id_ptg              = $('.id_ptg').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus dokumen '+jenis_dok+'?',
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
                    url         : "<?= base_url() ?>C_pertanggungan/hapus_dokumen",
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
                    data        : {id_dok:id_dok, status_jenis_dok:status_jenis_dok, id_ptg:id_ptg},
                    dataType    : "JSON",
                    success     : function (data) {

                        window.location = "<?= base_url() ?>C_pertanggungan/edit_ptg/"+id_ptg;

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
                            text                : 'Anda membatalkan hapus dokumen',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        });
                }

            });

        })

        function sel_jenis_produk() {

            var isi         = $('#jenis_produk').val();
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

                    var jml_jenis_jt    = $('#id_jenis_jt').val();
                    var nm_jenis_jt     = $('#id_jenis_jt').attr('nm_jenis');

                    if (jml_jenis_jt == 1) {

                        $('.c_jenis_ptg1').attr('hidden', true);
                        $('.c_jenis_ptg2').attr('hidden', false);

                        $('.c_ptg').prop('checked', false);
                        $('#'+nm_jenis_jt).prop('checked', true);

                    } else {

                        $('.c_jenis_ptg1').attr('hidden', false);
                        $('.c_jenis_ptg2').attr('hidden', true);

                        $('#um').prop('checked', true);
                        $('#ut').prop('checked', true);

                    }
                    
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
            
        }

        // 03-03-2021
        $('#jenis_produk').on('change', function () {

            sel_jenis_produk();
            
        })

        // 03-03-2021
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


                $('.nav_awal_klausal').attr('hidden', false);

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

        // 03-03-2021
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
            
            $('.nav_awal_klausal').attr('hidden', false);

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

        // 10-02-2021
        $('[name=sts_ktp]').on('change', function () {
            
            var th = $(this).val();

            if (th == 'ya') {
                $('.f_ktp').slideDown('fast');
            } else {
                $('.f_ktp').slideUp(300);
            }

        })

        // 10-02-2021
        $('[name=ty_1]').on('change', function () {
                
            var th = $(this).val();

            if (th == 'ya') {
                $('.t_satu').slideDown('fast');
            } else {
                $('.t_satu').slideUp(300);
            }

        })
        // 10-02-2021
        $('[name=ty_2]').on('change', function () {
                
            var th = $(this).val();

            if (th == 'ya') {
                $('.t_dua').slideDown('fast');
            } else {
                $('.t_dua').slideUp(300);
            }

        })
        // 10-02-2021
        $('[name=ty_3]').on('change', function () {
                
            var th = $(this).val();

            if (th == 'ya') {
                $('.t_tiga').slideDown('fast');
            } else {
                $('.t_tiga').slideUp(300);
            }

        })

        // 10-02-2021
        $('.tgl_akad').on('change', function () {
            
            var tgl     = $(this).val();
            var id_jr   = $(this).attr('id_jr');

            $('#periode_asuransi_awal_'+id_jr).val(tgl).trigger('change');

        })

        // 10-02-2021
        $('.periode_asuransi_akhir').on('change', function () {

            var id_jr           = $(this).attr('id_jr')
            var periode_awal    = $('#periode_asuransi_awal_'+id_jr).val();
            var periode_akhir   = $('#periode_asuransi_akhir_'+id_jr).val();
            
            $.ajax({
                url     : "<?= base_url() ?>C_pertanggungan/ambil_masa_asuransi",
                method  : "POST",
                data    : {periode_akhir:periode_akhir, periode_awal:periode_awal},
                dataType: "JSON",
                success : function (data) {

                    $('#masa_asuransi_'+id_jr).val(data.tahun);
                    
                }
            })

            return false;
        })

        $("input, textarea").keyup(function() {
            var val = $(this).val()
            $(this).val(val.toUpperCase());
        });

        // 16-02-2021
        $('#keluar_cbc').on('click', function () {

            $('#id_debitur').val('').trigger('change');
            $('#id_jenis_kredit').val('').trigger('change');
            $('#id_jenis_tanggung').val('').trigger('change');
            $('#form_tertanggung').trigger('reset');
            $('.f_lima').slideUp('fast');
            $('.f_empat').slideUp('fast');
            $('.f_tiga').slideDown(300);

            tabel_tertanggung.ajax.reload(null, false);
            
        })

        // 18-02-2021
        $('#simpan_dok_cbc').on('click', function () {

            var form        = $('#form_dokumen_cbc')[0];
            var formData    = new FormData(form);

            $('#sp_tambah_cbc').attr('hidden', false);
            $('#simpan_dok_cbc').attr('hidden', true);

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
                        url         : "<?= base_url() ?>C_pertanggungan/simpan_dokumen_cbc", 
                        cache       : false,
                        contentType : false,
                        processData : false,
                        data        : formData,
                        type        : 'post',
                        dataType    : "JSON",
                        success: function (data) {

                            $('#sp_tambah_cbc').attr('hidden', true);
                            $('#simpan_dok_cbc').attr('hidden', false);

                            $('.f_lima').slideUp('fast');
                            $('.f_empat').slideUp('fast');
                            $('.f_tiga').slideUp('fast');
                            $('.f_dua').slideDown(300);

                            tabel_tertanggung.ajax.reload(null, false);
                            
                        }
                    });

                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {

                    $('#sp_tambah_cbc').attr('hidden', true);
                    $('#simpan_dok_cbc').attr('hidden', false);

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
            });
            
        })

        // 10-02-2021
        $('#simpan_tertanggung').on('click', function () {

            var form        = $('#form_tertanggung')[0];
            var formData    = new FormData(form);

            $('#sp_tambah_ttg').attr('hidden', false);
            $('#simpan_tertanggung').attr('hidden', true);

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
                        url         : "<?= base_url() ?>C_pertanggungan/simpan_tertanggung", 
                        cache       : false,
                        contentType : false,
                        processData : false,
                        data        : formData,
                        type        : 'post',
                        dataType    : "JSON",
                        success: function (data) {

                            var status_udw      = data.sts_udw;
                            var id_sts_udw      = data.id_sts_udw;
                            var nm_status_cash  = data.nm_status_cash;
                            var nama_debitur    = data.nama_debitur;
                            var nik             = data.nik;
                            var usia            = data.usia;
                            var uang_ptg        = data.uang_ptg;
                            var premi           = data.premi;
                            var masa_asuransi   = data.masa_asuransi;
                            
                            var t_s = '';

                            if (nm_status_cash == 'CAC') {
                                t_s = nm_status_cash;
                                $('.covernote').attr("hidden", false);
                                $('.dokumen_cbc').attr("hidden", true);
                                $('#simpan_cbc').attr("hidden", true);
                            } else {
                                t_s = nm_status_cash+" ("+status_udw+") ";
                                $('.covernote').attr("hidden", true);
                                $('.dokumen_cbc').attr("hidden", false);
                                $('#simpan_dok_cbc').attr("hidden", false);
                            }
                            
                            $('.t_nama_debitur').text(": "+nama_debitur);
                            $('.t_nik').text(": "+nik);
                            $('.t_usia').text(": "+usia+" Tahun");
                            $('.t_up').text(": "+uang_ptg);
                            $('.t_premi').text(": "+premi);
                            $('.t_masa_asuransi').text(": "+masa_asuransi+" Tahun");
                            $('.t_sts_udw').text(": "+t_s);
                            $('.dok_cbc').html(data.list_dok_cbc);

                            $('#id_ptg').val(data.id_ptg);
                            $('#jml_dok').val(data.jml_dok);
                            $('#id_sts_udw_t').val(data.id_sts_udw);
                            $('#id_asuransi_t').val(data.id_asuransi);

                            $('.f_tiga').slideUp('fast');
                            $('.f_lima').slideDown(300);

                            $('#sp_tambah_ttg').attr('hidden', true);
                            $('#simpan_tertanggung').attr('hidden', false);

                        }
                    });

                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {

                    $('#sp_tambah_ttg').attr('hidden', true);
                    $('#simpan_tertanggung').attr('hidden', false);

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
            });

        })

        // menampilkan form debitur
            $('#tambah_debitur').on('click', function () {
                
                $('#id_debitur').attr('disabled', true);
                $('#st_debitur').val('tambah_baru');
                $(this).slideUp('fast');
                $('#btl_tambah_debitur').slideDown('fast');
                $('#form_tambah_debitur').fadeIn('fast');
                $('#form_detail_debitur').fadeOut('fast');

                // $('#id_debitur').val('').trigger('change');
                $('.aksi_tambah_debitur').val('tambah_debitur');

            })

            // menampilkan form debitur
            $('#btl_tambah_debitur').on('click', function () {
                
                $('#id_debitur').removeAttr('disabled');
                $('#st_debitur').val('tambah');
                $(this).slideUp('fast');
                $('#tambah_debitur').slideDown('fast');
                $('#form_tambah_debitur').fadeOut('fast');
                $('#form_detail_debitur').fadeIn('fast');

                $('.aksi_tambah_debitur').val('');

            })

            // aksi kembali satu
            $('.kembali_satu').on('click', function () {
                
                $('.f_dua').slideUp('fast');
                $('.f_tiga').slideUp('fast');
                $('.f_empat').slideUp('fast');
                $('.f_satu').slideDown(300);

                tabel_awal_tertanggung.ajax.reload(null, false);

            })

            // aksi kembali dua
            $('.kembali_dua').on('click', function () {
                
                $('.f_tiga').slideUp('fast');
                $('.f_dua').slideDown(300);

                tabel_tertanggung.ajax.reload(null, false);

            })

            // menampilkan halaman tambah data pertanggungan
            $('#tambah_pertanggungan').on('click', function () {
                
                var id_spk = $('.id_spk').val();
                var id_bpr = $('.id_bpr').val();

                $('#tambah_pertanggungan').attr('hidden', true);
                $('#sp_tambah').attr('hidden', false);

                $.ajax({
                    url         : "<?= base_url() ?>C_pertanggungan/halaman_detail_debitur",
                    type        : "POST",
                    // beforeSend  : function () {
                    //     swal({
                    //         title   : 'Menunggu',
                    //         html    : 'Memproses Data',
                    //         onOpen  : () => {
                    //             swal.showLoading();
                    //         }
                    //     })
                    // },
                    data        : {id_spk:id_spk, id_bpr:id_bpr},
                    dataType    : "JSON",
                    success     : function(data)
                    {

                        swal.close();

                        $('#tambah_pertanggungan').attr('hidden', false);
                        $('#sp_tambah').attr('hidden', true);

                        $('.f_dua').slideUp('fast');
                        $('.f_tiga').slideDown(300);

                        // $('#id_debitur').html(data.debitur);

                        // $('#id_debitur').select2('val', ' ');

                        $('.nav-tabs a[href="#nav_data_tertanggung"]').tab('show');

                        $('#nav_data_tertanggung_tab').css({"color": "#eb5905"});
                        $('#nav_data_asuransi_tab').css({"color": "#02a4af"});
                        $('#nav_ket_sehat_tab').css({"color": "#02a4af"});
                        $('#nav_pernyataan_tab').css({"color": "#02a4af"});

                        $('#judul_tambah').text('Tambah Data '+data.nama_bpr+' | No.Spk: '+data.no_spk);
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                })

                return false;

            })

            // menampilkan input wna
            $('[name=warga_negara]').on('change', function () {
            
                var wn = $(this).val();

                if (wn == 'wna') {
                    $('#input_wna').fadeIn('fast');
                } else {
                    $('#input_wna').fadeOut(300);
                }

            })

            // menampilkan data sumber data beli lainnya
            $('[name=sumber_dana_beli]').on('change', function () {
                
                var sdb = $(this).val();

                if (sdb == 'lainnya') {
                    $('#sdb_lainnya').fadeIn('fast');
                } else {
                    $('#sdb_lainnya').fadeOut(300);
                }

            })

            // menampilkan data sumber data penghasilan lainnya
            $('[name=sumber_dana_penghasilan]').on('change', function () {
                
                var sdp = $(this).val();

                if (sdp == 'lainnya') {
                    $('#sdp_lainnya').fadeIn('fast');
                } else {
                    $('#sdp_lainnya').fadeOut(300);
                }

            })

            // menampilkan input hubungan dari ahli waris
            $('#ahli_waris').on('keyup', function () {

                var hasil = $(this).val();

                if (hasil != '') {
                    $('#hub_ahli_waris').val('');
                    $('.hubungan').fadeIn('fast');
                } else {
                    $('#hub_ahli_waris').val('');
                    $('.hubungan').fadeOut(300);
                }

            }) 

            // menampilkan input jika iya diperusahaan mana
            $('[name=apakah]').on('change', function () {
                
                var apk = $(this).val();

                if (apk == 'ya') {
                    $('.jelaskan').fadeIn('fast');
                } else {
                    $('.jelaskan').fadeOut(300);
                }
            })

            // menampilkan input jika iya sedang hamil
            $('[name=apakah2]').on('change', function () {
                
                var apk2 = $(this).val();

                if (apk2 == 'ya') {
                    $('.j_anak').fadeIn('fast');
                } else {
                    $('.j_anak').fadeOut(300);
                }
            })

            $('#id_provinsi').select2('val', ' ');
            $('#id_provinsi_korespon').select2('val', ' ');
            $('#id_provinsi_kantor').select2('val', ' ');

            $('#loading_kota_kab').hide();
            $('#loading_kecamatan').hide();
            $('#loading_kota_kab_korespon').hide();
            $('#loading_kecamatan_korespon').hide();
            $('#loading_kota_kab_kantor').hide();
            $('#loading_kecamatan_kantor').hide();

            // aksi jika change provinsi
            $('#id_provinsi').on('change', function () {

                var id_provinsi = $(this).val();

                $('#kota_kab').next('.select2-container').hide();
                $('#loading_kota_kab').show();

                $.ajax({
                    url     : "C_master/ambil_option_kota_kab",
                    type    : "POST",
                    data    : {id_provinsi:id_provinsi, id_kota_kab:''},
                    dataType: "JSON",
                    success : function (data) {
                        
                        $('#loading_kota_kab').hide();
                        $('#kota_kab').next('.select2-container').show();
                        $('#kota_kab').html(data.kab_kota);

                        $('#kota_kab').select2('val', ' ');

                    }
                })

            })

            // aksi jika change provinsi korespon
            $('#id_provinsi_korespon').on('change', function () {

                var id_provinsi_korespon = $(this).val();

                $('#kota_kab_korespon').next('.select2-container').hide();
                $('#loading_kota_kab_korespon').show();

                $.ajax({
                    url     : "C_master/ambil_option_kota_kab",
                    type    : "POST",
                    data    : {id_provinsi:id_provinsi_korespon, id_kota_kab:''},
                    dataType: "JSON",
                    success : function (data) {
                        
                        $('#loading_kota_kab_korespon').hide();
                        $('#kota_kab_korespon').next('.select2-container').show();
                        $('#kota_kab_korespon').html(data.kab_kota);

                        $('#kota_kab_korespon').select2('val', ' ');

                    }
                })

            })

            // aksi jika change provinsi kantor
            $('#id_provinsi_kantor').on('change', function () {

                var id_provinsi_kantor = $(this).val();

                $('#kota_kab_kantor').next('.select2-container').hide();
                $('#loading_kota_kab_kantor').show();

                $.ajax({
                    url     : "C_master/ambil_option_kota_kab",
                    type    : "POST",
                    data    : {id_provinsi:id_provinsi_kantor, id_kota_kab:''},
                    dataType: "JSON",
                    success : function (data) {
                        
                        $('#loading_kota_kab_kantor').hide();
                        $('#kota_kab_kantor').next('.select2-container').show();
                        $('#kota_kab_kantor').html(data.kab_kota);

                        $('#kota_kab_kantor').select2('val', ' ');

                    }
                })

            })

            // aksi jika change kota/kab
            $('#kota_kab').on('change', function () {

                var id_kota_kab = $(this).val();

                $('#id_kecamatan').next('.select2-container').hide();
                $('#loading_kecamatan').show();

                $.ajax({
                    url     : "C_master/ambil_option_kecamatan",
                    type    : "POST",
                    data    : {id_kota_kab:id_kota_kab},
                    dataType: "JSON",
                    success : function (data) {
                        
                        $('#loading_kecamatan').hide();
                        $('#id_kecamatan').next('.select2-container').show();
                        $('#id_kecamatan').html(data.kecamatan);

                        $('#id_kecamatan').select2('val', ' ');

                    }
                })

            })

            // aksi jika change kota/kab korespon
            $('#kota_kab_korespon').on('change', function () {

                var id_kota_kab_korespon = $(this).val();

                $('#id_kecamatan_korespon').next('.select2-container').hide();
                $('#loading_kecamatan_korespon').show();

                $.ajax({
                    url     : "C_master/ambil_option_kecamatan",
                    type    : "POST",
                    data    : {id_kota_kab:id_kota_kab_korespon},
                    dataType: "JSON",
                    success : function (data) {
                        
                        $('#loading_kecamatan_korespon').hide();
                        $('#id_kecamatan_korespon').next('.select2-container').show();
                        $('#id_kecamatan_korespon').html(data.kecamatan);

                        $('#id_kecamatan_korespon').select2('val', ' ');

                    }
                })

            })

            // aksi jika change kota/kab kantor
            $('#kota_kab_kantor').on('change', function () {

                var id_kota_kab_kantor = $(this).val();

                $('#id_kecamatan_kantor').next('.select2-container').hide();
                $('#loading_kecamatan_kantor').show();

                $.ajax({
                    url     : "C_master/ambil_option_kecamatan",
                    type    : "POST",
                    data    : {id_kota_kab:id_kota_kab_kantor},
                    dataType: "JSON",
                    success : function (data) {
                        
                        $('#loading_kecamatan_kantor').hide();
                        $('#id_kecamatan_kantor').next('.select2-container').show();
                        $('#id_kecamatan_kantor').html(data.kecamatan);

                        $('#id_kecamatan_kantor').select2('val', ' ');

                    }
                })

            })

        // 07-05-2020
            
            // aksi hapus data tanggungan 
            $('.tabel_tertanggung').on('click', '.hapus-tanggungan', function () {
                
                var id_tanggungan = $(this).data('id');
                var id_spk        = $('.id_spk').val();
                var id_bpr        = $('.id_bpr').val();

                // menampilkan tabel_tertanggung
                var tabel_tertanggung = $('.tabel_tertanggung').DataTable({
                    "processing"        : true,
                    "serverSide"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "C_pertanggungan/tampil_data_debitur",
                        "type"  : "POST",
                        "data"  : function (data) {
                            data.id_spk = id_spk;
                            data.id_bpr = id_bpr;
                        }
                    },
                    "columnDefs"        : [{
                        "targets"   : [0,7],
                        "orderable" : false
                    }, {
                        'targets'   : [0,7],
                        'className' : 'text-center',
                    }],
                    // "scrollX"           : false,
                    "bDestroy"          : true,
                    "initComplete": function (settings, json) {  
                        $(".tabel_tertanggung").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
                    },

                })

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
                            url         : "<?= base_url() ?>C_pertanggungan/hapus_tanggungan",
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
                            data        : {id_tanggungan:id_tanggungan},
                            dataType    : "JSON",
                            success     : function (data) {

                                tabel_tertanggung.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus data',
                                    text                : 'Data Tanggungan Berhasil Dihapus',
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
                                text                : 'Anda membatalkan hapus data tertanggung',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 
                    }
                })

            })

            // proses simpan data debitur
            $('#simpan_data_debitur').on('click', function () {

                var form_tambah_debitur = $('#form_tambah_debitur').serialize();
                var aksi_tambah_debitur = $('.aksi_tambah_debitur').val();
                var st_debitur          = $('#st_debitur').val();

                var form_tambah;
                var id_debitur  = $('#id_debitur').val();

                if (aksi_tambah_debitur == 'tambah_debitur') {
                    form_tambah = form_tambah_debitur;
                } else {
                    form_tambah = {id_debitur:id_debitur};
                }

                if (st_debitur == 'tambah') {

                    if (id_debitur == null) {
                        swal({
                            title               : "Peringatan",
                            text                : 'Pilih Debitur dahulu !',
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
                                    url     : "C_pertanggungan/simpan_data_debitur",
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
                                    data    : form_tambah,
                                    dataType: "JSON",
                                    success : function (data) {
                                        
                                        swal({
                                            title               : "Berhasil",
                                            text                : 'Data berhasil disimpan',
                                            buttonsStyling      : false,
                                            confirmButtonClass  : "btn btn-success",
                                            type                : 'success',
                                            showConfirmButton   : false,
                                            timer               : 1000
                                        });    

                                        $('.nav-tabs a[href="#nav_data_asuransi"]').tab('show');

                                        $('#nav_data_asuransi_tab').css({"color": "#eb5905"});
                                        $('#nav_data_tertanggung_tab').css({"color": "#02a4af"});
                                        $('#nav_ket_sehat_tab').css({"color": "#02a4af"});
                                        $('#nav_pernyataan_tab').css({"color": "#02a4af"});

                                        $('.id_pertanggungan').val(data.id_tanggungan);

                                        $('.aksi').val('Tambah');

                                        $('.f_simpan_debitur').fadeOut('fast');

                                        $('.sudah_1').fadeIn(300);
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
                                url     : "C_pertanggungan/simpan_data_debitur",
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
                                data    : form_tambah,
                                dataType: "JSON",
                                success : function (data) {
                                    
                                    swal({
                                        title               : "Berhasil",
                                        text                : 'Data berhasil disimpan',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });    

                                    $('.nav-tabs a[href="#nav_data_asuransi"]').tab('show');

                                    $('#nav_data_asuransi_tab').css({"color": "#eb5905"});
                                    $('#nav_data_tertanggung_tab').css({"color": "#02a4af"});
                                    $('#nav_ket_sehat_tab').css({"color": "#02a4af"});
                                    $('#nav_pernyataan_tab').css({"color": "#02a4af"});

                                    $('.id_pertanggungan').val(data.id_tanggungan);

                                    $('.aksi').val('Tambah');

                                    $('.f_simpan_debitur').fadeOut('fast');

                                    $('.sudah_1').fadeIn(300);
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

            // proses simpan data asuransi
            $('#simpan_data_asuransi').on('click', function () {

                var form_data_asuransi = $('#form_data_asuransi').serialize();

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
                            url     : "C_pertanggungan/simpan_data_asuransi",
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
                            data    : form_data_asuransi,
                            dataType: "JSON",
                            success : function (data) {
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    

                                $('.nav-tabs a[href="#nav_ket_sehat"]').tab('show');

                                $('#nav_data_asuransi_tab').css({"color": "#02a4af"});
                                $('#nav_data_tertanggung_tab').css({"color": "#eb5905"});
                                $('#nav_ket_sehat_tab').css({"color": "#02a4af"});
                                $('#nav_pernyataan_tab').css({"color": "#02a4af"});

                                $('.id_pertanggungan').val(data.id_tanggungan);

                                $('.f_simpan_data_asuransi').fadeOut('fast');

                                $('.aksi').val('Tambah');

                                $('.sudah_2').fadeIn(300);
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

            })

            // ubah warna aktif
            $('#nav_data_tertanggung_tab').on('click', function () {

                $(this).css({"color": "#eb5905"});
                $('#nav_data_asuransi_tab').css({"color": "#02a4af"});
                $('#nav_ket_sehat_tab').css({"color": "#02a4af"});
                $('#nav_pernyataan_tab').css({"color": "#02a4af"});

            })

            // ubah warna aktif
            $('#nav_data_asuransi_tab').on('click', function () {

                $(this).css({"color": "#eb5905"});
                $('#nav_data_tertanggung_tab').css({"color": "#02a4af"});
                $('#nav_ket_sehat_tab').css({"color": "#02a4af"});
                $('#nav_pernyataan_tab').css({"color": "#02a4af"});

            })

            // ubah warna aktif
            $('#nav_ket_sehat_tab').on('click', function () {

                $(this).css({"color": "#eb5905"});
                $('#nav_data_tertanggung_tab').css({"color": "#02a4af"});
                $('#nav_data_asuransi_tab').css({"color": "#02a4af"});
                $('#nav_pernyataan_tab').css({"color": "#02a4af"});

            })

            // ubah warna aktif
            $('#nav_pernyataan_tab').on('click', function () {

                $(this).css({"color": "#eb5905"});
                $('#nav_data_tertanggung_tab').css({"color": "#02a4af"});
                $('#nav_data_asuransi_tab').css({"color": "#02a4af"});
                $('#nav_ket_sehat_tab').css({"color": "#02a4af"});

            })

        // 13-05-2020

            function first_upper(str) {
                var str  = "";
                var lt  = "";

                str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    ltr = letter.toUpperCase();
                });

                return ltr;
            }

            function cari_data_provinsi(tes) {

                var a = '';
                
                $.ajax({
                    url     : "<?= base_url('C_pertanggungan/cari_data_provinsi') ?>",
                    type    : "POST",
                    async   : "false",
                    data    : {id:tes},
                    dataType: "JSON",
                    success : function (data) {
                        
                        return data.provinsi;

                    }
                })

            }
            
            // menampilkan data debitur on change
            $('.id_deb_pilih').on('change', function () {
                
                var id_debitur = $(this).val();

                console.log(id_debitur);

                $('#d_nik').text(": ");
                $('#d_nama_lengkap').text(": ");
                $('#d_jk').text(": ");
                $('#d_tempat_lahir').text(": ");
                $('#d_tgl_lahir').text(": ");
                $('#d_jns_identitas').text(": ");
                $('#d_no_identitas').text(": ");
                $('#d_status_nikah').text(": ");
                $('#d_warga_negara').text(": ");
                $('#d_agama').text(": ");
                $('#d_alamat_rumah').text(": ");
                $('#d_kode_pos_rumah').text(": ");
                $('#d_provinsi_rumah').text(": ");
                $('#d_kota_kab_rumah').text(": ");
                $('#d_kecamatan_rumah').text(": ");
                $('#d_alamat_korespon').text(": ");
                $('#d_kode_pos_korespon').text(": ");
                $('#d_provinsi_korespon').text(": ");
                $('#d_kota_kab_korespon').text(": ");
                $('#d_kecamatan_korespon').text(": ");
                $('#d_alamat_kantor').text(": ");
                $('#d_kode_pos_kantor').text(": ");
                $('#d_provinsi_kantor').text(": ");
                $('#d_kota_kab_kantor').text(": ");
                $('#d_kecamatan_kantor').text(": ");
                $('#d_kontak').text(": ");
                $('#d_email').text(": ");
                $('#d_pekerjaan').text(": ");
                $('#d_bagian').text(": ");
                $('#d_tujuan_beli_asuransi').text(": ");
                $('#d_sumber_dana_pembelian').text(": ");
                $('#d_pengahasilan_per_tahun').text(": ");
                $('#d_sumber_dana_penghasilan').text(": ");    

                if (id_debitur != '') {

                    $.ajax({
                        url         : "<?= base_url() ?>C_pertanggungan/ambil_detail_debitur",
                        type        : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {id_debitur:id_debitur},
                        dataType    : "JSON",
                        success     : function(data)
                        {
                            swal.close();
                            
                            $('#form_detail_debitur').fadeIn('fast');

                            $('#d_nik').text(": "+data.nik);
                            $('#d_nama_lengkap').text(": "+data.nama_lengkap);
                            $('#d_jk').text(": "+data.jenis_kelamin);
                            $('#d_tempat_lahir').text(": "+data.tempat_lahir);
                            $('#d_tgl_lahir').text(": "+moment(data.tgl_lahir).format('DD MMMM YYYY'));
                            $('#d_jns_identitas').text(": "+data.jenis_identitas);
                            $('#d_no_identitas').text(": "+data.no_identitas);
                            $('#d_status_nikah').text((data.status_nikah == 'JandaatauDuda') ? ': Janda / Duda' : ": "+data.status_nikah);
                            $('#d_warga_negara').text(": "+data.warga_negara.toUpperCase());

                            var agama = data.agama.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                                return letter.toUpperCase();
                            });

                            $('#d_agama').text(": "+agama);
                            $('#d_alamat_rumah').text(": "+data.alamat_rumah);
                            $('#d_kode_pos_rumah').text((data.kode_pos_rumah == null) ? ': -' : ": "+data.kode_pos_rumah);
                            $('#d_provinsi_rumah').text(": "+data[0].provinsi_rumah);
                            $('#d_kota_kab_rumah').text(": "+data[0].kota_kab_rumah);
                            $('#d_kecamatan_rumah').text(": "+data[0].kecamatan_rumah);

                            $('#d_alamat_korespon').text(": "+data.alamat_korespondensi);
                            $('#d_kode_pos_korespon').text((data.kode_pos_korespondensi == null) ? ': -' : ": "+data.kode_pos_korespondensi);
                            $('#d_provinsi_korespon').text(": "+data[0].provinsi_korespon);
                            $('#d_kota_kab_korespon').text(": "+data[0].kota_kab_korespon);
                            $('#d_kecamatan_korespon').text(": "+data[0].kecamatan_korespon);

                            $('#d_alamat_kantor').text(": "+data.alamat_kantor);
                            $('#d_kode_pos_kantor').text((data.kode_pos_kantor == null) ? ': -' : ": "+data.kode_pos_kantor);
                            $('#d_provinsi_kantor').text(": "+data[0].provinsi_kantor);
                            $('#d_kota_kab_kantor').text(": "+data[0].kota_kab_kantor);
                            $('#d_kecamatan_kantor').text(": "+data[0].kecamatan_kantor);

                            $('#d_kontak').text(": "+data.kontak);
                            $('#d_email').text(": "+data.email);

                            $('#d_pekerjaan').text(": "+data.pekerjaan);
                            $('#d_bagian').text(": "+data.bagian);
                            $('#d_tujuan_beli_asuransi').text(": "+data.tujuan_beli_asuransi);
                            $('#d_sumber_dana_pembelian').text(": "+data.sumber_dana_pembelian);
                            $('#d_pengahasilan_per_tahun').text(": "+data.pengahasilan_per_tahun);
                            $('#d_sumber_dana_penghasilan').text(": "+data.sumber_dana_penghasilan);

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    })

                    return false;

                } else {

                    $('#form_detail_debitur').fadeOut(300);

                }

            })

            // proses simpan data asuransi
            $('#simpan_ket_sehat').on('click', function () {

                var form_ket_sehat = $('#form_ket_sehat').serialize();

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
                            url     : "C_pertanggungan/simpan_ket_sehat",
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
                            data    : form_ket_sehat,
                            dataType: "JSON",
                            success : function (data) {
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    

                                $('.nav-tabs a[href="#nav_pernyataan"]').tab('show');

                                $('#nav_data_asuransi_tab').css({"color": "#02a4af"});
                                $('#nav_data_tertanggung_tab').css({"color": "#02a4af"});
                                $('#nav_ket_sehat_tab').css({"color": "#eb5905"});
                                $('#nav_pernyataan_tab').css({"color": "#02a4af"});

                                $('.id_pertanggungan').val(data.id_tanggungan);

                                $('.f_simpan_ket_sehat').fadeOut('fast');

                                $('.aksi').val('Tambah');

                                $('.sudah_3').fadeIn(300);
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

            })

        // 28-05-2020
            // menampilkan input ibu hamil
            $('[name=tanya_hamil]').on('change', function () {
                
                var th = $(this).val();

                if (th == 'ya') {
                    $('.j_anak').fadeIn('fast');
                } else {
                    $('.j_anak').fadeOut(300);
                }

            })

            // proses upload spajk
            $('#dok_pernyataan_spajk').on('change', function () {
                
                console.log('masukk');

            })
        
    })

</script>