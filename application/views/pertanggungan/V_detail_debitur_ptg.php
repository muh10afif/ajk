<div class="modal-header text-white" style="background-color: #02a4af">
    <h5 class="modal-title font-weight-bold" id="judul_modal">Detail Debitur</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="mr-2 text-dark">&times;</span>
    </button>
</div>

<div class="modal-body">
    
    <!-- menampilkan data detail debitur -->
    <div id="form_detail_debitur" class="d-flex justify-content-center">
        <div class="col-md-10 p-2 mt-2">  
            <div class="form-group row">
                <label for="nik" class="col-sm-3 col-form-label font-weight-bold">NIK</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['nik'] ?> </h6>
                </div>
            </div>  
            <div class="form-group row">
                <label for="nama_lengkap" class="col-sm-3 col-form-label font-weight-bold">Nama Lengkap</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['nama_lengkap'] ?> </h6>
                </div>
            </div>  
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Jenis Kelamin</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['jenis_kelamin'] ?> </h6>
                </div>
            </div>  
            <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-3 col-form-label font-weight-bold">Tempat Lahir</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['tempat_lahir'] ?> </h6>
                </div>
            </div> 
            <div class="form-group row">
                <label for="tgl_lahir" class="col-sm-3 col-form-label font-weight-bold">Tanggal Lahir</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= date('d-M-Y', strtotime($deb['tgl_lahir'])) ?> </h6>
                </div>
            </div> 
            <div class="form-group row">
                <label for="jenis_kelamin" class="col-sm-3 col-form-label font-weight-bold">Jenis Identitas</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['jenis_identitas'] ?> </h6>
                </div>
            </div>  
            <div class="form-group row">
                <label for="no_identitas" class="col-sm-3 col-form-label font-weight-bold">No Identitas</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['no_identitas'] ?> </h6>
                </div>
            </div> 
            <div class="form-group row">
                <label for="status" class="col-sm-3 col-form-label font-weight-bold">Status</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['status_nikah'] ?> </h6>
                </div>
            </div>  
            <div class="form-group row">
                <label for="" class="col-sm-3 col-form-label font-weight-bold font-weight-bold">Warga Negara</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <h6>: <?= strtoupper($deb['warga_negara']) ?> </h6>
                        </div>
                        <?php if ($deb['warga_negara'] == 'wna') : ?>
                        <div class="col-md-6">
                            <div class="row in_negara" style="display: none;">
                                <h6 class="font-weight-bold mt-2 col-md-3">Negara</h6>
                                <h6>: <?= $deb['negara_wna'] ?> </h6>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="agama" class="col-sm-3 col-form-label font-weight-bold">Agama</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['agama'] ?> </h6>
                </div>
            </div> 
            <!-- alamat rumah -->
            <div class="form-group row">
                <label for="alamat_rumah" class="col-sm-3 col-form-label font-weight-bold">Alamat Rumah</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-md-5 mt-2">
                            <h6>: <?= $deb['alamat_rumah'] ?> </h6>
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
                            <h6>: <?= $deb['alamat_korespondensi'] ?> </h6>
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
                <h6>: <?= $deb['kontak'] ?> </h6>
                </div>
            </div> 
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label font-weight-bold">Email</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['email'] ?> </h6>
                </div>
            </div> 
            <div class="form-group row">
                <label for="pekerjaan" class="col-sm-3 col-form-label font-weight-bold">Pekerjaan</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-md-5 mt-2">
                            <h6>: <?= $deb['pekerjaan'] ?> </h6>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <label for="bagian" class="col-sm-3 col-form-label font-weight-bold">Bagian</label>
                                <div class="col-sm-9 mt-2">
                                    <h6>: <?= $deb['bagian'] ?> </h6>
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
                            <h6>: <?= $deb['alamat_kantor'] ?> </h6>
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
                <h6>: <?= $deb['tujuan_beli_asuransi'] ?> </h6>
                </div>
            </div> 
            <!-- sumber dana pembelian -->
            <div class="form-group row">
                <label for="sumber_dana_beli" class="col-sm-3 col-form-label font-weight-bold">Sumber Dana Pembelian</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['sumber_dana_pembelian'] ?> </h6>
                </div>
            </div>  
            <!-- / sumber dana pembelian -->
            <div class="form-group row">
                <label for="penghasilan_tahun" class="col-sm-3 col-form-label font-weight-bold">Penghasilan / Tahun</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['penghasilan_per_tahun'] ?> </h6>
                </div>
            </div> 
            <!-- sumber dana penghasilan -->
            <div class="form-group row">
                <label for="sumber_dana_penghasilan" class="col-sm-3 col-form-label font-weight-bold">Sumber Dana Penghasilan</label>
                <div class="col-sm-9 mt-2">
                <h6>: <?= $deb['sumber_dana_penghasilan'] ?> </h6>
                </div>
            </div>  
            <!-- / sumber dana penghasilan -->
        </div>
    </div> 

    <!-- akhir menampilkan data detail debitur -->
    
</div>