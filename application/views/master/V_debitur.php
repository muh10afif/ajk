<style>
    #simpan_debitur { position: fixed; bottom:70px; right: 25px; }
</style>
<div class="row f_satu">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul" class="font-weight-bold">Master Data Debitur</h4>
            </div>
            <div class="card-body table-responsive">

                <table class="table table-bordered table-hover" id="tabel_debitur_total" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">No SPK</th>
                                <th width="20%">Nama BPR</th>
                                <th width="20%">Total Debitur</th>
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

<div class="row f_dua" style="display: none;">

    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Master Data Debitur</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Debitur</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <button class="btn mb-3 float-right" style="background-color: #02a4af; color:white;"  id="kembali_satu" type="button"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
    </div>
    
    <div class="col-md-12 mt-1">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_debitur">Tambah Data</button>
                <h4 id="judul_debitur" class="font-weight-bold">List Debitur</h4></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover tabel_debitur" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">NIK</th>
                            <th width="20%">Nama Lengkap</th>
                            <th width="20%">Jenis Kelamin</th>
                            <th width="20%">Tempat Lahir</th>
                            <th width="20%">Tanggal Lahir</th>
                            <th width="20%">Kontak</th>
                            <th width="20%">Email</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row f_tiga" style="display: none;">

    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Master Data Debitur</li>
                <li class="breadcrumb-item" style="color: #02a4af">Detail Debitur</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Debitur</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <button class="btn mb-3 float-right" style="background-color: #02a4af; color:white;"  id="kembali_dua" type="button"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
    </div>
    
    <div class="col-md-12 mt-1">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul_2" class="font-weight-bold">Tambah Data <span class="font-weight-bold text_nm_bpr"></span> <span class="font-weight-bold text_no_spk"></span> </h4></div>
            <div class="card-body table-responsive">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active font-weight-bold" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Input Manual</a>
                        <a class="nav-item nav-link font-weight-bold" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Upload data</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form id="form_tambah_debitur" autocomplete="off">
                            <input type="hidden" name="aksi" class="aksi" value="Tambah">
                            <input type="hidden" name="id_spk" class="id_spk">
                            <input type="hidden" name="id_bpr" class="id_bpr">
                            <input type="hidden" name="id_debitur" id="id_debitur" class="id_debitur">
                            <div class="col-md-12 p-5">
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
                                    <label for="tempat_lahir" class="col-sm-3 col-form-label font-weight-bold">Tempat Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" style="font-size: 14px;" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-3 col-form-label font-weight-bold">Tanggal Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datepicker2" style="font-size: 14px;" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan Tanggal Lahir" readonly>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Jenis Identitas</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="ji1" name="jenis_identitas" class="custom-control-input" value="KTP">
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
                                            <input type="radio" id="st3" name="status_nikah" class="custom-control-input" value="JandaatauDuda">
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
                                <!-- / alamat rumah -->
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
                        </form>
                        <!-- <div id="simpan_debitur">
                            <button class="btn btn-warning mr-3">Simpan</button>
                            <button class="btn btn-secondary">Reset</button>
                        </div> -->
                        <div id="simpan_debitur2" class="d-flex justify-content-end">
                            <button class="btn btn-warning mr-3" id="simpan_data_debitur">Simpan</button>
                            <button class="btn btn-secondary" id="reset_data_debitur">Reset</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <form id="form_upload_data" autocomplete="off">
                            <input type="hidden" name="id_spk" class="id_spk">
                            <input type="hidden" name="id_bpr" class="id_bpr">
                            <div class="col-md-12 p-5">
                                
                                <div class="form-group row">
                                    <label for="no_spk" class="col-sm-3 col-form-label font-weight-bold">Upload Data</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="dok_data_debitur" style="font-size: 14px" id="dok_data_debitur" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                            <div id="" class="d-flex justify-content-end">
                                <button class="btn btn-warning mr-3" id="upload">Upload</button>
                                <button class="btn btn-secondary">Reset</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {


    // 04-05-2020

        // menampilkan tabel awal debitur dengan total
        var tabel_debitur_total = $('#tabel_debitur_total').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_debitur_total",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            }],
            "scrollX"           : true

        })
    
    // 26-04-2020

        $('#input_wna').fadeOut('fast');

        $('#tabel_debitur_total').on('click', '.lihat-debitur', function () {

            var id_spk  = $(this).data('id');
            var id_bpr  = $(this).attr('id_bpr');

            console.log(id_spk)

            // menampilkan tabel debitur
            var tabel_debitur = $('.tabel_debitur').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "tampil_data_debitur",
                    "type"  : "POST",
                    "data"  : function (data) {
                        data.id_spk = id_spk;
                    }
                },
                "columnDefs"        : [{
                    "targets"   : [0,8],
                    "orderable" : false
                }, {
                    'targets'   : [0,8],
                    'className' : 'text-center',
                }],
                "scrollX"           : true,
                "bDestroy"          : true

            })

            $.ajax({
                url         : "ambil_data_detail_debitur",
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
                data        : {id_spk:id_spk, id_bpr:id_bpr},
                dataType    : "JSON",
                success     : function (data) {

                    swal.close();

                    $('.f_satu').slideUp('fast');
                    $('.f_dua').slideDown(300);

                    tabel_debitur.ajax.reload(null, false);

                    $('.id_spk').val(id_spk);
                    $('.id_bpr').val(id_bpr);

                    $('#judul_debitur').text(data.nama_bpr+' | SPK - '+data.no_spk);

                }
            })

            return false;
            
        })

        $('#kembali_satu').on('click', function () {
            
            $('.f_dua').slideUp('fast');
            $('.f_satu').slideDown(300);

            tabel_debitur_total.ajax.reload(null, false);

        })

        // tampil tambah debitur
        $('#tambah_debitur').on('click', function () {
            
            var id_spk = $('.id_spk').val();
            var id_bpr = $('.id_bpr').val();

            $.ajax({
                url         : "halaman_tambah_debitur",
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
                data        : {id_spk:id_spk, id_bpr:id_bpr},
                dataType    : "JSON",
                success     : function (data) {
                    swal.close();

                    console.log(data.no_spk);

                    $('.f_dua').slideUp('fast');
                    $('.f_tiga').slideDown(300);

                    $('#penghasilan_tahun').html(data.list_range);

                    $('.text_no_spk').text(' | No SPK: '+data.no_spk);
                    $('.text_nm_bpr').text('| '+data.nama_bpr);

                    $('#penghasilan_tahun').select2('val', ' ');

                    $('#form_tambah_debitur').trigger("reset");

                    $('#id_provinsi').select2('val', ' ');
                    $('#id_provinsi_korespon').select2('val', ' ');
                    $('#id_provinsi_kantor').select2('val', ' ');
                }
            })

            return false;

        })

        $('#kembali_dua').on('click', function () {
            
            $('.f_tiga').slideUp('fast');
            $('.f_dua').slideDown(300);

        })

        $('[name=warga_negara]').on('change', function () {
            
            var wn = $(this).val();

            if (wn == 'wna') {
                $('#input_wna').fadeIn('fast');
            } else {
                $('#input_wna').fadeOut(300);
            }

        })

        $('[name=sumber_dana_beli]').on('change', function () {
            
            var sdb = $(this).val();

            if (sdb == 'lainnya') {
                $('#sdb_lainnya').fadeIn('fast');
            } else {
                $('#sdb_lainnya').fadeOut(300);
            }

        })

        $('[name=sumber_dana_penghasilan]').on('change', function () {
            
            var sdp = $(this).val();

            if (sdp == 'lainnya') {
                $('#sdp_lainnya').fadeIn('fast');
            } else {
                $('#sdp_lainnya').fadeOut(300);
            }

        })

    // 05-05-2020

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
                url     : "ambil_option_kota_kab",
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
                url     : "ambil_option_kota_kab",
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
                url     : "ambil_option_kota_kab",
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
                url     : "ambil_option_kecamatan",
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
                url     : "ambil_option_kecamatan",
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
                url     : "ambil_option_kecamatan",
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

        // proses simpan data debitur
        $('#simpan_data_debitur').on('click', function () {

            var form_tambah_debitur = $('#form_tambah_debitur').serialize();
            var id_spk              = $('.id_spk').val();

            // menampilkan tabel debitur
            var tabel_debitur = $('.tabel_debitur').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "tampil_data_debitur",
                    "type"  : "POST",
                    "data"  : function (data) {
                        data.id_spk = id_spk;
                    }
                },
                "columnDefs"        : [{
                    "targets"   : [0,8],
                    "orderable" : false
                }, {
                    'targets'   : [0,8],
                    'className' : 'text-center',
                }],
                "scrollX"           : true,
                "bDestroy"          : true

            })

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
                        url     : "simpan_data_debitur",
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
                        data    : form_tambah_debitur,
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
            
                            tabel_debitur.ajax.reload(null,false);        
                            
                            $('#form_tambah_debitur').trigger("reset");

                            $('#id_provinsi').select2('val', ' ');
                            $('#id_provinsi_korespon').select2('val', ' ');
                            $('#id_provinsi_kantor').select2('val', ' ');

                            $('.f_tiga').slideUp('fast');
                            $('.f_dua').slideDown(300);
            
                            $('.aksi').val('Tambah');
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

        // edit data debitur
        $('.tabel_debitur').on('click', '.edit-debitur', function () {

            var id_debitur  = $(this).data('id');

            $.ajax({
                url         : "ambil_data_debitur/"+id_debitur,
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

                    console.log(data);
                    
                    $('#id_debitur').val(data.id_debitur);
                    $('#nik').val(data.nik);
                    $('#nama_lengkap').val(data.nama_lengkap);
                    $("input[name=jenis_kelamin][value=" + data.jenis_kelamin + "]").prop('checked', true);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tgl_lahir').datepicker('setDate', data[0].tgl_lahir);
                    $("input[name=jenis_identitas][value=" + data.jenis_identitas + "]").prop('checked', true);
                    $('#no_identitas').val(data.no_identitas);
                    $("input[name=status_nikah][value=" + data.status_nikah + "]").prop('checked', true);
                    $("input[name=warga_negara][value=" + data.warga_negara + "]").prop('checked', true);
                    $('#input_wna').val(data.negara_wna);

                    if (data.warga_negara == 'wna') {
                        $('#input_wna').fadeIn('fast');
                    } else {
                        $('#input_wna').fadeOut(300);
                    }

                    $('#agama').val(data.agama).trigger('change');
                    $('#alamat_rumah').val(data.alamat_rumah);
                    $('#kode_pos').val(data.kode_pos);
                    $('#alamat_korespon').val(data.alamat_korespondensi);
                    $('#kode_pos_korespon').val(data.kode_pos_korespondensi);
                    $('#alamat_kantor').val(data.alamat_kantor);
                    $('#kode_pos_kantor').val(data.kode_pos_kantor);
                    $('#kontak').val(data.kontak);
                    $('#email').val(data.email);
                    $('#pekerjaan').val(data.pekerjaan);
                    $('#bagian').val(data.bagian);
                    $('#tujuan_beli_asuransi').val(data.tujuan_beli_asuransi);
                    $("input[name=sumber_dana_beli][value=" + data.sumber_dana_pembelian + "]").prop('checked', true);
                    $('#sdb_lainnya').val(data.sumber_dana_pembelian_lainnya);

                    if (data.sumber_dana_pembelian == 'lainnya') {
                        $('#sdb_lainnya').fadeIn('fast');
                    } else {
                        $('#sdb_lainnya').fadeOut(300);
                    }

                    $('#penghasilan_tahun').val(data.pengahasilan_per_tahun).trigger('change');

                    $("input[name=sumber_dana_penghasilan][value=" + data.sumber_dana_penghasilan + "]").prop('checked', true);
                    $('#sdp_lainnya').val(data.sumber_dana_penghasilan_lainnya);

                    if (data.sumber_dana_penghasilan == 'lainnya') {
                        $('#sdp_lainnya').fadeIn('fast');
                    } else {
                        $('#sdp_lainnya').fadeOut(300);
                    }

                    $('.f_dua').slideUp('fast');
                    $('.f_tiga').slideDown(300);

                    $('#judul_2').text('Ubah Data');

                    $('.aksi').val('Ubah');

                    return false;

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            })

            return false;

        })

        // hapus debitur
        $('.tabel_debitur').on('click', '.hapus-debitur', function () {

            var id_debitur  = $(this).data('id');
            var id_spk      = $('.id_spk').val();

            // menampilkan tabel debitur
            var tabel_debitur = $('.tabel_debitur').DataTable({
                "processing"        : true,
                "serverSide"        : true,
                "order"             : [],
                "ajax"              : {
                    "url"   : "tampil_data_debitur",
                    "type"  : "POST",
                    "data"  : function (data) {
                        data.id_spk = id_spk;
                    }
                },
                "columnDefs"        : [{
                    "targets"   : [0,8],
                    "orderable" : false
                }, {
                    'targets'   : [0,8],
                    'className' : 'text-center',
                }],
                "scrollX"           : true,
                "bDestroy"          : true

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
                        url         : "simpan_data_debitur",
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
                        data        : {aksi:'Hapus', id_debitur:id_debitur},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_debitur.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus debitur',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                }); 

                                $('.aksi').val('Tambah');
                            
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
                            text                : 'Anda membatalkan hapus debitur',
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