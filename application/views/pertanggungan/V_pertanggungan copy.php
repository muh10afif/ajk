<div class="row f_satu">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <button class="btn float-right" style="background-color: #02a4af; color:white;" id="tambah_pertanggungan">Tambah Data</button>
                <h4 id="judul" class="font-weight-bold">Data Pertanggungan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover tabel_tertanggung" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Id Tertanggung</th>
                            <th width="20%">Nama Tertanggung</th>
                            <th width="20%">Jangka Waktu</th>
                            <th width="20%">Rate</th>
                            <th width="20%">Pertanggungan</th>
                            <th width="20%">Premi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="center"><span style='cursor:pointer' class='mr-2 text-primary detail' data-toggle='tooltip' data-placement='top' title='Detail'><i class='mdi mdi-information-outline mdi-24px'></i></span><span style='cursor:pointer' class='mr-2 text-warning edit' data-toggle='tooltip' data-placement='top' title='Edit'><i class='mdi mdi-pencil mdi-24px'></i></span><span style='cursor:pointer' class='mr-2 text-danger hapus' data-toggle='tooltip' data-placement='top' title='Hapus'><i class='mdi mdi-delete-forever mdi-24px'></i></span><span style='cursor:pointer' class='mr-2 text-success dokumen' data-toggle='tooltip' data-placement='top' title='Dokumen Persyaratan'><i class='mdi mdi-file-document mdi-24px'></i></span></td>
                        </tr> 
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
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item active" aria-current="page">Dokumen Persyaratan</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <button class="btn mb-3 float-right kembali_satu" style="background-color: #02a4af; color:white;" type="button"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul" class="font-weight-bold">Dokumen Persyaratan</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover tabel_dok_syarat" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Dokumen</th>
                            <th width="20%">Nomor</th>
                            <th width="20%">Tanggal Berakhir</th>
                            <th width="20%">Aksi</th>
                            <th width="20%">Dokumen</th>
                            <th width="20%">Kelengkapan</th>
                            <th width="10%">Validasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-warning" id="simpan_dokumen">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="row f_tiga" style="display: none;">

    <div class="col-md-9">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" style="color: #02a4af">Data Pertanggungan</li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data Pertanggungan</li>
            </ol>
        </nav>
    </div>

    <div class="col-md-3">
        <button class="btn mb-3 float-right kembali_satu" style="background-color: #02a4af; color:white;" type="button"><i class="mdi mdi-arrow-left-thick"></i>Kembali</button>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-3">
                <h4 id="judul" class="font-weight-bold">Tambah Data Pertanggungan</h4>
            </div>
            <div class="card-body table-responsive">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav_data_tertanggung_tab" data-toggle="tab" href="#nav_data_tertanggung" role="tab" aria-controls="nav_data_tertanggung" aria-selected="true">Data Tertanggung</a>
                        <a class="nav-item nav-link" id="nav_data_asuransi_tab" data-toggle="tab" href="#nav_data_asuransi" role="tab" aria-controls="nav_data_asuransi" aria-selected="false">Data Asuransi</a>
                        <a class="nav-item nav-link" id="nav_ket_sehat_tab" data-toggle="tab" href="#nav_ket_sehat" role="tab" aria-controls="nav_ket_sehat" aria-selected="false">Keterangan Kesehatan</a>
                        <a class="nav-item nav-link" id="nav_pernyataan_tab" data-toggle="tab" href="#nav_pernyataan" role="tab" aria-controls="nav_pernyataan" aria-selected="false">Pernyataan dan Persetujuan</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav_data_tertanggung" role="tabpanel" aria-labelledby="nav_data_tertanggung_tab">
                        <form id="form_tambah_debitur" autocomplete="off">
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
                                            <input type="radio" id="jk1" name="jenis_kelamin" class="custom-control-input">
                                            <label class="custom-control-label" for="jk1">Pria</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="jk2" name="jenis_kelamin" class="custom-control-input">
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
                                            <input type="radio" id="ji1" name="jenis_identitas" class="custom-control-input">
                                            <label class="custom-control-label" for="ji1">KTP</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="ji2" name="jenis_identitas" class="custom-control-input">
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
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                                    <div class="col-sm-9">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="st1" name="status" class="custom-control-input">
                                            <label class="custom-control-label" for="st1">Belum Menikah</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="st2" name="status" class="custom-control-input">
                                            <label class="custom-control-label" for="st2">Menikah</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="st3" name="status" class="custom-control-input">
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
                                                <input type="text" style="display: none; font-size: 14px;" id="input_wna" class="form-control" placeholder="Masukkan Nama Negara">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="agama" class="col-sm-3 col-form-label font-weight-bold">Agama</label>
                                    <div class="col-sm-9">
                                        <select name="agama" id="agama" data-allow-clear="1" placeholder="Pilih Agama">
                                            
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
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <select name="kota_kab" id="kota_kab" data-allow-clear="1" placeholder="Pilih Kota / Kab">
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <select name="id_kecamatan" id="id_kecamatan" data-allow-clear="1" placeholder="Pilih Kecamatan">
                                                    
                                                    </select>
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
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <select name="kota_kab_korespon" id="kota_kab_korespon" data-allow-clear="1" placeholder="Pilih Kota / Kab">
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <select name="id_kecamatan_korespon" id="id_kecamatan_korespon" data-allow-clear="1" placeholder="Pilih Kecamatan">
                                                    
                                                    </select>
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
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <select name="kota_kab_kantor" id="kota_kab_kantor" data-allow-clear="1" placeholder="Pilih Kota / Kab">
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <select name="id_kecamatan_kantor" id="id_kecamatan_kantor" data-allow-clear="1" placeholder="Pilih Kecamatan">
                                                    
                                                    </select>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="text" id="kode_pos_kantor" name="kode_pos_kantor" class="form-control" style="font-size: 14px;" placeholder="Masukkan Kode Pos">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="t_membeli_asuransi" class="col-sm-3 col-form-label font-weight-bold">Tujuan Membeli Asuransi</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" style="font-size: 14px;" name="t_membeli_asuransi" id="t_membeli_asuransi" placeholder="Masukkan Tujuan Membeli Asuransi"></textarea>
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
                        </form><hr>
                        <!-- <div id="simpan_debitur">
                            <button class="btn btn-warning mr-3">Simpan</button>
                            <button class="btn btn-secondary">Reset</button>
                        </div> -->
                        <div id="simpan_debitur2" class="d-flex justify-content-end">
                            <button class="btn btn-warning mr-3">Simpan</button>
                            <button class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav_data_asuransi" role="tabpanel" aria-labelledby="nav_data_asuransi_tab">
                        <form id="form_data_asuransi" autocomplete="off">
                            <div class="col-md-12 p-5">
                                <div class="form-group row">
                                    <label for="uang_tanggung" class="col-sm-3 col-form-label font-weight-bold">Uang Pertanggungan</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="text" name="uang_tanggung" style="font-size: 14px" id="uang_tanggung" class="form-control" placeholder="Masukkan Uang Pertanggungan">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row">
                                                    <label for="bunga" class="col-sm-3 col-form-label font-weight-bold">Bunga</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="bunga" style="font-size: 14px" id="bunga" class="form-control" placeholder="Masukkan Bunga">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jns_kredit" class="col-sm-3 col-form-label font-weight-bold">Jenis Kredit</label>
                                    <div class="col-sm-9">
                                        <select name="jns_kredit" id="jns_kredit" data-allow-clear="1" placeholder="Pilih Jenis Kredit">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jns_tanggung" class="col-sm-3 col-form-label font-weight-bold">Jenis Pertanggungan</label>
                                    <div class="col-sm-9">
                                        <select name="jns_tanggung" id="jns_tanggung" data-allow-clear="1" placeholder="Pilih Jenis Pertanggungan">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jns_tanggung" class="col-sm-3 col-form-label font-weight-bold">Masa Asuransi</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" style="font-size: 14px" name="masa_asuransi" id="masa_asuransi" class="form-control" placeholder="Masukkan Masa Asuransi" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Tahun</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jns_tanggung" class="col-sm-3 col-form-label font-weight-bold">Periode Asuransi</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control datepicker2 text-center" name="start" id="start" placeholder="Awal Periode" style="font-size: 14px;" readonly required>
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-primary b-0 text-white">s / d</span>
                                            </div>
                                            <input type="text" class="form-control datepicker2 text-center" name="end" id="end" placeholder="Akhir Periode" style="font-size: 14px;" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cara_bayar" class="col-sm-3 col-form-label font-weight-bold">Cara pembayaran</label>
                                    <div class="col-sm-9">
                                        <select name="cara_bayar" id="cara_bayar" data-allow-clear="1" placeholder="Pilih Cara Pembayaran">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cara_bayar" class="col-sm-3 col-form-label font-weight-bold">Yang Berhak Menerima Manfaat Asuransi</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label for="kredit_bank" class="col-sm-4 col-form-label font-weight-normal">a. Kredit Bank</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="kredit_bank" style="font-size: 14px" id="kredit_bank" class="form-control" placeholder="Masukkan Kredit Bank">
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <label for="ahli_waris" class="col-sm-4 col-form-label font-weight-normal">b. Ahli Waris</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="ahli_waris" style="font-size: 14px" id="ahli_waris" class="form-control" placeholder="Masukkan Ahli Waris">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 hubungan" style="display: none;">
                                                <div class="row">
                                                    <label for="ahli_waris" class="col-sm-3 col-form-label font-weight-bold">Hubungan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="hub_ahli_waris" style="font-size: 14px" id="hub_ahli_waris" class="form-control" placeholder="Masukkan Hubungan Ahli Waris">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label font-weight-bold">Apakah permohonan asuransi jiwa / Kecelakaan / Kesehatan Anda ataupun Pemulihan / Perubahan Polis Anda Pernah ditunda / ditolak atau dikenakan permi tambahan? </label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="a1" name="apakah" class="custom-control-input" value="ya">
                                                    <label class="custom-control-label" for="a1">Ya</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-2">
                                                    <input type="radio" id="a2" name="apakah" class="custom-control-input" value="tidak">
                                                    <label class="custom-control-label" for="a2">Tidak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-10 jelaskan mt-2" style="display: none;">
                                                <textarea id="sebab" style="font-size: 14px;" class="form-control" name="sebab" rows="3" placeholder="Jelaskan di perusahaan asuransi dimana dan penyebabnya"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form><hr>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-warning mr-3" id="simpan_data_asuransi">Simpan</button>
                                <button class="btn btn-secondary" id="reset_data_asuransi">Reset</button>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="nav_ket_sehat" role="tabpanel" aria-labelledby="nav_ket_sehat_tab">
                        <form id="form_ket_sehat" autocomplete="off">
                            <div class="col-md-12 p-5">
                                <div class="form-group row">
                                    <label for="tinggi_badan" class="col-sm-5 col-form-label font-weight-bold">Tinggi Badan</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" style="font-size: 14px" name="tinggi_badan" id="tinggi_badan" class="form-control" placeholder="Masukkan Tinggi Badan" aria-describedby="basic-addon2">
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
                                            <input type="text" style="font-size: 14px" name="berat_badan" id="berat_badan" class="form-control" placeholder="Masukkan Berat Badan" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket1" class="col-sm-5 col-form-label font-weight-bold">Apakah Dalam 5 tahun terakhir Anda pernah dioperasi/dirawat di Rumah Sakit atau dalam masa pengobatan/perawatan yang membutuhkan obat-obatan dalam masa yang lama? Jika "YA", jelaskan! </label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" style="font-size: 14px;" name="ket1" id="ket1" cols="30" rows="10" placeholder="Jika Ya, jelaskan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket2" class="col-sm-5 col-form-label font-weight-bold">Apakah Anda pernah atau sedang menderita penyakit atau pernah diberitahu atau dalam konsultasi perawatan/pengobatan/pengawasan/medis: jantung/nyeri dada, tekanan darah tinggi, stroke, tumor/benjolan. </label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" style="font-size: 14px;" name="ket2" id="ket2" cols="30" rows="10" placeholder="Jika pernah, jelaskan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket3" class="col-sm-5 col-form-label font-weight-bold">Apakah anda sedang atau dianjurkan atau pernah mengalami konsultasi/rawat inap/operasi/biopsi/pemerikasaan laboratorium/EKG/Tream III/Echocandiogragraphy/USG/CT Scan/MRI/papsmear/Mamografi</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" style="font-size: 14px;" name="ket3" id="ket3" cols="30" rows="10" placeholder="Jika pernah, jelaskan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label font-weight-bold">Khusus untuk wanita, Apakah anda sedang hamil?</label>
                                    <div class="col-sm-7">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="ah1" name="apakah2" class="custom-control-input" value="ya">
                                                    <label class="custom-control-label" for="ah1">Ya</label>
                                                </div>
                                                <div class="custom-control custom-radio mt-2">
                                                    <input type="radio" id="ah2" name="apakah2" class="custom-control-input" value="tidak">
                                                    <label class="custom-control-label" for="ah2">Tidak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-10 j_anak mt-1" style="display: none;">
                                                <div class="row">
                                                    <label for="ket3" class="col-sm-4 col-form-label font-weight-bold text-right">Kehamilan Anak ke- </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="anak_ke" name="anak_ke" style="font-size: 14px;" class="form-control" placeholder="Anak Ke-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form><hr>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-warning mr-3" id="simpan_ket_sehat">Simpan</button>
                            <button class="btn btn-secondary" id="reset_ket_sehat">Reset</button>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav_pernyataan" role="tabpanel" aria-labelledby="nav_pernyataan_tab">
                        <form id="form_pernyataan" autocomplete="off">
                            <div class="col-md-12 p-5">
                                <div class="form-group row">
                                    <label for="no_spk" class="col-sm-3 col-form-label font-weight-bold">Dokumen Pernyataan SPAJK</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="dok_pernyataan_spajk" style="font-size: 14px" id="dok_pernyataan_spajk" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form><hr>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-warning mr-3" id="simpan_dokumen_spajk">Simpan</button>
                            <button class="btn btn-secondary" id="reset_dokumen_spajk">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // 27-04-2020

            // menampilkan halaman dokumen persyaratan
            $('.tabel_tertanggung').on('click','.dokumen', function () {

                var tabel_dok_syarat  = $('.tabel_dok_syarat').DataTable({
                    "processing"    : true,
                    "ajax"          : "",
                    stateSave       : true,
                    "order"         : [],
                    "paging"        : false,
                    "info"          : false,
                    "searching"     : false,
                    "columnDefs"     : [{
                        "targets"       : [0,1,2,3,4,5,6,7],
                        "orderable"     : false
                    }],
                    "bDestroy": true
                })
                
                $('.f_satu').slideUp('fast');
                $('.f_dua').slideDown(300);

            })

            // aksi kembali satu
            $('.kembali_satu').on('click', function () {
                
                $('.f_dua').slideUp('fast');
                $('.f_tiga').slideUp('fast');
                $('.f_empat').slideUp('fast');
                $('.f_satu').slideDown(300);

            })

            // menampilkan halaman tambah data pertanggungan
            $('#tambah_pertanggungan').on('click', function () {
                
                $('.f_satu').slideUp('fast');
                $('.f_tiga').slideDown(300);

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

        
    })

</script>